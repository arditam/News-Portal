<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsPortal - Berita Terkini dan Terpercaya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Custom styles */
        .section-title {
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 4px;
            background-color: #e74c3c;
            border-radius: 2px;
        }
        
        .hero-slide::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0) 100%);
        }
        
        .news-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .category-badge {
            background-color: #e74c3c;
            transition: background-color 0.3s;
        }
        
        .news-card:hover .category-badge {
            background-color: #c0392b;
        }
        
        /* Swiper custom styles */
        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
            transition: all 0.3s ease;
        }
        
        .swiper-pagination-bullet-active {
            background: #e74c3c;
            transform: scale(1.2);
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(5px);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #e74c3c;
        }
        
        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.2rem;
            color: white;
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Mobile menu styles */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        
        #mobile-menu.show {
            max-height: 1000px;
            transition: max-height 0.5s ease-in;
        }
        
        /* Category chip styles */
        .category-chip {
            transition: all 0.3s ease;
        }
        
        .category-chip:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans leading-relaxed">
    <!-- Header -->
    @include('partials.header')

    <!-- Hero Slider -->
    <section class="relative">
        <div class="swiper heroSwiper h-[500px] md:h-[600px]">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner) 
                    @if ($banner->news)
                        <div class="swiper-slide hero-slide relative h-full">
                            <img 
                                src="{{ asset('storage/' . $banner->news->thumbnail) }}" 
                                alt="{{ $banner->news->title }}" 
                                class="w-full h-full object-cover"
                            >
                            <div class="container mx-auto absolute bottom-0 left-0 right-0 p-8 z-10">
                                <div class="hero-content max-w-2xl animate-fadeInUp">
                                    @if($banner->news->newsCategory)
                                        <span class="bg-red-600 px-4 py-1 rounded-full text-white text-sm font-semibold inline-block mb-4">
                                            {{ $banner->news->newsCategory->title }}
                                        </span>
                                    @endif

                                    <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">
                                        {{ $banner->news->title }}
                                    </h1>
                                    
                                    <div class="flex items-center mt-4 text-sm text-white/80">
                                        <img src="{{ asset('storage/' . $banner->news->author->avatar) }}" alt="{{ $banner->news->author->name }}" class="w-8 h-8 rounded-full mr-2 object-cover">
                                        <span>Oleh {{ $banner->news->author->name }}</span>
                                    </div>
                                    
                                    <p class="text-white/90 mb-6 text-sm md:text-base">
                                        {{ Str::limit(strip_tags($banner->news->content), 150) }}
                                    </p>
                                    <a href="{{ route('news.show', $banner->news->slug) }}" 
                                       class="btn bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full font-semibold inline-flex items-center transition-all duration-300 hover:shadow-lg">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="featured-news py-16 bg-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-3xl font-bold text-gray-800">Berita Terbaru</h2>
                    <p class="text-gray-500 mt-2">Update terkini dari berbagai kategori berita</p>
                </div>
                <a href="{{route('news.all')}}" class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-full text-white font-semibold transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">
                    Lihat Semua Berita <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($news as $new)
                    <article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 ease-out">
                        <a href="{{ route('news.show', $new->slug) }}" class="block h-full flex flex-col">
                            <!-- Thumbnail -->
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $new->thumbnail) }}" alt="{{ $new->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] group-hover:scale-[1.03]">
                                <!-- Kategori Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="bg-red-600 text-white text-xs font-medium px-3 py-1 rounded-full">
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
                                
                                <h3 class="text-lg font-bold mb-3 text-gray-800 group-hover:text-red-600 transition-colors duration-200">
                                    {{ $new->title }}
                                </h3>
                                
                                <p class="text-gray-500 text-sm mb-4 flex-grow">
                                    {!! \Str::limit(strip_tags($new->content), 100) !!}
                                </p>
                                
                                <!-- Author -->
                                <div class="flex items-center pt-3">
                                    @if($new->author && $new->author->avatar)
                                        <img src="{{ asset('storage/' . $new->author->avatar) }}" 
                                             alt="{{ $new->author->name }}" 
                                             class="w-8 h-8 rounded-full mr-3 object-cover group-hover:opacity-90 transition-opacity">
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
        </div>
    </section>

    <!-- Trending News -->
    <section class="trending py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-12">
                <h2 class="section-title text-3xl font-bold text-dark inline-block">Berita Pilihan Author</h2>
                <p class="text-gray-500 mt-3 max-w-2xl mx-auto">Berita pilihan Author </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featureds as $featured)
                    <a href="{{ route('news.show', $featured->slug) }}" class="trending-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <div class="trending-img h-40 overflow-hidden">
                            <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <span class="text-white bg-red-600 px-2 py-1 rounded text-xs font-semibold">{{ $featured->newsCategory->title }}</span>
                            <h3 class="text-sm font-semibold mt-1 mb-2 leading-tight">{{ $featured->title }}</h3>
                            <div class="flex justify-between items-center text-xs text-gray-400">
                                <span>{{ \Carbon\Carbon::parse($featured->created_at)->format('d M Y') }}</span>
                                <span><i class="far fa-eye mr-1"></i> {{ $featured->views }}x</span>
                            </div>
                            <div class="flex items-center mt-2 text-xs text-gray-400">
                                <img src="{{ asset('storage/' . $featured->author->avatar) }}" alt="{{ $featured->author->name }}" class="w-5 h-5 rounded-full mr-2 object-cover">
                                <span>{{ $featured->author->name }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- Categories Section -->
    <section class="categories py-16 bg-white">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-12">
                <h2 class="section-title text-3xl font-bold text-dark inline-block">Kategori Berita</h2>
                <p class="text-gray-500 mt-3">Temukan berita berdasarkan kategori yang Anda minati</p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-4">
                @foreach (\App\Models\NewsCategory::all() as $category)
                    <a href="{{ route('news.category', $category->slug) }}" 
                       class="category-chip bg-red-600 hover:bg-red-700 text-white py-3 px-6 rounded-full font-semibold transition-all shadow-md hover:shadow-lg">
                        {{ $category->title }} 
                        <span class="text-white/90">({{ $category->news->count() }})</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Author Section -->
    <section class="author-section py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-12">
                <h2 class="section-title text-3xl font-bold text-dark inline-block">Tim Jurnalis Kami</h2>
                <p class="text-gray-500 mt-3">Kenali penulis-penulis terbaik yang menghasilkan berita berkualitas</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($authors as $author)
                    <a href="{{route('author.show', $author->username)}}" class="author-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg text-center p-6">
                        <div class="author-avatar w-24 h-24 rounded-full overflow-hidden mx-auto mb-4 border-4 border-red-600/20">
                            <img src="{{ asset('storage/' . $author->avatar)}}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold">{{ $author->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">Author</p>
                        <div class="mt-4 text-sm text-gray-600">
                            <span class="bg-gray-100 px-3 py-1 rounded-full">{{$author->news->count()}} Berita</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
        // Initialize Hero Swiper
        const heroSwiper = new Swiper('.heroSwiper', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
        });

        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const searchToggle = document.getElementById('mobile-search-toggle');
            const mobileSearch = document.getElementById('mobile-search');

            // Menu toggle
            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    
                    // Toggle menu
                    mobileMenu.classList.toggle('show');
                    this.setAttribute('aria-expanded', !isExpanded);
                    
                    // Toggle icon
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-bars');
                    icon.classList.toggle('fa-times');
                    
                    // Close search if open
                    if (mobileSearch && mobileSearch.classList.contains('hidden') === false) {
                        mobileSearch.classList.add('hidden');
                        const searchIcon = searchToggle.querySelector('i');
                        searchIcon.classList.remove('fa-times');
                        searchIcon.classList.add('fa-search');
                    }
                });
            }

            // Search toggle
            if (searchToggle && mobileSearch) {
                searchToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const searchIcon = this.querySelector('i');
                    
                    // Toggle search
                    mobileSearch.classList.toggle('hidden');
                    searchIcon.classList.toggle('fa-search');
                    searchIcon.classList.toggle('fa-times');
                    
                    // Close menu if open
                    if (mobileMenu && mobileMenu.classList.contains('show')) {
                        mobileMenu.classList.remove('show');
                        const menuIcon = menuToggle.querySelector('i');
                        menuIcon.classList.remove('fa-times');
                        menuIcon.classList.add('fa-bars');
                        menuToggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Close when clicking outside
            document.addEventListener('click', function(e) {
                if (menuToggle && mobileMenu && !menuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.remove('show');
                    const menuIcon = menuToggle.querySelector('i');
                    menuIcon.classList.remove('fa-times');
                    menuIcon.classList.add('fa-bars');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
                
                if (searchToggle && mobileSearch && !searchToggle.contains(e.target) && !mobileSearch.contains(e.target)) {
                    mobileSearch.classList.add('hidden');
                    const searchIcon = searchToggle.querySelector('i');
                    searchIcon.classList.remove('fa-times');
                    searchIcon.classList.add('fa-search');
                }
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Animation on scroll
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.animate-fadeInUp');
                elements.forEach(el => {
                    const elementPosition = el.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementPosition < windowHeight - 100) {
                        el.classList.add('animate-fadeInUp');
                    }
                });
            };

            window.addEventListener('scroll', animateOnScroll);
            window.addEventListener('load', animateOnScroll);
        });
    </script>
</body>
</html>