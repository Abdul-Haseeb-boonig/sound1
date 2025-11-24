@extends('layouts.app')

@section('content')
    <h1>Add New Music</h1>

    <form action="{{ route('music.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label>Title:</label>
            <input type="text" name="title" required>
        </div>

        <div>
            <label>Description:</label>
            <textarea name="description" required></textarea>
        </div>

        <div>
            <label>Music File:</label>
            <input type="file" name="file" accept=".mp3,.wav" required>
        </div>

        <div>
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" required>
        </div>

        <div>
            <label>Year:</label>
            <input type="text" name="year" required>
        </div>

        <div>
            <label>Artist:</label>
            <input type="text" name="artist" required>
        </div>

        <div>
            <label>Album:</label>
            <input type="text" name="album" required>
        </div>

        <div>
            <label>Genre:</label>
            <input type="text" name="genre" required>
        </div>

        <div>
            <label>Language:</label>
            <input type="text" name="language" required>
        </div>

        <button type="submit">Add Music</button>
    </form>
@endsection