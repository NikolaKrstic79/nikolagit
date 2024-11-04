<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use App\Models\Movie;
use App\Models\Comment; // Make sure to import the Comment model
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('moviebrowse', compact('movies'));
    }

    public function show($id)
    {
        try {
            $movie = Movie::with('comments.user')->findOrFail($id);
            return view('show', compact('movie'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function adminDashboard()
    {
        return view('admin-dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'director' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'stars' => 'required|string|max:255',
            'trailer_url' => 'required|url',
            'image_url' => 'required|url',
        ]);

        Movie::create($request->all());

        return redirect()->route('moviebrowse')->with('success', 'Movie added successfully.');
    }

    public function rate(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Retrieve authenticated user
        $user = Auth::user();

        // Check if user has already rated this movie
        $existingRating = Rating::where('user_id', $user->id)
                                ->where('movie_id', $id)
                                ->first();

        if ($existingRating) {
            // User has already rated this movie
            return redirect()->back()->with('error', 'You have already rated this movie.');
        }

        // Create new Rating instance
        $rating = new Rating();
        $rating->user_id = $user->id;
        $rating->movie_id = $id;
        $rating->rating = $request->input('rating');
        $rating->save();

        return redirect()->back()->with('success', 'Thank you for rating this movie.');
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $movie = Movie::findOrFail($id);

        // Create comment
        $comment = new Comment();
        $comment->user_id = auth()->user()->id; // Assuming comments belong to authenticated users
        $comment->movie_id = $movie->id;
        $comment->comment = $request->input('comment');
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }

    public function deleteComment($commentId)
{
    $comment = Comment::findOrFail($commentId);
    $comment->delete();

    return back()->with('success', 'Comment deleted successfully.');
}
}
