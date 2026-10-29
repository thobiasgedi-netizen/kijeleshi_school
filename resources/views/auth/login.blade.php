<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Kijeleshi Secondary School</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md border border-gray-200">
        <div class="text-center mb-6">
            <div class="bg-green-900 text-white font-bold p-3 rounded-xl inline-block text-2xl mb-2">KSS</div>
            <h2 class="text-2xl font-bold text-gray-900">Admin Portal</h2>
            <p class="text-xs text-gray-500 mt-1">Kijeleshi Secondary School Management</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg text-sm mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/admin/login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-700 focus:outline-none text-sm" placeholder="admin@kijeleshisec.ac.tz">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-700 focus:outline-none text-sm" placeholder="********">
            </div>

            <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white font-bold py-3 rounded-lg transition text-sm shadow">Login to Dashboard</button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="text-xs text-green-700 hover:underline">&larr; Back to Public Website</a>
        </div>
    </div>

</body>
</html>