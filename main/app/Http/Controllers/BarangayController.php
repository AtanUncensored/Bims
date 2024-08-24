<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BarangayController extends Controller
{
    public function index()
    {
        return view('barangay.index');
    }
    public function createUserForm()
    {
        return view('barangay.crud.create_user_account');
    }

    public function showLoginPage($id)
    {
        $barangay = Barangay::findOrFail($id);
        return view('login.barangay-login', compact('barangay'));

    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user'); // Assigning the 'user' role to the created Resident

        return redirect()->route('barangay.create-user')->with('success', 'Resident created successfully.');
    }
}

