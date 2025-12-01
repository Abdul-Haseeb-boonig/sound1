@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="color: #2c3e50; margin: 0;">Music Library</h1>
        @auth
            @if(auth()->check() && auth()->user()->email === 'admin@sound.com')
                <a href="{{ route('music.create') }}" 
                   style="background: #27ae60; color: white; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 5px; font-weight: bold;">
                    Add New Music
                </a>
            @endif
        @endauth
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
        @foreach($music as $item)
            <div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 3px 15px rgba(0,0,0,0.1); transition: transform 0.3s;">
                <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                    <span style="color: white; font-size: 3rem;">🎵</span>
                </div>
                <div style="padding: 1.5rem;">
                    <h3 style="margin: 0 0 1rem 0; color: #2c3e50; font-size: 1.2rem;">{{ $item->title }}</h3>
                    <p style="margin: 0.5rem 0; color: #666;"><strong>Artist:</strong> {{ $item->artist }}</p>
                    <p style="margin: 0.5rem 0; color: #666;"><strong>Album:</strong> {{ $item->album }}</p>
                    <p style="margin: 0.5rem 0; color: #666;"><strong>Year:</strong> {{ $item->year }}</p>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem;">
                        <div>
                            @if($item->is_new)
                                <span style="background: #e74c3c; color: white; padding: 0.3rem 0.8rem; border-radius: 15px; font-size: 0.8rem;">NEW</span>
                            @endif
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <a href="{{ route('music.show', $item) }}" 
                               style="background: #3498db; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px; font-size: 0.9rem;">
                                Listen
                            </a>
                            @auth
                                @if(auth()->check() && auth()->user()->email === 'admin@sound.com')
                                    <form action="{{ route('music.destroy', $item) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                style="background: #e74c3c; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; cursor: pointer; font-size: 0.9rem;">
                                            Delete
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($music->isEmpty())
        <div style="text-align: center; padding: 3rem; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <p style="font-size: 1.2rem; color: #666; margin: 0;">No music available yet.</p>
        </div>
    @endif
@endsection