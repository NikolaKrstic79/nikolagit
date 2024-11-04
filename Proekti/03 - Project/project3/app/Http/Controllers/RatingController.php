<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        $ratingExists = Rating::where('user_id', $user->id)->where('movie_id', $id)->exists();

        if ($ratingExists) {
            return back()->with('error', 'You have already rated this movie.');
        }

        $rating = new Rating();
        $rating->movie_id = $id;
        $rating->user_id = $user->id;
        $rating->rating = $request->input('rating');
        $rating->save();

        return back()->with('success', 'Thank you for your rating!');
    }
}

