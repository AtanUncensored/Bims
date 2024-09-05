<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barangay;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BarangayController extends Controller
{
    public function index()
    {
        return view('barangay.dashboard');
    }
    public function createUserForm()
    {
        return view('barangay.crud.create_user_account');
    }

    public function showLoginPage($barangay_name)
    {
        // Retrieve the barangay by name
        $barangay = Barangay::where('barangay_name', $barangay_name)->firstOrFail();
    
        // Pass the barangay data to the view
        return view('login.barangay-login', compact('barangay'));
    }
    

    public function storeUser(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'purok' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'place_of_birth' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'civil_status' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'citizenship' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:residents,email',
            'current_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
        ]);

        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;

        // Create a new resident and associate it with the user's barangay
        $resident = new Resident($validatedData);
        $resident->barangay_id = $userBarangayId;
        $resident->save();

        return back()->with('success', 'Resident added successfully.');
    }
}

