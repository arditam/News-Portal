<!-- Footer -->
<footer class="bg-gray-900 text-white pt-12 pb-6">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Logo & Deskripsi -->
            <div>
                <div class="flex items-center mb-4">
                    <span class="bg-red-600 text-white p-2 rounded mr-3">
                        <i class="fas fa-newspaper"></i>
                    </span>
                    <h3 class="text-xl font-bold  text-whitw">News<span class="text-red-600">Portal</h3>
                </a>
                </div>
                <p class="text-gray-400 text-sm mb-4">
                Portal berita terpercaya menyajikan informasi aktual dan akurat dari berbagai bidang seperti politik, teknologi, hiburan, dan lainnya.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Kategori -->
            <div>
                <h4 class="font-semibold mb-4 text-lg border-b pb-2 border-gray-700">Kategori</h4>
                <ul class="space-y-2">
                    @foreach(\App\Models\NewsCategory::all()->take(5) as $cat)
                        <li>
                            <a href="{{ route('news.category', $cat->slug) }}" 
                               class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center">
                                <i class="fas fa-chevron-right text-xs mr-2 text-red-500"></i>
                                {{ $cat->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Kontak Kami -->
            <div>
                <h4 class="font-semibold mb-4 text-lg border-b pb-2 border-gray-700">Kontak Kami</h4>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-red-500 flex-shrink-0"></i>
                        <span>Gg. Zaitun Sabrie</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt mr-3 text-red-500"></i>
                        <span>0812-3456-7890</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-red-500"></i>
                        <span>info@newsportal.com</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-clock mr-3 text-red-500"></i>
                        <span>Senin-Jumat: 08:00 - 17:00 WIB</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} NewsPortal. All rights reserved.</p>
        </div>
    </div>
</footer>