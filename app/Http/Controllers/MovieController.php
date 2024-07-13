<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
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

        $keyword = $request->input('keyword','');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        $movies = $query->paginate(20);
        return view('movie',compact('movies','keyword','is_showing'));
    }

    public function admin()
    {
        $movies = Movie::all();
        return view('admin',['movies' => $movies]);
    }
    public function create()
    {
        return view('create');
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
        return view('edit',['movie' => $movie]);
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
