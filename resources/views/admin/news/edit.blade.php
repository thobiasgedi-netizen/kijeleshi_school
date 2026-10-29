<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcement - Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-2xl mx-auto p-8">
        <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-xl font-bold text-gray-900">Edit Announcement</h1>
                <a href="{{ url('/admin/news') }}" class="text-xs font-bold text-green-800 hover:underline">&larr; Back to News List</a>
            </div>

            <form action="{{ url('/admin/news/' . $newsItem->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $newsItem->title) }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Change Cover Image (Optional)</label>
                    @if($newsItem->image)
                        <p class="text-xs text-green-700 mb-1">Current image exists.</p>
                    @endif
                    <input type="file" name="image" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-green-50 file:text-green-700">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Change Document (Optional)</label>
                    @if($newsItem->document)
                        <p class="text-xs text-blue-700 mb-1">Current document exists.</p>
                    @endif
                    <input type="file" name="document" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Change Video (Optional)</label>
                    @if($newsItem->video)
                        <p class="text-xs text-yellow-700 mb-1">Current video exists.</p>
                    @endif
                    <input type="file" name="video" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-yellow-50 file:text-yellow-800">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Content / Details</label>
                    <textarea name="content" rows="5" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900">{{ old('content', $newsItem->content) }}</textarea>
                </div>

                <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">Update Announcement</button>
            </form>
        </div>
    </div>

</body>
</html>