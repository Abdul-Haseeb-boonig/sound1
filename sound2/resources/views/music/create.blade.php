@extends('layouts.app')

@section('content')
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="background: white; border-radius: 10px; padding: 2rem; box-shadow: 0 3px 15px rgba(0,0,0,0.1);">
            <h1 style="color: #2c3e50; margin-bottom: 2rem; text-align: center;">Add New Music</h1>

            <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Title *</label>
                        <input type="text" name="title" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Artist *</label>
                        <input type="text" name="artist" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Description *</label>
                    <textarea name="description" required 
                              style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; min-height: 100px;"></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Music File *</label>
                        <input type="file" name="file" accept=".mp3,.wav" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Cover Image *</label>
                        <input type="file" name="image" accept="image/*" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Year *</label>
                        <input type="text" name="year" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Album *</label>
                        <input type="text" name="album" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Genre *</label>
                        <input type="text" name="genre" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #2c3e50; font-weight: bold;">Language *</label>
                        <input type="text" name="language" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <button type="submit" 
                            style="background: #27ae60; color: white; border: none; padding: 1rem 2rem; border-radius: 5px; cursor: pointer; font-size: 1.1rem; font-weight: bold;">
                        Add Music
                    </button>
                    <a href="{{ route('music.index') }}" 
                       style="background: #95a5a6; color: white; padding: 1rem 2rem; text-decoration: none; border-radius: 5px; font-size: 1.1rem; font-weight: bold;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection