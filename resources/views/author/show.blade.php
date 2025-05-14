<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karya {{ $author->name }} | NewsPortal</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #ef4444);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .news-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .news-image-container {
            overflow: hidden;
            height: 200px;
            position: relative;
        }
        .news-image {
            transition: transform 0.5s ease;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .news-card:hover .news-image {
            transform: scale(1.05);
        }
        .author-avatar {
            border: 4px solid white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .author-avatar:hover {
            transform: scale(1.05);
        }
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #3b82f6, #ef4444);
            border-color: transparent;
            color: white;
        }
        .pagination .page-link {
            color: #4b5563;
            border: 1px solid #e5e7eb;
            margin: 0 4px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .pagination .page-link:hover {
            background-color: #f3f4f6;
        }
        .category-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(220, 38, 38, 0.9);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 1;
        }
        .social-icon {
            transition: all 0.3s ease;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        .social-icon:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.2);
        }
        .divider {
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #ef4444);
            width: 100px;
            border-radius: 3px;
            margin: 16px auto;
            opacity: 0.8;
        }
        .content-line-clamp {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .author-header {
            background: linear-gradient(135deg, #f9fafb, #f3f4f6);
            border-radius: 16px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        .author-header::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, rgba(0, 0, 0, 0) 70%);
        }
        .author-header::after {
            content: "";
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(239, 68, 68, 0.1) 0%, rgba(0, 0, 0, 0) 70%);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
@include('partials.header')
    <main class="container mx-auto px-4 py-12 max-w-7xl">
        <!-- Author Header -->
        <section class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Koleksi Karya <span class="gradient-text">{{ $author->name }}</span></h1>
            <div class="divider"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mt-4">Eksplorasi artikel dan berita terbaik yang ditulis oleh jurnalis kami</p>
        </section>
        
        <!-- Author Profile -->
        <section class="author-header mb-16 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-8">
                <div class="relative">
                    <img src="{{ asset('storage/' . $author->avatar) }}" alt="{{ $author->name }}" 
                         class="author-avatar w-40 h-40 rounded-full">
                    <div class="absolute -bottom-2 -right-2 bg-gradient-to-r from-blue-500 to-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                        <i class="fas fa-pen-fancy mr-1"></i> Penulis Profesional
                    </div>
                </div>
                <div class="text-center lg:text-left flex-1">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $author->name }}</h2>
                    <div class="flex justify-center lg:justify-start mb-4 gap-4">
                        <span class="text-gray-600 text-sm bg-gray-100 px-3 py-1 rounded-full">
                            <i class="fas fa-newspaper mr-1"></i> {{ $author->articles_count }} Artikel
                        </span>
                        <span class="text-gray-600 text-sm bg-gray-100 px-3 py-1 rounded-full">
                            <i class="fas fa-eye mr-1"></i> {{ number_format($totalViews) }}x Dilihat
                        </span>
                    </div>
                    <p class="text-gray-600 mb-4 max-w-2xl leading-relaxed">{{ $author->bio }}</p>
                </div>
            </div>
        </section>
        
        <!-- Search and Filter -->
        <section class="mb-12">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <form action="{{ route('author.show', $author->username) }}" method="GET" class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="w-full md:w-1/2 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                        <input type="text" name="search" placeholder="Cari artikel {{ $author->name }}..." value="{{ request('search') }}"
                               class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-gray-50 focus:bg-white placeholder-gray-400">
                    </div>
                    <div class="w-full md:w-auto flex gap-3">
                        <div class="relative">
                            <select name="sort" onchange="this.form.submit()" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none bg-gray-50 pr-10 cursor-pointer">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Populer</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        
        <!-- News Grid -->
        <section>
            @if($news->isEmpty())
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-blue-100 to-red-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-newspaper text-3xl text-gray-500"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada artikel</h3>
                <p class="text-gray-500 max-w-md mx-auto">{{ $author->name }} belum mempublikasikan artikel apapun.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($news as $item)
                <article class="news-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-gray-100">
                    <div class="news-image-container relative">
                        <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" 
                             class="news-image">
                        <span class="category-badge">
                            {{ $item->newsCategory->title }}
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-xs text-gray-500 mb-3">
                            <i class="far fa-clock mr-1"></i>
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                            <span class="mx-2">•</span>
                            <i class="far fa-eye mr-1"></i>
                            <span>{{ number_format($item->views) }}x</span>
                            
                        </div>
                        <h3 class="font-bold text-lg mb-3 text-gray-800 hover:text-red-600 transition-colors line-clamp-2">
                            <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 content-line-clamp">
                            {{ Str::limit(strip_tags($item->content), 150) }}
                        </p>
                        <a href="{{ route('news.show', $item->slug) }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors text-sm group">
                            Baca selengkapnya
                            <i class="fas fa-arrow-right ml-2 text-xs transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $news->onEachSide(1)->links('pagination::tailwind') }}
            </div>
            @endif
        </section>
    </main>

    @include('partials.footer')
</body>
</html>