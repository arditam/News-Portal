<!-- resources/views/partials/header.blade.php -->
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold text-gray-600">
                    News<span class="text-red-600">Portal</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-4 lg:space-x-6">
                <!-- Navigation Links -->
                <div class="flex space-x-4">
                    @foreach (\App\Models\NewsCategory::take(5)->get() as $category)
                        <a href="{{ route('news.category', $category->slug) }}" class="px-2 py-2 text-sm font-medium text-dark hover:text-accent transition-colors">
                            {{ $category->title }}
                        </a>
                    @endforeach
                </div>
                
                <!-- Search dan Login -->
                <div class="flex items-center gap-2">
                    <form action="{{ route('news.search') }}" method="GET" class="relative">
                        <input type="text" name="query" placeholder="Cari berita..."
                            class="border border-slate-300 rounded-full px-4 py-2 pl-8 text-sm font-normal w-40 lg:w-48 focus:outline-none focus:ring-primary focus:border-primary"
                            id="searchInput" required />
                        <!-- Icon Search -->
                        <span class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                            <img src="{{ asset('assets/img/search.png') }}" alt="search" class="w-4">
                        </span>
                    </form>
                    <a href="{{ route('filament.admin.auth.login') }}"
                        class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-full text-white font-semibold text-sm">
                        Masuk
                    </a>
                </div>
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center gap-3">
                <!-- Search Icon for Mobile -->
                <button id="mobile-search-toggle" class="p-1 text-gray-700 hover:text-accent focus:outline-none">
                    <i class="fas fa-search text-lg"></i>
                </button>
                
                <button 
                    type="button" 
                    class="p-1 rounded-md text-gray-700 hover:text-accent focus:outline-none"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                    id="menu-toggle"
                >
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </nav>
        
        <!-- Mobile Navigation -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @foreach (\App\Models\NewsCategory::take(5)->get() as $category)
                    <a href="{{ route('news.category', $category->slug) }}" class="block px-3 py-2 text-sm font-medium text-dark hover:bg-gray-100 hover:text-accent">
                        {{ $category->title }}
                    </a>
                @endforeach
                
                <div class="mt-2 px-3">
                    <a href="{{ route('filament.admin.auth.login') }}"
                        class="block w-full text-center bg-red-600 hover:bg-red-700 px-4 py-2 rounded-full text-white font-semibold text-sm">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Mobile Search Bar -->
        <div class="md:hidden hidden px-2 py-2 bg-white" id="mobile-search">
            <form action="{{ route('news.search') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="query"
                    placeholder="Cari berita..." 
                    class="block w-full pl-4 pr-10 py-2 border border-gray-300 rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent"
                    required
                >
                <button type="submit" class="absolute right-3 top-2 text-gray-500 hover:text-accent">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-menu');
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                this.setAttribute('aria-expanded', !isExpanded);
                mobileMenu.classList.toggle('hidden');
                
                // Close search if open
                const mobileSearch = document.getElementById('mobile-search');
                if (!mobileSearch.classList.contains('hidden')) {
                    mobileSearch.classList.add('hidden');
                    document.getElementById('mobile-search-toggle').querySelector('i').classList.remove('fa-times');
                    document.getElementById('mobile-search-toggle').querySelector('i').classList.add('fa-search');
                }
                
                // Toggle icon between bars and times
                const icon = this.querySelector('i');
                if (isExpanded) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                } else {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                }
            });
            
            // Close mobile menu when clicking on a link
            document.querySelectorAll('#mobile-menu a').forEach(link => {
                link.addEventListener('click', () => {
                    document.getElementById('mobile-menu').classList.add('hidden');
                    document.getElementById('menu-toggle').setAttribute('aria-expanded', 'false');
                    const icon = document.getElementById('menu-toggle').querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                });
            });
        }
        
        // Mobile search toggle
        const searchToggle = document.getElementById('mobile-search-toggle');
        if (searchToggle) {
            searchToggle.addEventListener('click', function() {
                const mobileSearch = document.getElementById('mobile-search');
                const isSearchVisible = !mobileSearch.classList.contains('hidden');
                
                mobileSearch.classList.toggle('hidden');
                
                // Close menu if open
                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    document.getElementById('menu-toggle').setAttribute('aria-expanded', 'false');
                    document.getElementById('menu-toggle').querySelector('i').classList.remove('fa-times');
                    document.getElementById('menu-toggle').querySelector('i').classList.add('fa-bars');
                }
                
                // Toggle icon between search and times
                const icon = this.querySelector('i');
                if (isSearchVisible) {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-search');
                } else {
                    icon.classList.remove('fa-search');
                    icon.classList.add('fa-times');
                }
            });
        }
    });
</script>