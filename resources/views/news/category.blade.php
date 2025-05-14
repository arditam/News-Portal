<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->title }} - NewsPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        accent: '#e74c3c',
                        dark: '#1E293B'
                    }
                }
            }
        }
    </script>
    <style>
        .news-card {
            transition: all 0.3s ease;
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            position: relative;
            display: inline-block;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: #e74c3c;
        }
        .nav-links {
            transition: all 0.3s ease;
        }
        .search-bar input:focus {
            outline: 2px solid #e74c3c;
            outline-offset: -2px;
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
@include('partials.header')

    <!-- Category Hero -->
    <div class="w-full bg-gray-100 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $category->title }}</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan berita terbaru dan terpercaya seputar {{ $category->title }}
            </p>
        </div>
    </div>

    <!-- News Grid -->
    <section class="category-news py-16">
        <div class="container mx-auto px-4 max-w-7xl">
            @if($news->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($news as $item)
                        <a href="{{ route('news.show', $item->slug) }}" 
                           class="news-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all">
                            <div class="trending-img h-40 overflow-hidden">
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                     alt="{{ $item->title }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <span class="text-accent text-xs font-semibold">
                                    {{ $item->newsCategory->title ?? 'Umum' }}
                                </span>
                                <h3 class="text-sm font-semibold mt-1 mb-2 leading-tight line-clamp-3">
                                    {{ $item->title }}
                                </h3>
                                <div class="flex justify-between items-center text-xs text-gray-400">
                                    <span>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                                    <span><i class="far fa-eye mr-1"></i> {{ $item->views ?? 0 }}x</span>
                                </div>
                                <div class="flex items-center mt-2 text-xs text-gray-400">
                                    @if($item->author && $item->author->avatar)
                                    <img src="{{ asset('storage/' . $item->author->avatar) }}" 
                                         alt="{{ $item->author->name }}" 
                                         class="w-5 h-5 rounded-full mr-2 object-cover">
                                    @else
                                    <div class="w-5 h-5 rounded-full mr-2 bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-xs text-gray-400"></i>
                                    </div>
                                    @endif
                                    <span>{{ $item->author->name ?? 'Admin' }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-500 text-lg">
                        <i class="fas fa-newspaper fa-3x mb-4"></i>
                        <p>Belum ada berita untuk kategori ini</p>
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            @if($news->count() > 0)
                <div class="w-full flex items-center justify-center gap-3 pt-12">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </section>

    @include('partials.footer')

    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if(mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>