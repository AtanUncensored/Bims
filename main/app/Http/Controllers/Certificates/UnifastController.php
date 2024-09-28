<?php

namespace App\Http\Controllers\Certificates;

use App\Http\Controllers\Controller;
use App\Models\CertUnifast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class UnifastController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'address' => 'required|string|max:255',
            'parent_name' => 'required|string|max:255',
            'punong_barangay' => 'required|string|max:255',
            'secretary' => 'required|string|max:255',
            'treasurer' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'age' => 'required|string|max:255',
            'purok_name' => 'required|string|max:255',
        ]);

        // Get the authenticated user
        $user = Auth::user(); // Use the Auth facade to get the current user

        // Check if user is authenticated
        if ($user) {
            // Store the data in the cert_unifasts table with the authenticated user's ID
            CertUnifast::create(array_merge($request->all(), ['user_id' => $user->id]));

            // Redirect or return a response
            return redirect()->back()->with('success', 'Unifast certificate request submitted successfully!');
        } else {
            return redirect()->back()->with('error', 'You must be logged in to request a certificate.');
        }
    }
}
