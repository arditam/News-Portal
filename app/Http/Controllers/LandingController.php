<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\News;
use App\Models\Author;

class LandingController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $featureds = News::where('is_featured', true)->get();
        $news = News::latest()->take(6)->get(); // Ambil 6 berita terbaru (opsional)
        $authors = Author::take(5)->get();

        return view('landing', compact('banners', 'featureds', 'news', 'authors'));
    }
}
