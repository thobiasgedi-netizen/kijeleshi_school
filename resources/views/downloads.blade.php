<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloads - Kijeleshi Secondary School</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN kwa ajili ya Slider -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Header / Navigation -->
    <header class="bg-green-900 text-white shadow-md relative z-20">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-white text-green-900 font-bold p-2 rounded-lg text-xl">KSS</div>
                <div>
                    <h1 class="text-lg font-bold tracking-wide">KIJELESHI SECONDARY SCHOOL</h1>
                    <p class="text-xs text-green-200">Government Secondary School - We Strive to Build The Future</p>
                </div>
            </div>
            <nav class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="{{ url('/') }}" class="hover:text-green-300 transition">Home</a>
                <a href="{{ url('/about') }}" class="hover:text-green-300 transition">About Us</a>
                <a href="{{ url('/administration') }}" class="hover:text-green-300 transition">Administration</a>
                <a href="{{ url('/news') }}" class="hover:text-green-300 transition">News & Events</a>
                <a href="{{ url('/gallery') }}" class="hover:text-green-300 transition">Gallery</a>
                <a href="{{ url('/downloads') }}" class="text-yellow-400 font-semibold transition">Downloads</a>
                <a href="{{ url('/contact') }}" class="hover:text-green-300 transition">Contact Us</a>
                <a href="{{ url('/admin/login') }}" class="bg-yellow-500 hover:bg-yellow-400 text-green-950 font-bold px-3 py-1.5 rounded-lg transition text-xs uppercase tracking-wider ml-2">
                    Admin Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Page Header Banner with Dynamic Image Slider -->
    <section 
        x-data="{ 
            activeSlide: 0, 
            slides: [
                @for ($i = 1; $i <= 17; $i++)
                    '{{ asset('images/slider/picha' . $i . '.jpeg') }}',
                @endfor
            ]
        }" 
        x-init="setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)"
        class="relative bg-green-900 text-white py-20 px-4 text-center overflow-hidden min-h-[350px] flex items-center justify-center">

        <!-- Background Images Carousel -->
        <template x-for="(slide, index) in slides" :key="index">
            <div 
                x-show="activeSlide === index"
                x-transition:enter="transition opacity ease-in-out duration-1000"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition opacity ease-in-out duration-1000"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-cover bg-center"
                :style="`background-image: url('${slide}');`"
            ></div>
        </template>

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/60 z-10"></div>

        <!-- Content -->
        <div class="max-w-4xl mx-auto relative z-20">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-lg">Downloads & Documents</h2>
            <p class="text-green-100 text-sm drop-shadow-md">Access joining instructions, school forms, and official announcements.</p>
        </div>

        <!-- Indicator Dots -->
        <div class="absolute bottom-4 z-20 flex space-x-1 overflow-x-auto max-w-full px-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button 
                    @click="activeSlide = index" 
                    :class="activeSlide === index ? 'bg-yellow-400 w-4' : 'bg-white/50 w-2'" 
                    class="h-2 rounded-full transition-all duration-300">
                </button>
            </template>
        </div>
    </section>

    <!-- Downloads Content Section -->
    <section class="py-16 px-4 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold">Official Files</span>
            <h3 class="text-3xl font-bold text-gray-900 mt-3 mb-2">Available Documents</h3>
            <p class="text-gray-600 text-sm">Downloadable forms and instructions uploaded by the school administration.</p>
        </div>

        <!-- Dynamic Downloads List -->
        <div class="max-w-4xl mx-auto space-y-4">
            @isset($downloadsList)
                @forelse($downloadsList as $item)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:shadow-md transition">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-700 rounded-xl flex items-center justify-center text-xl font-bold shrink-0">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-base mb-1">{{ $item->title }}</h4>
                                <div class="flex flex-wrap items-center gap-3">
                                    <span class="bg-green-100 text-green-800 text-[10px] font-bold px-2 py-0.5 rounded">{{ $item->category }}</span>
                                    <span class="text-xs text-gray-500 font-medium">
                                        <i class="fa-regular fa-clock mr-1 text-gray-400"></i> Posted on: {{ $item->created_at->format('d M, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="w-full sm:w-auto bg-green-900 hover:bg-green-800 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition flex items-center justify-center space-x-2 shadow-sm shrink-0">
                            <i class="fa-solid fa-download"></i>
                            <span>Download File</span>
                        </a>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-2xl border border-gray-200 shadow-sm">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                            <i class="fa-solid fa-folder-open"></i>
                        </div>
                        <p class="text-lg font-bold text-gray-800">No Documents Available</p>
                        <p class="text-xs text-gray-400 mt-1">No documents available for download at the moment. Check back soon!</p>
                    </div>
                @endforelse
            @else
                <div class="text-center py-16 bg-white rounded-2xl border border-gray-200 shadow-sm">
                    <p class="text-gray-500 text-base">No documents available for download at the moment. Check back soon!</p>
                </div>
            @endisset
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 px-4 text-center text-sm">
        <div class="max-w-7xl mx-auto">
            <p>&copy; 2026 Kijeleshi Secondary School. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>