<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Gallery - Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-7xl mx-auto p-8">
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Manage School Gallery</h1>
                <p class="text-xs text-gray-500">Upload and manage event photos for the school website.</p>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Fomu ya Kuongeza Picha -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm h-fit">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Upload New Photo</h3>
                <form action="{{ url('/admin/gallery') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Photo Title / Event</label>
                        <input type="text" name="title" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="e.g. Annual Sports Day 2026">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Select Image</label>
                        <input type="file" name="image" required class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Description (Optional)</label>
                        <textarea name="description" rows="3" class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="Short description..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">Upload Photo</button>
                </form>
            </div>

            <!-- Orodha ya Picha Zilizopo -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Existing Gallery Photos</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @forelse($galleryList as $item)
                        <div class="border border-gray-100 rounded-xl bg-gray-50/50 p-4 flex flex-col justify-between">
                            <div>
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-36 object-cover rounded-xl mb-3 border">
                                <h4 class="font-bold text-gray-900 text-sm">{{ $item->title }}</h4>
                                @if($item->description)
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $item->description }}</p>
                                @endif
                            </div>

                            <div class="flex items-center justify-end space-x-2 mt-4 pt-3 border-t border-gray-200">
                                <a href="{{ url('/admin/gallery/' . $item->id . '/edit') }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center space-x-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>

                                <form action="{{ url('/admin/gallery/' . $item->id) }}" method="POST" onsubmit="return confirm('Delete this photo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg text-xs font-bold transition flex items-center space-x-1">
                                        <i class="fa-solid fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-12 text-gray-400 text-sm">
                            No photos uploaded to gallery yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</body>
</html>