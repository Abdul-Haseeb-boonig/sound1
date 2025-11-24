<?php
namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function index()
    {
        $music = Music::all();
        return view('music.index', compact('music'));
    }

    public function create()
    {
        return view('music.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:mp3,wav',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'year' => 'required|string',
            'artist' => 'required|string',
            'album' => 'required|string',
            'genre' => 'required|string',
            'language' => 'required|string',
        ]);

        $filePath = $request->file('file')->store('music', 'public');
        $imagePath = $request->file('image')->store('music_images', 'public');

        Music::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'image_path' => $imagePath,
            'year' => $request->year,
            'artist' => $request->artist,
            'album' => $request->album,
            'genre' => $request->genre,
            'language' => $request->language,
            'is_new' => true,
        ]);

        return redirect()->route('music.index')->with('success', 'Music added successfully!');
    }

    public function show(Music $music)
    {
        $music->load(['reviews.user', 'ratings.user']);
        return view('music.show', compact('music'));
    }

    public function destroy(Music $music)
    {
        $music->delete();
        return redirect()->route('music.index')->with('success', 'Music deleted successfully!');
    }
}