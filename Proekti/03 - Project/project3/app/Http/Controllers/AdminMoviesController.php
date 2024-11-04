<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class AdminMoviesController extends Controller
{
    /**
     * Display a listing of the movies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return view('admin-dashboard', compact('movies'));
    }

    /**
     * Show the form for creating a new movie.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.movies.create');
    }

    /**
     * Store a newly created movie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'director' => 'required|string|max:255',
            'writer' => 'nullable|string|max:255',
            'stars' => 'required|string|max:255',
            'trailer_url' => 'required|url',
            'image_url' => 'required|url',
        ]);

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->year = $request->input('year');
        $movie->director = $request->input('director');
        $movie->writer = $request->input('writer');
        $movie->stars = $request->input('stars');
        $movie->trailer_url = $request->input('trailer_url');
        $movie->image_url = $request->input('image_url');

        $movie->save();

        return redirect()->route('admin.dashboard')->with('success', 'Movie created successfully.');
    }

    /**
     * Show the form for editing the specified movie.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('edit', compact('movie'));
    }

    /**
     * Update the specified movie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . date('Y'),
        'director' => 'required|string|max:255',
        'writer' => 'nullable|string|max:255',
        'stars' => 'required|string|max:255',
        'trailer_url' => 'required|url',
        'image_url' => 'required|url',
    ]);

    $movie = Movie::findOrFail($id);
    $movie->title = $request->input('title');
    $movie->year = $request->input('year');
    $movie->director = $request->input('director');
    $movie->writer = $request->input('writer');
    $movie->stars = $request->input('stars');
    $movie->trailer_url = $request->input('trailer_url');
    $movie->image_url = $request->input('image_url');

    $movie->save();

    return redirect()->route('admin.dashboard')->with('success', 'Movie updated successfully.');
}

    /**
     * Remove the specified movie from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Movie deleted successfully.');
    }
}
