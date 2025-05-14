<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    
    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .prose {
            max-width: 100%;
            line-height: 1.8;
            color: #374151;
            font-size: 1.05rem;
        }
        .prose p {
            margin-bottom: 1.5em;
        }
        .prose img {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
            margin: 2em 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .prose h2 {
            font-size: 1.75em;
            font-weight: 700;
            margin: 1.75em 0 1em;
            color: #111827;
            position: relative;
            padding-bottom: 0.5em;
        }
        .prose h2:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #ef4444;
            border-radius: 3px;
        }
        .prose h3 {
            font-size: 1.4em;
            font-weight: 600;
            margin: 1.5em 0 0.75em;
            color: #111827;
        }
        .prose ul, .prose ol {
            margin-bottom: 1.5em;
            padding-left: 1.75em;
        }
        .prose ul {
            list-style-type: disc;
        }
        .prose ol {
            list-style-type: decimal;
        }
        .prose li {
            margin-bottom: 0.75em;
            padding-left: 0.5em;
        }
        .prose a {
            color: #ef4444;
            text-decoration: underline;
        }
        .prose blockquote {
            border-left: 4px solid #ef4444;
            padding-left: 1.5em;
            margin: 2em 0;
            font-style: italic;
            color: #4b5563;
        }
        .transition {
            transition: all 0.3s ease;
        }
        .shadow-soft {
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
@include('partials.header')
    <!-- Detail Berita -->
    <div class="container mx-auto px-4 lg:px-14 mt-10 max-w-7xl">

        <!-- Meta Info -->
        <div class="mb-8">
            <div class="font-bold text-2xl lg:text-3xl mb-4 leading-tight text-gray-900">
                <h1>{{ $news->title }}</h1>
            </div>
            <div class="flex flex-wrap items-center gap-4 mb-6 text-sm text-gray-500">
                <div class="flex items-center gap-2">
                    <i class="fas fa-user text-red-500"></i>
                    <span>{{ $news->author->name }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="far fa-clock text-red-500"></i>
                    <span>{{ $news->formatted_date }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="far fa-eye text-red-500"></i>
                    <span>{{ $news->views }}x dilihat</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-tag text-red-500"></i>
                    <span>{{ $news->newsCategory->title }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row w-full gap-10">
            
            <!-- Berita Utama -->
            <div class="lg:w-8/12">
                <div class="overflow-hidden rounded-xl shadow-soft mb-8">
                    <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" 
                        class="w-full h-auto max-h-[32rem] object-cover hover:scale-105 transition duration-500">
                </div>
                
                <article class="prose max-w-none bg-white p-6 lg:p-8 rounded-xl shadow-soft">
                    {!! $news->content !!}
                </article>

                <!-- Tags -->
                @if($news->tags)
                <div class="mt-8 bg-white p-6 rounded-xl shadow-soft">
                    <h3 class="font-semibold text-lg mb-4 text-gray-800">Tags:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $news->tags) as $tag)
                            <span class="bg-gray-100 hover:bg-red-100 text-gray-800 hover:text-red-600 text-sm px-4 py-2 rounded-full transition">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-4/12 flex flex-col gap-10">
                <!-- Berita Terbaru -->
                <div class="sticky top-24 z-40">
                    <div class="bg-white p-6 rounded-xl shadow-soft">
                        <h2 class="font-bold mb-6 text-xl text-gray-900 border-b pb-3 border-gray-100">Berita Lainnya</h2>

                        <div class="flex flex-col gap-5">
                            @foreach ($newests as $new)
                            <a href="{{ route('news.show', $new->slug) }}" class="group">
                                <div class="relative flex gap-3 group-hover:border-red-500 p-3 rounded-xl bg-white transition-all duration-300 shadow-sm hover:shadow-md border border-gray-100">
                                    <div class="absolute top-2 left-2 bg-red-600 text-white text-xs font-medium rounded-full px-3 py-1">
                                        {{ $new->newsCategory->title }}
                                    </div>
                                    <div class="w-1/3 overflow-hidden rounded-lg">
                                        <img src="{{ asset('storage/' . $new->thumbnail) }}" alt="{{ $new->title }}"
                                            class="h-full w-full object-cover aspect-square group-hover:scale-105 transition duration-300">
                                    </div>
                                    <div class="w-2/3">
                                        <h3 class="font-bold text-sm text-gray-900 group-hover:text-red-600 transition line-clamp-2">
                                            {{ $new->title }}
                                        </h3>
                                        <p class="text-gray-500 mt-2 text-xs line-clamp-2">
                                            {{ \Str::limit(str_replace('&nbsp;', ' ', strip_tags($new->content)), 60) }}
                                        </p>
                                        <div class="flex items-center mt-2 text-xs text-gray-400">
                                            <i class="far fa-clock mr-1"></i>
                                            <span>{{ \Carbon\Carbon::parse($new->created_at)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Author Section -->
    <div class="container mx-auto px-4 lg:px-14 mt-10 mb-10 max-w-7xl">
        <div class="bg-white p-6 rounded-xl shadow-soft">
            <h2 class="font-semibold text-xl lg:text-2xl mb-4 text-gray-900 border-b pb-3 border-gray-100">Tentang Penulis</h2>
            <a href="{{ route('author.show', $news->author->username) }}" class="group">
                <div class="flex flex-col lg:flex-row gap-6 items-center p-4 rounded-xl group-hover:border-red-500 transition-all duration-300 border border-gray-100">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $news->author->avatar) }}" alt="{{ $news->author->name }}"
                            class="rounded-full w-24 lg:w-28 border-4 border-red-500/20 group-hover:border-red-500/40 transition-all duration-300">
                        <div class="absolute -bottom-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full px-3 py-1">
                            <i class="fas fa-pen-fancy"></i>
                        </div>
                    </div>
                    <div class="text-center lg:text-left">
                        <h3 class="font-bold text-lg lg:text-xl text-gray-900 group-hover:text-red-600 transition mb-1">{{ $news->author->name }}</h3>
                        <p class="text-sm lg:text-base leading-relaxed text-gray-500 mb-2">
                            {{ \Str::limit($news->author->bio, 100) }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @include('partials.footer')
    
    <script>
        // Mobile menu toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('menu-toggle');
            const mobileMenu = document.createElement('div');
            
            mobileMenu.className = 'hidden bg-white shadow-lg absolute top-16 left-0 right-0 z-50';
            mobileMenu.innerHTML = `
                <div class="px-4 py-3 space-y-2">
                    @foreach(\App\Models\NewsCategory::all() as $cat)
                        <a href="{{ route('category.show', $cat->slug) }}" 
                           class="block px-3 py-2 rounded-md text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                            {{ $cat->title }}
                        </a>
                    @endforeach
                </div>
            `;
            
            document.querySelector('header').appendChild(mobileMenu);
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>