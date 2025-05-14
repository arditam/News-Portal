<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Semua Berita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .news-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .category-badge {
            background-color: rgba(253, 186, 116, 0.2);
            transition: background-color 0.3s;
        }
        .news-card:hover .category-badge {
            background-color: rgba(253, 186, 116, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">
@include('partials.header')

    <!-- Semua Berita -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-gray-800">Semua Berita</h1>
                    <p class="text-gray-500 mt-2">Temukan berita terkini dari berbagai kategori</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">{{ $news->total() }} Berita Ditemukan</span>
                </div>
            </div>
            
            <!-- Grid Berita -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($news as $new)
                    <article class="news-card bg-white rounded-lg overflow-hidden border border-gray-100">
                        <a href="{{ route('news.show', $new->slug) }}" class="block h-full flex flex-col">
                            <!-- Thumbnail -->
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $new->thumbnail) }}" alt="{{ $new->title }}" 
                                     class="w-full h-full object-cover transition duration-500 hover:scale-105">
                                <!-- Kategori Overlay -->
                                <div class="absolute top-3 left-3">
                                    <span class="category-badge text-red-600 text-xs font-medium px-3 py-1 rounded-full">
                                        {{ $new->newsCategory->title }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="p-5 flex-grow flex flex-col">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-xs text-gray-400">
                                        <i class="far fa-clock mr-1"></i> {{ $new->created_at->diffForHumans() }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        <i class="far fa-eye mr-1"></i> {{ $new->views }}x
                                    </span>
                                </div>
                                
                                <h3 class="text-lg font-bold mb-3 text-gray-800 hover:text-red-600 transition">
                                    {{ $new->title }}
                                </h3>
                                
                                <p class="text-gray-500 text-sm mb-4 flex-grow">
                                    {!! \Str::limit(strip_tags($new->content), 100) !!}
                                </p>
                                
                                <!-- Author -->
                                <div class="flex items-center pt-3 border-t border-gray-100">
                                    @if($new->author && $new->author->avatar)
                                        <img src="{{ asset('storage/' . $new->author->avatar) }}" 
                                             alt="{{ $new->author->name }}" 
                                             class="w-8 h-8 rounded-full mr-3 object-cover border border-gray-200">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-gray-400 text-sm"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">{{ $new->author->name ?? 'Admin' }}</p>
                                        <p class="text-xs text-gray-400">Author</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $news->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        </div>
    </section>

    @include('partials.footer')
</body>
</html>