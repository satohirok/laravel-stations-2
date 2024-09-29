<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    //
    public function __construct()
    {
        $this->book = new Movie();
    }

    public function index(Request $request)
    {
        $query = Movie::query();

        $is_showing = $request->input('is_showing', 'all');

        if ($is_showing === '1'){
            $query->where('is_showing',true);
        } elseif($is_showing === '0'){
            $query->where('is_showing',false);
        }

        // 作品データの変数名は、 view に渡している変数名と合わせて適宜変更してください
        // $movies = DB::table('movies')->whereRaw("title = '{$request->input('keyword')}'")->get();

        $keyword = $request->input('keyword','');

        // if (!empty($keyword)) {
        //     $query->where(function($q) use ($keyword) {
        //         $q->where('title', 'like', '%' . $keyword . '%')
        //           ->orWhere('description', 'like', '%' . $keyword . '%');
        //     });
        // }


        // SQLインジェクション未対策
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->whereRaw("title = '{$keyword}'")->get();

            });
        }


        // SQLインジェクション対策済み
        // if (!empty($keyword)) {
        //     $query->where(function($q) use ($keyword) {
        //         $q->whereRaw("title = ?" ,[$keyword])->get();

        //     });
        // }

        $movies = $query->paginate(20);

        return view('/movie/index',compact('movies','keyword','is_showing'));
    }

    public function show($id){
        $movie = Movie::with(['schedules' => function($query) {
            $query->orderBy('start_time', 'asc');
        }])->findOrFail($id);
        return view('movie.show', compact('movie'));
    }

    public function admin()
    {
        $movies = Movie::all();
        return view('/admin/admin',['movies' => $movies]);
    }

    public function admin_show($id)
    {
        // $movie = Movie::find($id);
        $movie = Movie::with(['schedules' => function($query) {
            $query->orderBy('start_time', 'asc');
        }])->findOrFail($id);
        return view('admin.show', compact('movie'));
    }

    public function create()
    {
        return view('admin/create');
    }
    public function store(Request $request)
    {
        $validate_rule = [
            'title' => 'required | unique:movies',
            'image_url' => 'required | url',
            'published_year' => 'required | integer',
            'is_showing' => 'boolean',
            'genre' => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $validate_rule);


        DB::beginTransaction();


        try{
            $genreName = $request->input('genre');

            $genre = Genre::where('name',$genreName)->first();

            if (!$genre) {
                $genre = new Genre();
                $genre->name = $genreName;
                $genre->save();
            }

            $movie = new Movie();



            $movie->title = $request->input('title');
            $movie->image_url = $request->input('image_url');
            $movie->published_year = $request->input('published_year');
            $movie->is_showing = $request->input('is_showing');
            $movie->description = $request->input('description');
            $movie->genre_id = $genre->id;


            $movie->save();
            DB::commit();

            return redirect()->route('admin');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => '変更に失敗しました'],500);
        }


    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('/admin/edit',['movie' => $movie]);
    }

    public function update(Request $request,$id)
    {
        $validate_rule = [
            'title' => 'required | unique:movies',
            'image_url' => 'required | url',
            'published_year' => 'required | integer',
            'is_showing' => 'boolean',
            'genre' => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $validate_rule);

        DB::beginTransaction();
        try{
            $genreName = $request->input('genre');

            $genre = Genre::where('name',$genreName)->first();

            if (!$genre) {
                $genre = new Genre();
                $genre->name = $genreName;
                $genre->save();
            }

            $movie = Movie::find($id);

            $movie->title = $request->input('title');
            $movie->image_url = $request->input('image_url');
            $movie->published_year = $request->input('published_year');
            $movie->is_showing = $request->input('is_showing');
            $movie->description = $request->input('description');
            $movie->genre_id = $genre->id;

            $movie->save();
            return redirect()->route('admin');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => '変更に失敗しました'],500);
        }

    }

    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return abort(404);
        }

        $movie->delete();
        return redirect()->route('admin');
    }
}
