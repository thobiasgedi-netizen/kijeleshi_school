<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Downloads - Admin Portal</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-7xl mx-auto p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Manage School Downloads</h1>
                <p class="text-xs text-gray-500">Upload and manage school circulars, joining instructions, and timetables.</p>
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
            <!-- Fomu ya Kuongeza Waraka Mpya (Upload Form) -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm h-fit">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Upload New Document</h3>
                <form action="{{ url('/admin/downloads') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Document Title</label>
                        <input type="text" name="title" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="e.g. Form One Joining Instructions 2026">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Category</label>
                        <input type="text" name="category" class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="e.g. Joining Instructions / Exam / Circular">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Select File (PDF / Word)</label>
                        <input type="file" name="file_path" required class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
                    </div>
                    <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">Upload Document</button>
                </form>
            </div>

            <!-- Orodha ya Nyaraka Zilizopo (Existing Documents List) -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Uploaded Documents List</h3>
                <div class="space-y-4">
                    @forelse($downloadsList as $item)
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 border border-gray-100 rounded-xl bg-gray-50/50 gap-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg font-bold shrink-0">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-base">{{ $item->title }}</h4>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="bg-green-100 text-green-800 text-[10px] font-bold px-2 py-0.5 rounded">{{ $item->category }}</span>
                                        <span class="text-xs text-gray-400"><i class="fa-regular fa-clock mr-1"></i>{{ $item->created_at->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Vitufe vya Vitendo (View, Edit, Delete) -->
                            <div class="flex items-center space-x-2 w-full sm:w-auto justify-end">
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-3 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-1">
                                    <i class="fa-solid fa-download"></i>
                                    <span>View</span>
                                </a>

                                <a href="{{ url('/admin/downloads/' . $item->id . '/edit') }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>

                                <form action="{{ url('/admin/downloads/' . $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this document?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-1">
                                        <i class="fa-solid fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-400 text-sm">
                            No documents uploaded yet. Use the form on the left to upload one.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</body>
</html>