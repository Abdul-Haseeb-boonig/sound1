@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div style="text-align: center; padding: 3rem 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px; margin-bottom: 3rem;">
        <h1 style="font-size: 3rem; margin-bottom: 1rem;">Welcome to Sound</h1>
        <p style="font-size: 1.2rem; margin-bottom: 2rem;">Your ultimate destination for music and videos</p>
        
        <!-- Search Form -->
        <form action="{{ route('search') }}" method="GET" style="max-width: 500px; margin: 0 auto;">
            <div style="display: flex; gap: 10px;">
                <input type="text" name="query" placeholder="Search for music or videos..." 
                       style="flex: 1; padding: 12px; border: none; border-radius: 25px; font-size: 1rem;">
                <button type="submit" 
                        style="background: #e74c3c; color: white; border: none; padding: 12px 24px; border-radius: 25px; cursor: pointer; font-size: 1rem;">
                    Search
                </button>
            </div>
        </form>
    </div>

    <!-- Latest Content -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        <!-- Latest Music -->
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 0.5rem; margin-bottom: 1.5rem;">Latest Music</h2>
            @foreach($latestMusic as $music)
                <div style="border: 1px solid #eee; padding: 1rem; margin-bottom: 1rem; border-radius: 8px; transition: transform 0.2s;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <h3 style="margin: 0 0 0.5rem 0; color: #2c3e50;">{{ $music->title }}</h3>
                            <p style="margin: 0.25rem 0; color: #666;">Artist: {{ $music->artist }}</p>
                            <p style="margin: 0.25rem 0; color: #666;">Year: {{ $music->year }}</p>
                        </div>
                        <div style="text-align: right;">
                            @if($music->is_new)
                                <span style="background: #e74c3c; color: white; padding: 0.3rem 0.8rem; border-radius: 15px; font-size: 0.8rem; display: inline-block; margin-bottom: 0.5rem;">NEW</span>
                            @endif
                            <a href="{{ route('music.show', $music) }}" 
                               style="background: #3498db; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px; display: inline-block;">
                                Listen
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Latest Videos -->
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <h2 style="color: #2c3e50; border-bottom: 2px solid #e74c3c; padding-bottom: 0.5rem; margin-bottom: 1.5rem;">Latest Videos</h2>
            @foreach($latestVideos as $video)
                <div style="border: 1px solid #eee; padding: 1rem; margin-bottom: 1rem; border-radius: 8px; transition: transform 0.2s;">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <h3 style="margin: 0 0 0.5rem 0; color: #2c3e50;">{{ $video->title }}</h3>
                            <p style="margin: 0.25rem 0; color: #666;">Artist: {{ $video->artist }}</p>
                            <p style="margin: 0.25rem 0; color: #666;">Year: {{ $video->year }}</p>
                        </div>
                        <div style="text-align: right;">
                            @if($video->is_new)
                                <span style="background: #e74c3c; color: white; padding: 0.3rem 0.8rem; border-radius: 15px; font-size: 0.8rem; display: inline-block; margin-bottom: 0.5rem;">NEW</span>
                            @endif
                            <a href="{{ route('videos.show', $video) }}" 
                               style="background: #e74c3c; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px; display: inline-block;">
                                Watch
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection