<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kijeleshi Secondary School - Official Website</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN kwa ajili ya Slider -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            <nav class="hidden md:flex space-x-6 text-sm font-medium items-center">
                <a href="{{ url('/') }}" class="text-yellow-400 font-semibold transition">Home</a>
                <a href="{{ url('/about') }}" class="hover:text-green-300 transition">About Us</a>
                <a href="{{ url('/administration') }}" class="hover:text-green-300 transition">Administration</a>
                <a href="{{ url('/news') }}" class="hover:text-green-300 transition">News & Events</a>
                <a href="{{ url('/gallery') }}" class="hover:text-green-300 transition">Gallery</a>
                <a href="{{ url('/downloads') }}" class="hover:text-green-300 transition">Downloads</a>
                <a href="{{ url('/contact') }}" class="hover:text-green-300 transition">Contact Us</a>
                
                <!-- Kitufe cha Admin Login -->
                <a href="{{ url('/admin/login') }}" class="bg-yellow-500 hover:bg-yellow-400 text-green-950 font-bold px-3 py-1.5 rounded-lg transition text-xs uppercase tracking-wider ml-2">
                    Admin Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Hero Section / Dynamic Image Slider (Picha 1 hadi 17 zinabadilika nyuma) -->
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
        class="relative bg-green-900 text-white py-24 px-4 text-center overflow-hidden min-h-[450px] flex items-center justify-center">

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

        <!-- Dark Overlay ili maandishi yaonekane vizuri -->
        <div class="absolute inset-0 bg-black/60 z-10"></div>

        <!-- Content Juu ya Picha -->
        <div class="max-w-4xl mx-auto relative z-20">
            <span class="bg-green-700/80 text-green-100 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold border border-green-500">Official School Portal</span>
            <h2 class="text-4xl md:text-5xl font-extrabold mt-4 mb-6 drop-shadow-lg">Welcome to Kijeleshi Secondary School</h2>
            <p class="text-lg text-gray-100 mb-8 max-w-2xl mx-auto drop-shadow-md">Providing quality education, discipline, and holistic development to nurture tomorrow's leaders.</p>
            <div class="space-x-4">
                <a href="{{ url('/downloads') }}" class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold px-6 py-3 rounded-lg shadow-lg transition">Download Joining Instructions</a>
                <a href="{{ url('/contact') }}" class="bg-transparent border-2 border-white hover:bg-white hover:text-green-900 text-white font-bold px-6 py-3 rounded-lg transition">Contact Us</a>
            </div>
        </div>

        <!-- Indicator Dots (Chini ya Banner) -->
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

    <!-- Welcome / Headmaster Message Section -->
    <section class="py-16 px-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-xs font-bold text-green-700 uppercase tracking-widest mb-2">Leadership Message</h3>
                <h4 class="text-3xl font-bold text-gray-900 mb-4">Welcome from the Headmaster</h4>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    We pride ourselves on offering a safe, disciplined, and conducive learning environment. Through this platform, parents, students, and the general public can easily access academic updates, school notices, and official downloads.
                </p>
                <p class="font-semibold text-gray-800">— Headmaster, Kijeleshi Secondary School</p>
            </div>
            <!-- Picha halisi imewekwa hapa -->
            <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200 h-80">
                <img src="{{ asset('images/staff/picha1.jpeg') }}" alt="Headmaster or School Environment" class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Quick Links Cards -->
    <section class="bg-gray-100 py-16 px-4">
        <div class="max-w-7xl mx-auto">
            <h3 class="text-2xl font-bold text-center text-gray-900 mb-10">Quick Services</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">
                    <div class="text-green-700 text-3xl mb-4 font-bold">📄</div>
                    <h5 class="text-xl font-bold mb-2">Downloads & Joining Instructions</h5>
                    <p class="text-gray-600 text-sm mb-4">Download admission forms, school rules, academic calendars, and fee structures.</p>
                    <a href="{{ url('/downloads') }}" class="text-green-700 font-semibold text-sm hover:underline">Download now &rarr;</a>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">
                    <div class="text-green-700 text-3xl mb-4 font-bold">📢</div>
                    <h5 class="text-xl font-bold mb-2">News & Announcements</h5>
                    <p class="text-gray-600 text-sm mb-4">Stay updated with the latest school events, parent-teacher meetings, and announcements.</p>
                    <a href="{{ url('/news') }}" class="text-green-700 font-semibold text-sm hover:underline">Read news &rarr;</a>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">
                    <div class="text-green-700 text-3xl mb-4 font-bold">🖼️</div>
                    <h5 class="text-xl font-bold mb-2">School Gallery</h5>
                    <p class="text-gray-600 text-sm mb-4">Explore photos and highlights of our classrooms, science laboratories, and sports activities.</p>
                    <a href="{{ url('/gallery') }}" class="text-green-700 font-semibold text-sm hover:underline">View gallery &rarr;</a>
                </div>
            </div>
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