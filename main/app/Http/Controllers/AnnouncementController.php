<?php

namespace App\Http\Controllers;

use App\Events\Userlog;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Barangay;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {

        $announcements = Announcement::where(function($query) {
            $query->where('barangay_id', Auth::user()->barangay_id)
                  ->where(function($query) {
                      
                      $query->where('expiration_date', '>=', now())
                            ->orWhereNull('expiration_date');
                  });
        })
        ->orWhere('is_global', true) 
        ->orderByRaw('is_global DESC')  
        ->orderBy('created_at', 'desc') 
        ->paginate(10);
    
        return view('barangay.announcement.index', compact('announcements'));
    }
    

    public function userIndex()
    {
        $announcements = Announcement::where(function ($query) {
                $query->where('barangay_id', Auth::user()->barangay_id)
                      ->orWhereNull('barangay_id') 
                      ->orWhere('is_global', true); 
            })
            ->where(function ($query) {
                $query->where('expiration_date', '>=', now())
                      ->orWhereNull('expiration_date');
            })
            ->orderByDesc('is_global') 
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.announcement.index', compact('announcements'));
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
            'expiration_date' => 'required|date|after:today',
            'content' => 'required|max:10000',
            'imgUrl' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        
        if ($request->has('imgUrl')) {

            $file = $request->file('imgUrl');
            $extension = $file->getClientOriginalExtension();

            $filename = time() . '.' .$extension;

            $path = 'storage/announcement/';
            $file->move($path, $filename);

            $filename = 'announcement/' . $filename;


        }


        Announcement::create([
            'user_id' => Auth::user()->id,
            'barangay_id' => Auth::user()->barangay_id,
            'title' => $request->title,
            'announcement_date' => $request->announcement_date,
            'expiration_date' => $request->expiration_date,
            'content' => $request->content,
            'imgUrl' => $filename,
            'is_global' => false, 

        ]);

        $log_entry = 'Admin Added a new Announcement titled as ' . $request->title;
        event(new UserLog($log_entry));

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully!');
    }


    public function show($announcementId)
    {
        $announcement = Announcement::findOrFail($announcementId);
        $barangay = $announcement->barangay; 
    
        return view('barangay.announcement.show', compact('announcement', 'barangay'));
    }

    public function updateAnnouncement(Request $request, Announcement $announcement)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'announcement_date' => 'required|date',
        'expiration_date' => 'required|date|after_or_equal:today',
        'content' => 'required|string',
        'imgUrl' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Directory path for storing announcement images
    $storagePath = public_path('storage/announcement');

    // Ensure the directory exists
    if (!file_exists($storagePath)) {
        mkdir($storagePath, 0755, true);
    }

    if ($request->hasFile('imgUrl')) {
        // Path to the old image
        $oldImagePath = $storagePath . '/' . $announcement->imgUrl;

        // Delete the old image if it exists
        if ($announcement->imgUrl && file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        // Use the same name as the old image, or generate one if no old name exists
        $newImageName = $announcement->imgUrl ?? uniqid() . '.' . $request->file('imgUrl')->getClientOriginalExtension();

        // Move the new file to the storage directory with the same name
        $request->file('imgUrl')->move($storagePath, $newImageName);
    } else {
        // If no new image is uploaded, retain the old image name
        $newImageName = $announcement->imgUrl;
    }

    // Update the announcement record
    $announcement->update([
        'title' => $request->title,
        'announcement_date' => $request->announcement_date,
        'expiration_date' => $request->expiration_date,
        'content' => $request->content,
        'imgUrl' => $newImageName,
    ]);

    return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully!');
}



    public function expiredView()
    {
        $announcements = Announcement::where('barangay_id', Auth::user()->barangay_id)
                                ->where('expiration_date', '<', now())
                                ->orderBy('expiration_date', 'desc')
                                ->paginate(10);
    
        return view('barangay.announcement.expired', compact('announcements'));
    }

    public function userExpiredView()
    {
        $announcements = Announcement::where('barangay_id', Auth::user()->barangay_id)
        ->where('expiration_date', '<', now())
        ->orderBy('expiration_date', 'desc')
        ->paginate(10);

        return view('user.announcement.expired', compact('announcements'));
    }
    
    public function showUser($announcementId)
    {
        $announcement = Announcement::findOrFail($announcementId);
        $barangay = $announcement->barangay; 
    
        return view('user.announcement.show', compact('announcement', 'barangay'));
    }

    
}

