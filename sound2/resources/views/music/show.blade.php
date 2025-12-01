@extends('layouts.app')

@section('content')
    <div style="background: white; border-radius: 10px; padding: 2rem; box-shadow: 0 3px 15px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; margin-bottom: 2rem;">
            <div>
                <img src="{{ asset('storage/' . $music->image_path) }}" alt="{{ $music->title }}" 
                     style="width: 100%; border-radius: 10px; box-shadow: 0 3px 15px rgba(0,0,0,0.2);">
            </div>
            <div>
                <h1 style="color: #2c3e50; margin: 0 0 1rem 0; font-size: 2rem;">{{ $music->title }}</h1>
                <p style="font-size: 1.1rem; line-height: 1.6; color: #555; margin-bottom: 1.5rem;">{{ $music->description }}</p>
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 2rem;">
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px;">
                        <strong style="color: #2c3e50;">Artist:</strong>
                        <p style="margin: 0.5rem 0 0 0; color: #666;">{{ $music->artist }}</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px;">
                        <strong style="color: #2c3e50;">Album:</strong>
                        <p style="margin: 0.5rem 0 0 0; color: #666;">{{ $music->album }}</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px;">
                        <strong style="color: #2c3e50;">Year:</strong>
                        <p style="margin: 0.5rem 0 0 0; color: #666;">{{ $music->year }}</p>
                    </div>
                    <div style="background: #f8f9fa; padding: 1rem; border-radius: 8px;">
                        <strong style="color: #2c3e50;">Genre:</strong>
                        <p style="margin: 0.5rem 0 0 0; color: #666;">{{ $music->genre }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Audio Player -->
        <div style="background: #2c3e50; padding: 2rem; border-radius: 10px; margin: 2rem 0;">
            <h3 style="color: white; margin: 0 0 1rem 0;">Now Playing</h3>
            <audio controls style="width: 100%;">
                <source src="{{ asset('storage/' . $music->file_path) }}" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>

    <!-- Reviews & Ratings Section -->
    <div style="background: white; border-radius: 10px; padding: 2rem; box-shadow: 0 3px 15px rgba(0,0,0,0.1);">
        <h2 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 0.5rem; margin-bottom: 1.5rem;">Reviews & Ratings</h2>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
            <h3 style="color: #2c3e50; margin: 0 0 1rem 0;">Average Rating: 
                <span style="color: #f39c12;">{{ number_format($music->averageRating(), 1) }}/5</span>
            </h3>
        </div>

        @auth
            <!-- Review Form -->
            <div style="background: #e8f4fd; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <h3 style="color: #2c3e50; margin: 0 0 1rem 0;">Add Review</h3>
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="reviewable_type" value="App\Models\Music">
                    <input type="hidden" name="reviewable_id" value="{{ $music->id }}">
                    <textarea name="comment" placeholder="Write your review..." required
                              style="width: 100%; padding: 1rem; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 1rem; min-height: 100px;"></textarea>
                    <button type="submit" 
                            style="background: #3498db; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 5px; cursor: pointer;">
                        Submit Review
                    </button>
                </form>
            </div>

            <!-- Rating Form -->
            <div style="background: #fff3cd; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <h3 style="color: #2c3e50; margin: 0 0 1rem 0;">Add Rating</h3>
                <form action="{{ route('ratings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="rateable_type" value="App\Models\Music">
                    <input type="hidden" name="rateable_id" value="{{ $music->id }}">
                    <select name="rating" required
                            style="padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; margin-right: 1rem;">
                        <option value="">Select Rating</option>
                        <option value="1">⭐ (1 Star)</option>
                        <option value="2">⭐⭐ (2 Stars)</option>
                        <option value="3">⭐⭐⭐ (3 Stars)</option>
                        <option value="4">⭐⭐⭐⭐ (4 Stars)</option>
                        <option value="5">⭐⭐⭐⭐⭐ (5 Stars)</option>
                    </select>
                    <button type="submit" 
                            style="background: #f39c12; color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 5px; cursor: pointer;">
                        Submit Rating
                    </button>
                </form>
            </div>
        @endauth

        <!-- Reviews List -->
        <h3 style="color: #2c3e50; margin-bottom: 1rem;">User Reviews</h3>
        @foreach($music->reviews as $review)
            <div style="border: 1px solid #eee; padding: 1.5rem; margin-bottom: 1rem; border-radius: 8px; background: #fafafa;">
                <div style="display: flex; justify-content: between; align-items: start; margin-bottom: 1rem;">
                    <strong style="color: #2c3e50;">{{ $review->user->name }}</strong>
                    <small style="color: #999;">{{ $review->created_at->format('M d, Y') }}</small>
                </div>
                <p style="margin: 0; color: #555; line-height: 1.5;">{{ $review->comment }}</p>
                
                @auth
                    @if(auth()->id() === $review->user_id)
                        <div style="margin-top: 1rem;">
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        style="background: #e74c3c; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; font-size: 0.8rem;">
                                    Delete Review
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach

        @if($music->reviews->isEmpty())
            <div style="text-align: center; padding: 2rem; color: #666;">
                <p>No reviews yet. Be the first to review!</p>
            </div>
        @endif
    </div>
@endsection