<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Kijeleshi Secondary School</title>
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
                <a href="{{ url('/about') }}" class="hover:text-green-300 transition">About Us</a>
                <a href="{{ url('/administration') }}" class="hover:text-green-300 transition">Administration</a>
                <a href="{{ url('/news') }}" class="hover:text-green-300 transition">News & Events</a>
                <a href="{{ url('/gallery') }}" class="hover:text-green-300 transition">Gallery</a>
                <a href="{{ url('/downloads') }}" class="hover:text-green-300 transition">Downloads</a>
                <a href="{{ url('/contact') }}" class="text-yellow-400 font-semibold transition">Contact Us</a>
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
            <h2 class="text-3xl md:text-4xl font-extrabold mb-2 drop-shadow-lg">Get in Touch With Us</h2>
            <p class="text-green-100 text-sm drop-shadow-md">We would love to hear from parents, students, and the community.</p>
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

    <!-- Contact Content Section -->
    <section class="py-16 px-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <!-- Contact Info (Dynamic from Database) -->
            <div>
                <span class="bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold">Reach Us</span>
                <h3 class="text-3xl font-bold text-gray-900 mt-3 mb-6">School Office & Location</h3>
                <p class="text-gray-600 text-sm mb-8 leading-relaxed">
                    For inquiries regarding student admission, academic performance, or official matters, please reach out to us through our official contacts below or visit our offices during working hours.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 text-green-800 p-3 rounded-lg font-bold">📍</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Location</h4>
                            <p class="text-gray-600 text-sm">{{ $setting->location ?? 'Kijeleshi Secondary School, Tanzania' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 text-green-800 p-3 rounded-lg font-bold">📞</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Phone Number</h4>
                            <p class="text-gray-600 text-sm">{{ $setting->phone ?? '+255 XXX XXX XXX' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 text-green-800 p-3 rounded-lg font-bold">✉️</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Email Address</h4>
                            <p class="text-gray-600 text-sm">{{ $setting->email ?? 'info@kijeleshisec.ac.tz' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h3>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 text-sm font-medium border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ url('/contact') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Your Full Name</label>
                        <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-700 focus:outline-none text-sm" placeholder="Enter your name" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-700 focus:outline-none text-sm" placeholder="Enter your email" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Message</label>
                        <textarea name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-700 focus:outline-none text-sm" placeholder="Type your message here..." required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-green-800 hover:bg-green-900 text-white font-bold py-3 rounded-lg transition text-sm shadow">Send Message</button>
                </form>
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