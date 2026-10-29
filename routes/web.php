<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Download;
use App\Models\SchoolSetting;
use App\Models\ContactMessage;

/*
|--------------------------------------------------------------------------
| Public Website Routes (Kurasa za Mbele za Tovuti)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// Ukurasa wa Administration (Unasoma data za Staff kutoka kwenye Database)
Route::get('/administration', function () {
    $staffList = Staff::all();
    return view('administration', compact('staffList'));
});

// Ukurasa wa News wa Mbele (Unasoma habari zote zilizochapishwa)
Route::get('/news', function () {
    $newsList = News::latest()->get();
    return view('news', compact('newsList'));
});

// Ukurasa wa Gallery wa Mbele
Route::get('/gallery', function () {
    $galleryList = Gallery::latest()->get();
    return view('gallery', compact('galleryList'));
});

// Ukurasa wa Downloads wa Mbele
Route::get('/downloads', function () {
    $downloadsList = Download::latest()->get();
    return view('downloads', compact('downloadsList'));
});

// Ukurasa wa Contact & Kuonyesha Taarifa za Shule kutoka Database
Route::get('/contact', function () {
    $setting = SchoolSetting::first();
    return view('contact', compact('setting'));
});

// Kuhifadhi ujumbe unaotumwa na mgeni kupitia fomu ya contact
Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    ContactMessage::create([
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->message,
    ]);

    return back()->with('success', 'Thank you! Your message has been sent successfully.');
});


/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (Kuingia na Kutoka kwenye Mfumo)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/admin/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});

Route::post('/admin/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/admin/login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Protected Routes (Zinalindwa - Lazima uwe umelogin kama Admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Admin Dashboard (Inavuta takwimu zote kutoka Database)
    Route::get('/admin/dashboard', function () {
        $totalNews = News::count();
        $totalStaff = Staff::count();
        $totalGallery = Gallery::count();
        $totalDownloads = Download::count();

        return view('admin.dashboard', compact('totalNews', 'totalStaff', 'totalGallery', 'totalDownloads'));
    });

    // ==========================================
    // 1. STAFF MANAGEMENT ROUTES
    // ==========================================
    Route::get('/admin/staff', function () {
        $staffList = Staff::all();
        return view('admin.staff.index', compact('staffList'));
    });

    Route::post('/admin/staff', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('staff', 'public');
        }

        Staff::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect('/admin/staff')->with('success', 'Staff member added successfully.');
    });

    Route::get('/admin/staff/{id}/edit', function ($id) {
        $staff = Staff::findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    });

    Route::put('/admin/staff/{id}', function (Request $request, $id) {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($staff->image && \Storage::disk('public')->exists($staff->image)) {
                \Storage::disk('public')->delete($staff->image);
            }
            $staff->image = $request->file('image')->store('staff', 'public');
        }

        $staff->name = $request->name;
        $staff->position = $request->position;
        $staff->description = $request->description;
        $staff->save();

        return redirect('/admin/staff')->with('success', 'Staff member updated successfully.');
    });

    Route::delete('/admin/staff/{id}', function ($id) {
        $staff = Staff::findOrFail($id);
        
        if ($staff->image && \Storage::disk('public')->exists($staff->image)) {
            \Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();

        return redirect('/admin/staff')->with('success', 'Staff member deleted successfully.');
    });


    // ==========================================
    // 2. NEWS & ANNOUNCEMENTS MANAGEMENT ROUTES
    // ==========================================
    Route::get('/admin/news', function () {
        $newsList = News::latest()->get();
        return view('admin.news.index', compact('newsList'));
    });

    Route::post('/admin/news', function (Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'document' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news/images', 'public');
        }

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('news/documents', 'public');
        }

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('news/videos', 'public');
        }

        News::create([
            'title' => $request->title,
            'slug' => \Illuminate\Support\Str::slug($request->title) . '-' . time(),
            'image' => $imagePath,
            'document' => $documentPath,
            'video' => $videoPath,
            'content' => $request->content,
        ]);

        return redirect('/admin/news')->with('success', 'Announcement and attachments published successfully.');
    });

    Route::get('/admin/news/{id}/edit', function ($id) {
        $newsItem = News::findOrFail($id);
        return view('admin.news.edit', compact('newsItem'));
    });

    Route::put('/admin/news/{id}', function (Request $request, $id) {
        $newsItem = News::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'document' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:20480',
        ]);

        if ($request->hasFile('image')) {
            if ($newsItem->image && \Storage::disk('public')->exists($newsItem->image)) {
                \Storage::disk('public')->delete($newsItem->image);
            }
            $newsItem->image = $request->file('image')->store('news/images', 'public');
        }

        if ($request->hasFile('document')) {
            if ($newsItem->document && \Storage::disk('public')->exists($newsItem->document)) {
                \Storage::disk('public')->delete($newsItem->document);
            }
            $newsItem->document = $request->file('document')->store('news/documents', 'public');
        }

        if ($request->hasFile('video')) {
            if ($newsItem->video && \Storage::disk('public')->exists($newsItem->video)) {
                \Storage::disk('public')->delete($newsItem->video);
            }
            $newsItem->video = $request->file('video')->store('news/videos', 'public');
        }

        $newsItem->title = $request->title;
        $newsItem->content = $request->content;
        $newsItem->save();

        return redirect('/admin/news')->with('success', 'Announcement updated successfully.');
    });

    Route::delete('/admin/news/{id}', function ($id) {
        $news = News::findOrFail($id);
        
        if ($news->image && \Storage::disk('public')->exists($news->image)) {
            \Storage::disk('public')->delete($news->image);
        }
        if ($news->document && \Storage::disk('public')->exists($news->document)) {
            \Storage::disk('public')->delete($news->document);
        }
        if ($news->video && \Storage::disk('public')->exists($news->video)) {
            \Storage::disk('public')->delete($news->video);
        }

        $news->delete();

        return redirect('/admin/news')->with('success', 'Announcement deleted successfully.');
    });


    // ==========================================
    // 3. GALLERY MANAGEMENT ROUTES
    // ==========================================
    Route::get('/admin/gallery', function () {
        $galleryList = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleryList'));
    });

    Route::post('/admin/gallery', function (Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'description' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create([
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect('/admin/gallery')->with('success', 'Photo uploaded to gallery successfully.');
    });

    Route::get('/admin/gallery/{id}/edit', function ($id) {
        $galleryItem = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('galleryItem'));
    });

    Route::put('/admin/gallery/{id}', function (Request $request, $id) {
        $galleryItem = Gallery::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($galleryItem->image && \Storage::disk('public')->exists($galleryItem->image)) {
                \Storage::disk('public')->delete($galleryItem->image);
            }
            $galleryItem->image = $request->file('image')->store('gallery', 'public');
        }

        $galleryItem->title = $request->title;
        $galleryItem->description = $request->description;
        $galleryItem->save();

        return redirect('/admin/gallery')->with('success', 'Gallery item updated successfully.');
    });

    Route::delete('/admin/gallery/{id}', function ($id) {
        $galleryItem = Gallery::findOrFail($id);
        
        if ($galleryItem->image && \Storage::disk('public')->exists($galleryItem->image)) {
            \Storage::disk('public')->delete($galleryItem->image);
        }

        $galleryItem->delete();

        return redirect('/admin/gallery')->with('success', 'Photo deleted from gallery successfully.');
    });


    // ==========================================
    // 4. DOWNLOADS MANAGEMENT ROUTES
    // ==========================================
    Route::get('/admin/downloads', function () {
        $downloadsList = Download::latest()->get();
        return view('admin.downloads.index', compact('downloadsList'));
    });

    Route::post('/admin/downloads', function (Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'file_path' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'category' => 'nullable|string|max:255',
        ]);

        $filePath = null;
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('downloads', 'public');
        }

        Download::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'category' => $request->category ?? 'General',
        ]);

        return redirect('/admin/downloads')->with('success', 'Document uploaded successfully.');
    });

    Route::get('/admin/downloads/{id}/edit', function ($id) {
        $downloadItem = Download::findOrFail($id);
        return view('admin.downloads.edit', compact('downloadItem'));
    });

    Route::put('/admin/downloads/{id}', function (Request $request, $id) {
        $downloadItem = Download::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'file_path' => 'nullable|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
            'category' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file_path')) {
            if ($downloadItem->file_path && \Storage::disk('public')->exists($downloadItem->file_path)) {
                \Storage::disk('public')->delete($downloadItem->file_path);
            }
            $downloadItem->file_path = $request->file('file_path')->store('downloads', 'public');
        }

        $downloadItem->title = $request->title;
        $downloadItem->category = $request->category ?? 'General';
        $downloadItem->save();

        return redirect('/admin/downloads')->with('success', 'Document updated successfully.');
    });

    Route::delete('/admin/downloads/{id}', function ($id) {
        $downloadItem = Download::findOrFail($id);
        
        if ($downloadItem->file_path && \Storage::disk('public')->exists($downloadItem->file_path)) {
            \Storage::disk('public')->delete($downloadItem->file_path);
        }

        $downloadItem->delete();

        return redirect('/admin/downloads')->with('success', 'Document deleted successfully.');
    });

    // ==========================================
    // 5. CONTACT MESSAGES MANAGEMENT (ADMIN)
    // ==========================================
    Route::get('/admin/contacts', function () {
        $messagesList = ContactMessage::latest()->get();
        return view('admin.contacts.index', compact('messagesList'));
    });

    Route::delete('/admin/contacts/{id}', function ($id) {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        return redirect('/admin/contacts')->with('success', 'Message deleted successfully.');
    });

    // ==========================================
    // 6. SCHOOL CONTACT SETTINGS MANAGEMENT (ADMIN)
    // ==========================================
    Route::get('/admin/settings', function () {
        $setting = SchoolSetting::firstOrCreate([
            'id' => 1
        ], [
            'location' => 'Kijeleshi Secondary School, Tanzania',
            'phone' => '+255 700 000 000',
            'email' => 'info@kijeleshisec.ac.tz'
        ]);

        return view('admin.settings.index', compact('setting'));
    });

    Route::put('/admin/settings', function (Request $request) {
        $request->validate([
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
        ]);

        $setting = SchoolSetting::first();
        if ($setting) {
            $setting->update([
                'location' => $request->location,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);
        }

        return redirect('/admin/settings')->with('success', 'Contact settings updated successfully.');
    });

});