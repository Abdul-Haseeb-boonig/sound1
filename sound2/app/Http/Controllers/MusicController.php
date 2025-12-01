<?php
namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MusicController extends Controller
{
    public function index()
    {
        $music = Music::all();
        return view('music.index', compact('music'));
    }

    public function create()
    {
        // Hardcoded admin check
        if (!Auth::check() || Auth::user()->email !== 'admin@sound.com') {
            abort(403, 'Unauthorized access.');
        }else{
        return view('music.create');
        }
    }

    public function store(Request $request)
    {
        // Hardcoded admin check
        if (!Auth::check() || Auth::user()->email !== 'admin@sound.com') {
            abort(403, 'Unauthorized access.');
        }

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

        // Temporary debug: dump upload details to see what's happening
        dd([
            'has_file' => $request->hasFile('file'),
            'file_error' => $request->file('file') ? $request->file('file')->getError() : null,
            'file_size' => $request->file('file') ? $request->file('file')->getSize() : null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'post_max_size' => ini_get('post_max_size'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'user_id' => Auth::check() ? Auth::id() : null,
            'remote_addr' => $request->ip(),
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
        // Hardcoded admin check
        if (!Auth::check() || Auth::user()->email !== 'admin@sound.com') {
            abort(403, 'Unauthorized access.');
        }
        
        $music->delete();
        return redirect()->route('music.index')->with('success', 'Music deleted successfully!');
    }
}