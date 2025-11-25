@extends('layouts.app')

@section('content')
    <h1>{{ $video->title }}</h1>
    <img src="{{ asset('storage/' . $video->image_path) }}" alt="{{ $video->title }}" width="200">
    <p>{{ $video->description }}</p>
    <p><strong>Artist:</strong> {{ $video->artist }}</p>
    <p><strong>Album:</strong> {{ $video->album }}</p>
    <p><strong>Year:</strong> {{ $video->year }}</p>
    <p><strong>Genre:</strong> {{ $video->genre }}</p>
    <p><strong>Language:</strong> {{ $video->language }}</p>

    <video controls width="400">
        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
        Your browser does not support the video element.
    </video>

    <h2>Reviews & Ratings</h2>
    <p>Average Rating: {{ number_format($video->averageRating(), 1) }}/5</p>

    @auth
        <h3>Add Review</h3>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="reviewable_type" value="App\Models\Video">
            <input type="hidden" name="reviewable_id" value="{{ $video->id }}">
            <textarea name="comment" placeholder="Write your review..." required></textarea>
            <button type="submit">Submit Review</button>
        </form>

        <h3>Add Rating</h3>
        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="rateable_type" value="App\Models\Video">
            <input type="hidden" name="rateable_id" value="{{ $video->id }}">
            <select name="rating" required>
                <option value="">Select Rating</option>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>
            <button type="submit">Submit Rating</button>
        </form>
    @endauth

    <h3>Reviews</h3>
    @foreach($video->reviews as $review)
        <div>
            <strong>{{ $review->user->name }}</strong>
            <p>{{ $review->comment }}</p>
            <small>{{ $review->created_at->format('M d, Y') }}</small>
            
            @auth
                @if(auth()->id() === $review->user_id)
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endif
            @endauth
        </div>
    @endforeach
@endsection