<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    // Menampilkan berita berdasarkan slug
    public function show($slug)
    {
        // Ambil berita berdasarkan slug
        $news = News::with(['author', 'newsCategory'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Ambil berita terbaru (kecuali yang sedang dilihat)
        $newests = News::with(['author', 'newsCategory'])
            ->where('id', '!=', $news->id)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Format tanggal
        $news->formatted_date = Carbon::parse($news->created_at)->isoFormat('D MMMM Y');

        // Tambahkan jumlah view
        $news->increment('views');

        return view('news.show', [
            'news' => $news,
            'newests' => $newests,
            'metaTitle' => $news->title . ' - NewsPortal',
            'metaDescription' => \Str::limit(strip_tags($news->content), 160)
        ]);
    }

    // Menampilkan berita berdasarkan kategori
    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->firstOrFail();

        // Ambil berita berdasarkan kategori dan paginasi
        $news = News::where('news_category_id', $category->id)
                    ->with('author', 'newsCategory')
                    ->latest()
                    ->paginate(9);

        return view('news.category', compact('category', 'news'));
    }

    // Menampilkan semua berita dengan pagination
    public function allnews()
    {
        $news = News::with(['author', 'newsCategory'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(9);

        return view('news.allnews', compact('news'));
    }

    // Menampilkan hasil pencarian berita
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Cari berita berdasarkan judul dan konten
        $news = News::with(['author', 'newsCategory'])
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        // Ambil kategori yang berkaitan dengan hasil pencarian
        $relatedCategories = NewsCategory::whereHas('news', function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('content', 'LIKE', "%{$query}%");
        })
        ->withCount(['news' => function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('content', 'LIKE', "%{$query}%");
        }])
        ->get();

        return view('news.search', compact('news', 'query', 'relatedCategories'));
    }
}
