<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Barangay;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::where('barangay_id', Auth::user()->barangay_id)
                                      ->orderBy('announcement_date', 'desc')
                                      ->paginate(10); 
        
        return view('barangay.announcement.index', compact('announcements'));
    }
    

    public function create()
    {
        return view('barangay.announcement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'announcement_date' => 'required|date',
            'content' => 'required',
            'imgUrl' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('imgUrl')) {
            $imagePath = $request->file('imgUrl')->store('announcements', 'public');
        }


        Announcement::create([
            'user_id' => Auth::user()->id,
            'barangay_id' => Auth::user()->barangay_id,
            'title' => $request->title,
            'announcement_date' => $request->announcement_date,
            'content' => $request->content,
            'imgUrl' => $imagePath,
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully!');
    }
}

