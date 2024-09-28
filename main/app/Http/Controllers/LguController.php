<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LguController extends Controller
{
    public function index()
    {
        $barangays = Barangay::withCount('users')->orderBy('barangay_name','asc')->get();
        return view('lgu.dashboard', compact('barangays'));
    }
    public function barangaysList()
    {
        $barangays = Barangay::all();
        
        return view('lgu.barangays-list');
    }

    public function show($barangayId)
    {
        // Retrieve barangay
        $barangay = Barangay::findOrFail($barangayId);
    
        // Retrieve residents based on the barangay_id
        $residents = Resident::where('barangay_id', $barangayId)->get();
    
        // Initialize counters
        $totalUsers = $residents->count();
        $totalMales = $totalFemales = $totalAdults = $totalSeniors = $totalYouth = $totalChildren = 0;
    
        // Loop through residents and calculate the statistics
        $residents->each(function($resident) use (&$totalMales, &$totalFemales, &$totalAdults, &$totalSeniors, &$totalYouth, &$totalChildren) {
            // Gender count
            if ($resident->gender == 'Male') {
                $totalMales++;
            } elseif ($resident->gender == 'Female') {
                $totalFemales++;
            }
    
            // Calculate age once
            $age = \Carbon\Carbon::parse($resident->birth_date)->age;
    
            // Age group calculations
            if ($age >= 18) {
                $totalAdults++;
            }
            if ($age >= 60) {
                $totalSeniors++;
            }
            if ($age >= 15 && $age < 30) {
                $totalYouth++;
            }
            if ($age < 15) {
                $totalChildren++;
            }
        });
    
        // Pass data to the view
        return view('lgu.barangays-show', compact('barangay', 'totalUsers', 'totalMales', 'totalFemales', 'totalAdults', 'totalSeniors', 'totalYouth', 'totalChildren'));
    }
    

    public function edit(Barangay $barangay) {
        return view('lgu.barangay-edit', compact('barangay'));
    }

    public function update(Barangay $barangay, Request $request)
    {
        $request->validate([
            'logo'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'barangay_name'       => 'required|string|max:255',
            'background_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Handle file uploads
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/images');
            $barangay->logo = basename($logoPath);
        }
    
        if ($request->hasFile('background_image')) {
            $backgroundImagePath = $request->file('background_image')->store('public/images');
            $barangay->background_image = basename($backgroundImagePath);
        }
    
        // Update other fields
        $barangay->barangay_name = $request->input('barangay_name');
        
        $barangay->save();
    
        return redirect()->route('lgu.barangays-list')->with('success', 'Barangay updated successfully!');
    }

    public function destroy(Barangay $barangay)
    {
        $barangay->delete();

        return redirect()->route('lgu.barangays-list')->with('success', 'Barangay deleted successfully.');
    }
    
    
    
    public function admins()
    {
        $adminUsers = User::role('admin')->get();
        return view('lgu.admins', compact('adminUsers'));
    }

    public function editAdmin(User $adminUser)
    {
        return view('lgu.admins-crud.edit-barangay-admin', compact('adminUser'));
    }

    public function updateAdmin(Request $request, User $adminUser)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $adminUser->id,
            'barangay_id' => 'nullable|exists:barangays,id',
        ]);

        $adminUser->update($request->all());

        return redirect()->route('lgu.admins')->with('success', 'Barangay Admin updated successfully.');
    }

    public function destroyAdmin(User $admin)
    {
        // Delete the admin user
        $admin->delete();

        return redirect()->route('lgu.admins')->with('success', 'Barangay Admin deleted successfully.');
    }

    public function createBarangayForm()
    {   
        $barangays = Barangay::all();
        return view('lgu.create_barangay', compact('barangays'));
    }


    public function storeBarangayAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'barangay_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'barangay_id' => $request->barangay_id,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('admin'); // Assigning the 'admin' role to the created Barangay user

        return redirect()->route('lgu.create-barangay')->with('success', 'Barangay created successfully.');
    }
}

