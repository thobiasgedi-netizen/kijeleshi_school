<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact Messages - Admin Portal</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <div class="max-w-7xl mx-auto p-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div>
                <h1 class="text-xl font-bold text-gray-900">Website Contact Messages</h1>
                <p class="text-xs text-gray-500">Read and manage inquiries sent by visitors through the contact page.</p>
            </div>
            <a href="{{ url('/admin/dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>

        <!-- Success Message Alert -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 text-sm font-medium border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <!-- Messages List Box -->
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Inbox Messages</h3>
            
            <div class="space-y-4">
                @forelse($messagesList as $msg)
                    <div class="p-5 border border-gray-100 rounded-xl bg-gray-50/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div class="space-y-1">
                            <div class="flex items-center space-x-3">
                                <h4 class="font-bold text-gray-900 text-base">{{ $msg->name }}</h4>
                                <span class="text-xs text-gray-400">
                                    <i class="fa-regular fa-clock mr-1"></i>{{ $msg->created_at->format('d M, Y - H:i') }}
                                </span>
                            </div>
                            <p class="text-xs text-green-800 font-semibold">
                                <i class="fa-solid fa-envelope mr-1"></i> {{ $msg->email }}
                            </p>
                            <p class="text-sm text-gray-700 mt-2 bg-white p-3 rounded-lg border border-gray-200">
                                {{ $msg->message }}
                            </p>
                        </div>

                        <!-- Delete Button Form -->
                        <form action="{{ url('/admin/contacts/' . $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-xl text-xs font-bold transition flex items-center space-x-1 shrink-0">
                                <i class="fa-solid fa-trash"></i>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="text-center py-12 text-gray-400 text-sm">
                        <div class="w-12 h-12 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-3 text-lg">
                            <i class="fa-solid fa-inbox"></i>
                        </div>
                        No messages received yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</body>
</html>