@extends('layouts.app')

@section('content')
    <h1>Video Library</h1>

    @auth
        @if(auth()->check() && auth()->user()->email === 'admin@sound.com')
            <a href="{{ route('videos.create') }}">Add New Video</a>
        @endif
    @endauth

    @foreach($videos as $video)
        <div>
            <h3>{{ $video->title }}</h3>
            <p>Artist: {{ $video->artist }} | Album: {{ $video->album }} | Year: {{ $video->year }}</p>
            @if($video->is_new)<span>NEW</span>@endif
            <a href="{{ route('videos.show', $video) }}">Watch</a>
            
            @auth
                @if(auth()->check() && auth()->user()->email === 'admin@sound.com')
                    <form action="{{ route('videos.destroy', $video) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endif
            @endauth
        </div>
    @endforeach
@endsection