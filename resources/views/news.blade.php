<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Events - Kijeleshi Secondary School</title>
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
                <a href="{{ url('/news') }}" class="text-yellow-400 font-semibold transition">News & Events</a>
                <a href="{{ url('/gallery') }}" class="hover:text-green-300 transition">Gallery</a>
                <a href="{{ url('/downloads') }}" class="hover:text-green-300 transition">Downloads</a>
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
            <h2 class="text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-lg">News & Announcements</h2>
            <p class="text-green-100 text-sm drop-shadow-md">Stay updated with the latest school news and events.</p>
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

    <!-- News Content Section -->
    <section class="py-16 px-4 max-w-7xl mx-auto">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold">Latest Updates</span>
            <h3 class="text-3xl font-bold text-gray-900 mt-3 mb-2">School Notices & Events</h3>
            <p class="text-gray-600 text-sm">Official announcements and circulars published by the school administration.</p>
        </div>

        <!-- Dynamic News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @isset($newsList)
                @forelse($newsList as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col justify-between">
                        <div>
                            <!-- Picha ya Habari / Tangazo -->
                            <div class="h-48 overflow-hidden bg-gray-100 relative">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                @else
                                    <img src="{{ asset('images/slider/picha1.jpeg') }}" alt="Default News Image" class="w-full h-full object-cover">
                                @endif

                                <!-- Beji ya NEW (Inawaka ikiwa imewekwa ndani ya siku 5 zilizopita) -->
                                @if($item->created_at->gte(now()->subDays(5)))
                                    <span class="absolute top-3 right-3 bg-red-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-md animate-pulse">
                                        NEW
                                    </span>
                                @endif
                            </div>

                            <div class="p-6">
                                <!-- Tarehe Rasmi ya Kuchapishwa -->
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-green-800 font-semibold flex items-center">
                                        <i class="fa-regular fa-clock mr-1.5"></i>
                                        {{ $item->created_at->format('d M, Y') }}
                                    </span>
                                </div>

                                <!-- Kichwa cha Habari -->
                                <h4 class="text-xl font-bold text-gray-900 mb-3">{{ $item->title }}</h4>

                                <!-- Maelezo Fupi -->
                                <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                                    {{ Str::limit($item->content, 100) }}
                                </p>
                            </div>
                        </div>

                        <!-- Sehemu ya Viambatisho (PDF / Video) na Read More -->
                        <div class="px-6 pb-6 pt-0 space-y-3">
                            @if($item->document)
                                <div>
                                    <a href="{{ asset('storage/' . $item->document) }}" target="_blank" class="inline-flex items-center space-x-1.5 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-100 transition w-full justify-center">
                                        <i class="fa-solid fa-file-pdf"></i>
                                        <span>Download PDF / Document</span>
                                    </a>
                                </div>
                            @endif

                            @if($item->video)
                                <div>
                                    <video controls class="w-full rounded-lg max-h-40 bg-black">
                                        <source src="{{ asset('storage/' . $item->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <p class="text-gray-500 text-base">No news or announcements posted yet. Check back soon!</p>
                    </div>
                @endforelse
            @else
                <div class="col-span-3 text-center py-12 bg-white rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-gray-500 text-base">No news or announcements posted yet. Check back soon!</p>
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