<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //
    public function __construct()
    {
        $this->book = new Movie();
    }

    public function index()
    {
        $movies = Movie::all();
        return view('movie',['movies' => $movies]);
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
            'description' => 'required'
        ];

        $this->validate($request, $validate_rule);

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->image_url = $request->input('image_url');
        $movie->published_year = $request->input('published_year');
        $movie->is_showing = $request->input('is_showing');
        $movie->description = $request->input('description');

        $movie->save();
        return redirect()->route('admin');

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
            'description' => 'required'
        ];

        $this->validate($request, $validate_rule);

        $movie = Movie::find($id);
        $movie->title = $request->input('title');
        $movie->image_url = $request->input('image_url');
        $movie->published_year = $request->input('published_year');
        $movie->is_showing = $request->input('is_showing');
        $movie->description = $request->input('description');

        $movie->save();
        return redirect()->route('admin');
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
