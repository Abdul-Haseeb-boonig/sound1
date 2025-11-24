@extends('layouts.app')

@section('content')
    <h1>Music Library</h1>

    @auth
        @if(auth()->user()->is_admin)
            <a href="{{ route('music.create') }}">Add New Music</a>
        @endif
    @endauth

    @foreach($music as $item)
        <div>
            <h3>{{ $item->title }}</h3>
            <p>Artist: {{ $item->artist }} | Album: {{ $item->album }} | Year: {{ $item->year }}</p>
            @if($item->is_new)<span>NEW</span>@endif
            <a href="{{ route('music.show', $item) }}">Listen</a>
            
            @auth
                @if(auth()->user()->is_admin)
                    <form action="{{ route('music.destroy', $item) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endif
            @endauth
        </div>
    @endforeach
@endsection