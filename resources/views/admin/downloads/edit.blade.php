<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Document - Admin Portal</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-2xl mx-auto p-8">
        <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-xl font-bold text-gray-900">Edit Downloadable Document</h1>
                <a href="{{ url('/admin/downloads') }}" class="text-xs font-bold text-green-800 hover:underline flex items-center space-x-1">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Downloads</span>
                </a>
            </div>

            <!-- Fomu ya Kuhariri -->
            <form action="{{ url('/admin/downloads/' . $downloadItem->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Document Title</label>
                    <input type="text" name="title" value="{{ old('title', $downloadItem->title) }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Category</label>
                    <input type="text" name="category" value="{{ old('category', $downloadItem->category) }}" class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Current File</label>
                    @if($downloadItem->file_path)
                        <div class="mb-2 flex items-center space-x-2 text-xs text-blue-700 bg-blue-50 p-2.5 rounded-xl border border-blue-100">
                            <i class="fa-solid fa-file-pdf"></i>
                            <span class="truncate">File already attached ({{ basename($downloadItem->file_path) }})</span>
                        </div>
                    @endif
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1 mt-3">Change File (Optional)</label>
                    <input type="file" name="file_path" class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">
                </div>

                <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">
                    Update Document
                </button>
            </form>
        </div>
    </div>

</body>
</html>