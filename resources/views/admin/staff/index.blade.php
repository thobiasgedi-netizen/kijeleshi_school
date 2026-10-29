<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff - Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-7xl mx-auto p-8">
        <!-- Top Navigation Header -->
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Manage Administration & Staff</h1>
                <p class="text-xs text-gray-500">Add, edit, and manage school leadership and teachers.</p>
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
            <!-- Fomu ya Kuongeza Staff -->
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm h-fit">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Add New Staff Member</h3>
                <form action="{{ url('/admin/staff') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Full Name</label>
                        <input type="text" name="name" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="e.g. Mr. Juma Hassan">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Position / Title</label>
                        <input type="text" name="position" required class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="e.g. Headmaster">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Photo</label>
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Description / Duties</label>
                        <textarea name="description" rows="3" class="w-full px-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-green-900" placeholder="Short description..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-green-900 hover:bg-green-800 text-white py-3 rounded-xl text-xs font-bold uppercase tracking-wider transition shadow-sm">Save Staff Member</button>
                </form>
            </div>

            <!-- Orodha ya Staff Waliopo na Vitufe vya Edit/Delete -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Existing Staff List</h3>
                <div class="space-y-4">
                    @forelse($staffList as $staff)
                        <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl bg-gray-50/50">
                            <div class="flex items-center space-x-4">
                                @if($staff->image)
                                    <img src="{{ asset('storage/' . $staff->image) }}" class="w-14 h-14 rounded-full object-cover border border-gray-200 shrink-0">
                                @else
                                    <div class="w-14 h-14 bg-green-900 text-white rounded-full flex items-center justify-center font-bold text-sm shrink-0">KSS</div>
                                @endif
                                <div>
                                    <h4 class="font-bold text-gray-900 text-base">{{ $staff->name }}</h4>
                                    <p class="text-xs text-green-700 font-semibold">{{ $staff->position }}</p>
                                    @if($staff->description)
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $staff->description }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Vitufe vya Kuhariri na Kufuta -->
                            <div class="flex items-center space-x-2">
                                <a href="{{ url('/admin/staff/' . $staff->id . '/edit') }}" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-1">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>

                                <form action="{{ url('/admin/staff/' . $staff->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff member?');">
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
                            No staff members added yet. Use the form on the left to add one.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</body>
</html>