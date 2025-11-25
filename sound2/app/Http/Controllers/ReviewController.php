<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReviewController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request)
    {
        $request->validate([
            'reviewable_type' => 'required',
            'reviewable_id' => 'required',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => Auth::check() ? Auth::id() : null,
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