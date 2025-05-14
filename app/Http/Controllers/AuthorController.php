<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author; // <-- Tambahkan ini
use App\Models\NewsCategory;

class AuthorController extends Controller
{

    public function show($username)
{
    $author = Author::where('username', $username)->firstOrFail();

    $news = $author->news()
        ->when(request('search'), function($query) {
            return $query->where('title', 'like', '%'.request('search').'%')
                         ->orWhere('content', 'like', '%'.request('search').'%');
        })
        ->when(request('sort'), function($query) {
            if (request('sort') == 'oldest') {
                return $query->oldest();
            } elseif (request('sort') == 'popular') {
                return $query->orderBy('views', 'desc');
            } else {
                return $query->latest();
            }
        })
        
        ->paginate(9);

    $totalViews = $author->news()->sum('views');
    $categories = NewsCategory::all();

    return view('author.show', compact('author', 'news', 'totalViews', 'categories'));
}

}