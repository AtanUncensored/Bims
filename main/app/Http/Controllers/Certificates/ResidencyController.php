<?php

namespace App\Http\Controllers\Certificates;

use App\Http\Controllers\Controller;
use App\Models\CertResidency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidencyController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'gender' => 'required|string|in:Male,Female,Other',
            'reason' => 'required|string|max:255',
            'date' => 'required|date',
            'punongbarangay' => 'required|string|max:255',
            'ORnumber' => 'nullable|string|max:255', // Nullable field
            'purok_id' => 'required|exists:puroks,id', // Make sure purok_id is valid
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Store the data in the cert_residences table with the authenticated user's ID
        CertResidency::create([
            'user_id' => $user->id,
            'purok_id' => $request->purok_id,
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'reason' => $request->reason,
            'date' => $request->date,
            'punongbarangay' => $request->punongbarangay,
            'ORnumber' => $request->ORnumber,
        ]);

        // Redirect or return a response
        return redirect()->back()->with('success', 'Residence certificate request submitted successfully!');
    }
}
