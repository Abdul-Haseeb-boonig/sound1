@extends('layouts.app')

@section('content')
    <h1>Welcome to Sound</h1>
    <p>Your music and video platform</p>

    <form action="{{ route('search') }}" method="GET">
        <input type="text" name="query" placeholder="Search music or videos...">
        <button type="submit">Search</button>
    </form>

    <h2>Latest Music</h2>
    @foreach($latestMusic as $music)
        <div>
            <h3>{{ $music->title }}</h3>
            <p>Artist: {{ $music->artist }} | Year: {{ $music->year }}</p>
            @if($music->is_new)<span>NEW</span>@endif
            <a href="{{ route('music.show', $music) }}">View Details</a>
        </div>
    @endforeach

    <h2>Latest Videos</h2>
    @foreach($latestVideos as $video)
        <div>
            <h3>{{ $video->title }}</h3>
            <p>Artist: {{ $video->artist }} | Year: {{ $video->year }}</p>
            @if($video->is_new)<span>NEW</span>@endif
            <a href="{{ route('videos.show', $video) }}">View Details</a>
        </div>
    @endforeach
@endsection