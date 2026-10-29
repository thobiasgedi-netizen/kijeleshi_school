<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kijeleshi Secondary School</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar / Left Navigation (Clean & Minimalist) -->
        <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between z-30">
            <div>
                <!-- Brand / Logo Header -->
                <div class="p-6 flex items-center space-x-3 border-b border-gray-100">
                    <div class="bg-green-900 text-white font-bold p-2.5 rounded-xl text-lg">KSS</div>
                    <div>
                        <h1 class="text-sm font-bold text-gray-900">Admin Portal</h1>
                        <p class="text-xs text-gray-500">Kijeleshi Sec. School</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1 text-sm font-medium">
                    <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-3 py-2.5 px-4 rounded-xl bg-green-50 text-green-900 font-bold transition">
                        <i class="fa-solid fa-chart-pie w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ url('/admin/news') }}" class="flex items-center space-x-3 py-2.5 px-4 rounded-xl text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">
                        <i class="fa-solid fa-newspaper w-5"></i>
                        <span>Manage News</span>
                    </a>
                    <!-- Link ya kwenda kwenye kusimamia Staff/Administration -->
                    <a href="{{ url('/admin/staff') }}" class="flex items-center space-x-3 py-2.5 px-4 rounded-xl text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">
                        <i class="fa-solid fa-chalkboard-user w-5"></i>
                        <span>Administration</span>
                    </a>
                    <a href="{{ url('/admin/gallery') }}" class="flex items-center space-x-3 py-2.5 px-4 rounded-xl text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">
                        <i class="fa-solid fa-images w-5"></i>
                        <span>Gallery</span>
                    </a>
                    <a href="{{ url('/admin/downloads') }}" class="flex items-center space-x-3 py-2.5 px-4 rounded-xl text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">
                        <i class="fa-solid fa-file-arrow-down w-5"></i>
                        <span>Downloads</span>
                    </a>
                    <a href="{{ url('/admin/contacts') }}" class="flex items-center space-x-3 py-2.5 px-4 rounded-xl text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">
                        <i class="fa-solid fa-address-book w-5"></i>
                        <span>Messages</span>
                    </a>
                    <a href="{{ url('/admin/settings') }}" class="flex items-center space-x-3 px-4 py-2.5 rounded-xl text-gray-600 hover:bg-gray-100 font-medium text-sm transition">
                         <i class="fa-solid fa-gear"></i>
                         <span>Contact Settings</span>
                    </a>
                </nav>
            </div>

            <!-- Sidebar Bottom Info -->
            <div class="p-4 border-t border-gray-100 text-xs text-gray-400 text-center">
                &copy; 2026 Kijeleshi Sec.
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50">
            
            <!-- Top Header Navbar -->
            <header class="bg-white border-b border-gray-200 py-4 px-8 flex justify-between items-center sticky top-0 z-20 shadow-sm">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Dashboard Overview</h2>
                    <p class="text-xs text-gray-500">Welcome back, here is your school website summary.</p>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-green-700 font-medium">Administrator</p>
                    </div>

                    <a href="{{ url('/') }}" target="_blank" class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-3 py-2 rounded-xl text-xs font-semibold transition flex items-center space-x-2">
                        <i class="fa-solid fa-globe"></i>
                        <span>Live Site</span>
                    </a>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm flex items-center space-x-2">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Dashboard Body Content -->
            <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">
                
                <!-- Quick Stats Cards (Zinasoma Database) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-gray-200 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Total News</p>
                            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalNews ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-200 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Staff Members</p>
                            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalStaff ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-200 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Gallery Photos</p>
                            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalGallery ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-images"></i>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-200 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Downloads Files</p>
                            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalDownloads ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                    </div>
                </div>

                <!-- Welcome Section Card -->
                <div class="bg-white border border-gray-200 p-8 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">System Control Panel</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        From this admin panel, you will be able to update school information, post announcements, upload photos to the gallery, and manage downloadable documents dynamically without editing any code.
                    </p>
                </div>

            </div>
        </main>

    </div>

</body>
</html>