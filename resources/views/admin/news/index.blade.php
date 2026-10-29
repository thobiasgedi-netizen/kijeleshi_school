<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News - Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-7xl mx-auto p-8">
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Manage School News & Announcements</h1>
                <p class="text-xs text-gray-500">Publish articles, attachments, and media for the public website.</p>
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
            <!-- Fomu ya Kuongeza News -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm h-fit">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Publish New Announcement</h3>
                <form action="{{ url('/admin/news') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Title</label>
                        <input type="text" name="title" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="e.g. Opening of School Term & Instructions">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Cover Image (Optional)</label>
                        <input type="file" name="image" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Document / PDF (Optional)</label>
                        <input type="file" name="document" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Video (Optional)</label>
                        <input type="file" name="video" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-yellow-50 file:text-yellow-800">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Content / Details</label>
                        <textarea name="content" rows="4" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="Write full announcement details..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">Publish Announcement</button>
                </form>
            </div>

            <!-- Orodha ya News na vitufe vya Edit/Delete -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Published Announcements List</h3>
                <div class="space-y-4">
                    @forelse($newsList as $news)
                        <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                            <div class="flex items-center space-x-4">
                                @if($news->image)
                                    <img src="{{ asset('storage/' . $news->image) }}" class="w-14 h-14 rounded-xl object-cover border border-gray-200 shrink-0">
                                @else
                                    <div class="w-14 h-14 bg-green-900 text-white rounded-xl flex items-center justify-center font-bold text-xs shrink-0">NEWS</div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-gray-900 text-base">{{ $news->title }}</h4>
                                    <p class="text-xs text-gray-400 mt-0.5"><i class="fa-regular fa-clock mr-1"></i> {{ $news->created_at->format('d M, Y') }}</p>
                                    <div class="flex space-x-2 mt-1 text-[10px] font-bold">
                                        @if($news->document) <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded">PDF Attached</span> @endif
                                        @if($news->video) <span class="bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded">Video Attached</span> @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Vitufe vya Edit na Delete -->
                            <div class="flex items-center space-x-2">
                                <a href="{{ url('/admin/news/' . $news->id . '/edit') }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>

                                <form action="{{ url('/admin/news/' . $news->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
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
                            No announcements published yet. Use the form on the left to post one.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</body>
</html>