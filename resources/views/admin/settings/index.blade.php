<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Contact Settings - Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-3xl mx-auto p-8">
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Manage School Contacts & Location</h1>
                <p class="text-xs text-gray-500">Update phone number, email address, and physical location displayed on the website.</p>
            </div>
            <a href="{{ url('/admin/dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 text-sm font-medium border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
            <form action="{{ url('/admin/settings') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">School Location / Address</label>
                    <input type="text" name="location" value="{{ old('location', $setting->location ?? '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $setting->phone ?? '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="+255 XXX XXX XXX">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $setting->email ?? '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="info@kijeleshiss.ac.tz">
                </div>

                <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white py-3.5 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">
                    Save Changes
                </button>
            </form>
        </div>
    </div>

</body>
</html>