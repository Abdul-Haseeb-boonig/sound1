<?php

namespace App\Http\Controllers;
use App\Models\Music;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  
    public function index()
    {
        $latestMusic = Music::latest()->take(5)->get();
        $latestVideos = Video::latest()->take(5)->get();
        
        return view('home', compact('latestMusic', 'latestVideos'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $music = Music::where('title', 'LIKE', "%$query%")
            ->orWhere('artist', 'LIKE', "%$query%")
            ->orWhere('year', 'LIKE', "%$query%")
            ->orWhere('album', 'LIKE', "%$query%")
            ->get();

        $videos = Video::where('title', 'LIKE', "%$query%")
            ->orWhere('artist', 'LIKE', "%$query%")
            ->orWhere('year', 'LIKE', "%$query%")
            ->orWhere('album', 'LIKE', "%$query%")
            ->get();

        return view('search', compact('music', 'videos', 'query'));
    }
}

