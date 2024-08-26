<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LguController extends Controller
{
    public function index()
    {
        $barangays = Barangay::withCount('users')->get();
        return view('lgu.dashboard', compact('barangays'));
    }
    public function barangaysList()
    {
        $barangays = Barangay::all();
        
        return view('lgu.barangays-list');
    }

    public function show(Barangay $barangay)
    {
        return view('lgu.barangays-show', compact('barangay'));
    }

    public function edit(Barangay $barangay) {
        return view('lgu.barangay-edit', compact('barangay'));
    }

    public function update(Barangay $barangay, Request $request)
    {
        $request->validate([
            'logo'                => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'barangay_name'       => 'required|string|max:255',
            'address'             => 'required|string|max:255',
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
        $barangay->address = $request->input('address');
        
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

    public function createBarangayForm()
    {   
        $barangays = Barangay::all();
        return view('lgu.create_barangay', compact('barangays'));
    }


    public function storeBarangay(Request $request)
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

