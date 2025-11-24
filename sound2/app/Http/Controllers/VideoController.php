<?php
namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|file|mimes:mp4,avi,mov',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'year' => 'required|string',
            'artist' => 'required|string',
            'album' => 'required|string',
            'genre' => 'required|string',
            'language' => 'required|string',
        ]);

        $filePath = $request->file('file')->store('videos', 'public');
        $imagePath = $request->file('image')->store('video_images', 'public');

        Video::create([
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

        return redirect()->route('videos.index')->with('success', 'Video added successfully!');
    }

    public function show(Video $video)
    {
        $video->load(['reviews.user', 'ratings.user']);
        return view('videos.show', compact('video'));
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully!');
    }
}