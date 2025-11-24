<?php
namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rateable_type' => 'required',
            'rateable_id' => 'required',
            'rating' => 'required|integer|between:1,5',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'rateable_type' => $request->rateable_type,
                'rateable_id' => $request->rateable_id,
            ],
            ['rating' => $request->rating]
        );

        return back()->with('success', 'Rating added successfully!');
    }

    public function update(Request $request, Rating $rating)
    {
        $this->authorize('update', $rating);
        
        $request->validate([
            'rating' => 'required|integer|between:1,5',
        ]);

        $rating->update(['rating' => $request->rating]);
        return back()->with('success', 'Rating updated successfully!');
    }
}