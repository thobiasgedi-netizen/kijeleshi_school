<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Kijeleshi Secondary School</title>
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
            <nav class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="{{ url('/') }}" class="hover:text-green-300 transition">Home</a>
                <a href="{{ url('/about') }}" class="text-yellow-400 font-semibold transition">About Us</a>
                <a href="{{ url('/administration') }}" class="hover:text-green-300 transition">Administration</a>
                <a href="{{ url('/news') }}" class="hover:text-green-300 transition">News & Events</a>
                <a href="{{ url('/gallery') }}" class="hover:text-green-300 transition">Gallery</a>
                <a href="{{ url('/downloads') }}" class="hover:text-green-300 transition">Downloads</a>
                <a href="{{ url('/contact') }}"class="hover:text-green-300 transition">Contact Us</a>
                <a href="{{ url('/admin/login') }}" class="bg-yellow-500 hover:bg-yellow-400 text-green-950 font-bold px-3 py-1.5 rounded-lg transition text-xs uppercase tracking-wider ml-2">
                    Admin Login
                </a>
            </nav>
        </div>
    </header>

    <!-- Page Header Banner with Dynamic Image Slider (Picha 1 hadi 17) -->
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

        <!-- Dark Overlay ili maandishi yaonekane vizuri -->
        <div class="absolute inset-0 bg-black/60 z-10"></div>

        <!-- Content Juu ya Picha -->
        <div class="max-w-4xl mx-auto relative z-20">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-lg">About Kijeleshi Secondary School</h2>
            <p class="text-green-100 text-sm drop-shadow-md">Discover our history, mission, vision, and commitment to academic excellence.</p>
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

    <!-- Main Content: History & Overview -->
    <section class="py-16 px-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold">Our History & Background</span>
                <h3 class="text-3xl font-bold text-gray-900 mt-3 mb-4">Building a Strong Foundation for Future Generations</h3>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Kijeleshi Secondary School is a fully registered government secondary institution committed to delivering high-standard education, discipline, and moral values to all students. Over the years, the school has grown into a center of academic excellence and holistic development.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Equipped with dedicated teachers, modern learning environments, and active community participation, we ensure that every student is well-prepared to face national examinations and future global challenges.
                </p>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200 h-80">
                <img src="{{ asset('images/gallery/picha11.PNG') }}" alt="School Environment" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Vision, Mission & Core Values Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <!-- Vision -->
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                <div class="text-green-700 text-3xl mb-4 font-bold"></div>
                <h4 class="text-xl font-bold text-gray-900 mb-3">School Vision</h4>
                <p class="text-gray-600 text-sm leading-relaxed">
                    To Achieve High Discipline And High Academic Standard Through Commitments.
                </p>
            </div>

            <!-- Mission -->
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                <div class="text-green-700 text-3xl mb-4 font-bold"></div>
                <h4 class="text-xl font-bold text-gray-900 mb-3">School Mission</h4>
                <p class="text-gray-600 text-sm leading-relaxed">
                    To create self-awareness among teachers and Students by ensuring conducive teaching and Learning environment through quality Education for bright future.
                </p>
            </div>

            <!-- Core Values -->
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
                <div class="text-green-700 text-3xl mb-4 font-bold"></div>
                <h4 class="text-xl font-bold text-gray-900 mb-3">Core Values</h4>
                <ul class="text-gray-600 text-sm space-y-2">
                    <li>• Discipline and Integrity</li>
                    <li>• Academic Excellence</li>
                    <li>• Hard Work and Cooperation</li>
                    <li>• Respect and Responsibility</li>
                </ul>
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