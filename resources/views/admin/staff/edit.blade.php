<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff - Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-2xl mx-auto p-8">
        <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h1 class="text-xl font-bold text-gray-900">Edit Staff Member</h1>
                <a href="{{ url('/admin/staff') }}" class="text-xs font-bold text-green-800 hover:underline">&larr; Back to Staff List</a>
            </div>

            <form action="{{ url('/admin/staff/' . $staff->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $staff->name) }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Position / Title</label>
                    <input type="text" name="position" value="{{ old('position', $staff->position) }}" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Current Photo</label>
                    <div class="mb-2">
                        @if($staff->image)
                            <img src="{{ asset('storage/' . $staff->image) }}" class="w-16 h-16 rounded-full object-cover border">
                        @else
                            <span class="text-xs text-gray-400">No image uploaded</span>
                        @endif
                    </div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Change Photo (Optional)</label>
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Description / Duties</label>
                    <textarea name="description" rows="3" class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900">{{ old('description', $staff->description) }}</textarea>
                </div>

                <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">Update Staff Member</button>
            </form>
        </div> 
    </div>

</body>
</html>