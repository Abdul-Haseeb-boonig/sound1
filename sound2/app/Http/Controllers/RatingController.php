<?php
namespace App\Http\Controllers;
#this file needs to be checked at the end
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RatingController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $request->validate([
            'rateable_type' => 'required|string',
            'rateable_id' => 'required|integer',
            'rating' => 'required|integer|between:1,5',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => Auth::check() ? Auth::user()->id : null,
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