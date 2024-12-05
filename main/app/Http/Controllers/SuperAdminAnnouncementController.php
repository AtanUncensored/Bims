<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class SuperAdminAnnouncementController extends Controller
{
    public function index()
    {
        // Fetch only global announcements
        $announcements = Announcement::where('is_global', true)->latest()->paginate(10);

        return view('lgu.announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('lgu.announcement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'announcement_date' => 'required|date',
            'expiration_date' => 'required|date|after:today',
            'content' => 'required|max:10000',
            'imgUrl' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle image upload
        if ($request->has('imgUrl')) {
            $file = $request->file('imgUrl');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'storage/announcement/';
            $file->move($path, $filename);
            $filename = 'announcement/' . $filename;
        }
    
        Announcement::create([
            'user_id' => auth()->id(),
            'barangay_id' => null, // Set to null for global announcements
            'title' => $request->title,
            'announcement_date' => $request->announcement_date,
            'expiration_date' => $request->expiration_date,
            'content' => $request->content,
            'imgUrl' => $filename,
            'is_global' => true, // Explicitly set this for superadmin announcements
        ]);
    
        return redirect()->route('superadmin.announcements.index')->with('success', 'Global announcement created successfully!');
    }
    
    public function show($announcementId)
    {
        $announcement = Announcement::findOrFail($announcementId);
        $announcements = Announcement::where('is_global', true)->latest()->paginate(10);
    
        return view('lgu.announcement.show', compact('announcements', 'announcement'));
    }

    public function updateAnnouncement(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|max:255',
            'announcement_date' => 'required|date',
            'expiration_date' => 'required|date|after_or_equal:today',
            'content' => 'required|max:10000',
            'imgUrl' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('imgUrl')) {
            $filename = $request->file('imgUrl')->store('announcement', 'public');
        } else {
            $filename = $announcement->imgUrl;
        }

        $announcement->update([
            'title' => $request->title,
            'announcement_date' => $request->announcement_date,
            'expiration_date' => $request->expiration_date,
            'content' => $request->content,
            'imgUrl' => $filename,
        ]);

        return redirect()->route('superadmin.announcements.index')->with('success', 'Announcement updated successfully.');
    }

}
