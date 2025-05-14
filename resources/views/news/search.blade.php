<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian: {{ $query }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#DC2626',
                            light: '#FEE2E2',
                        },
                        accent: '#DC2626',
                        dark: '#1E293B'
                    }
                }
            }
        }
    </script>
    <style>
        .search-card {
            transition: all 0.3s ease;
        }
        .search-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            position: relative;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: #DC2626;
            border-radius: 3px;
        }
        .category-chip {
            transition: all 0.3s ease;
        }
        .category-chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2);
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="w-full">
        @include('partials.header')
        
        <!-- Search Results Section -->
        <section class="search-results py-16">
            <div class="container mx-auto px-4 max-w-7xl">
                <div class="text-center mb-12">
                    <h2 class="section-title text-3xl font-bold text-dark inline-block">Hasil Pencarian</h2>
                    <p class="text-gray-500 mt-3 max-w-2xl mx-auto">
                        Menampilkan hasil untuk: <span class="font-semibold text-accent">"{{ $query }}"</span>
                    </p>
                </div>

                @if ($news->isEmpty())
                    <div class="text-center py-12">
                        <div class="inline-block p-4 bg-primary-light rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada berita yang ditemukan</h3>
                        <p class="text-gray-600 mb-6">Coba gunakan kata kunci lain atau periksa ejaan Anda</p>
                        <a href="/" class="bg-accent hover:bg-red-700 text-white py-3 px-6 rounded-full font-semibold inline-block transition-all">
                            Kembali ke Beranda
                        </a>
                    </div>
                @else
                    <!-- News Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($news as $article)
                            <a href="{{ route('news.show', $article->slug) }}" 
                               class="search-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all">
                                <div class="trending-img h-40 overflow-hidden">
                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="p-4">
                                    <span class="text-accent text-xs font-semibold">
                                        {{ $article->newsCategory->title ?? 'Umum' }}
                                    </span>
                                    <h3 class="text-sm font-semibold mt-1 mb-2 leading-tight line-clamp-3">
                                        {{ $article->title }}
                                    </h3>
                                    <div class="flex justify-between items-center text-xs text-gray-400">
                                        <span>{{ \Carbon\Carbon::parse($article->created_at)->format('d M Y') }}</span>
                                        <span><i class="far fa-eye mr-1"></i> {{ $article->views ?? 0 }}x</span>
                                    </div>
                                    <div class="flex items-center mt-2 text-xs text-gray-400">
                                        @if($article->author && $article->author->avatar)
                                        <img src="{{ asset('storage/' . $article->author->avatar) }}" 
                                             alt="{{ $article->author->name }}" 
                                             class="w-5 h-5 rounded-full mr-2 object-cover">
                                        @else
                                        <div class="w-5 h-5 rounded-full mr-2 bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-xs text-gray-400"></i>
                                        </div>
                                        @endif
                                        <span>{{ $article->author->name ?? 'Admin' }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex items-center justify-center">
                        {{ $news->onEachSide(1)->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</body>
</html>