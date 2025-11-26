@extends('layouts.app')

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>

    <div style="margin: 20px 0;">
        <form action="{{ route('search') }}" method="GET">
            <input type="text" name="query" value="{{ $query }}" placeholder="Search music or videos...">
            <button type="submit">Search Again</button>
        </form>
    </div>

    <h2>Music Results ({{ $music->count() }})</h2>
    @if($music->count() > 0)
        @foreach($music as $item)
            <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
                <h3>{{ $item->title }}</h3>
                <p><strong>Artist:</strong> {{ $item->artist }} | <strong>Year:</strong> {{ $item->year }} | <strong>Album:</strong> {{ $item->album }}</p>
                @if($item->is_new)<span style="background: red; color: white; padding: 2px 5px;">NEW</span>@endif
                <a href="{{ route('music.show', $item) }}">View Details</a>
            </div>
        @endforeach
    @else
        <p>No music found for "{{ $query }}"</p>
    @endif

    <h2>Video Results ({{ $videos->count() }})</h2>
    @if($videos->count() > 0)
        @foreach($videos as $video)
            <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
                <h3>{{ $video->title }}</h3>
                <p><strong>Artist:</strong> {{ $video->artist }} | <strong>Year:</strong> {{ $video->year }} | <strong>Album:</strong> {{ $video->album }}</p>
                @if($video->is_new)<span style="background: red; color: white; padding: 2px 5px;">NEW</span>@endif
                <a href="{{ route('videos.show', $video) }}">View Details</a>
            </div>
        @endforeach
    @else
        <p>No videos found for "{{ $query }}"</p>
    @endif

    @if($music->count() == 0 && $videos->count() == 0)
        <div style="text-align: center; margin: 40px 0;">
            <p>No results found for "{{ $query }}"</p>
            <p>Try searching with different keywords like artist name, song title, or year.</p>
        </div>
    @endif

    <div style="margin-top: 20px;">
        <a href="{{ route('home') }}">Back to Home</a>
    </div>
@endsection