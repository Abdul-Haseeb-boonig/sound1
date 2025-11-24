@extends('layouts.app')

@section('content')
    <h1>{{ $music->title }}</h1>
    <img src="{{ asset('storage/' . $music->image_path) }}" alt="{{ $music->title }}" width="200">
    <p>{{ $music->description }}</p>
    <p><strong>Artist:</strong> {{ $music->artist }}</p>
    <p><strong>Album:</strong> {{ $music->album }}</p>
    <p><strong>Year:</strong> {{ $music->year }}</p>
    <p><strong>Genre:</strong> {{ $music->genre }}</p>
    <p><strong>Language:</strong> {{ $music->language }}</p>

    <audio controls>
        <source src="{{ asset('storage/' . $music->file_path) }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <h2>Reviews & Ratings</h2>
    <p>Average Rating: {{ number_format($music->averageRating(), 1) }}/5</p>

    @auth
        <h3>Add Review</h3>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="reviewable_type" value="App\Models\Music">
            <input type="hidden" name="reviewable_id" value="{{ $music->id }}">
            <textarea name="comment" placeholder="Write your review..." required></textarea>
            <button type="submit">Submit Review</button>
        </form>

        <h3>Add Rating</h3>
        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="rateable_type" value="App\Models\Music">
            <input type="hidden" name="rateable_id" value="{{ $music->id }}">
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
    @foreach($music->reviews as $review)
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