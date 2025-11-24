<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reviewable_type' => 'required',
            'reviewable_id' => 'required',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'reviewable_type' => $request->reviewable_type,
            'reviewable_id' => $request->reviewable_id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review added successfully!');
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);
        
        $request->validate([
            'comment' => 'required|string',
        ]);

        $review->update(['comment' => $request->comment]);
        return back()->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();
        return back()->with('success', 'Review deleted successfully!');
    }
}