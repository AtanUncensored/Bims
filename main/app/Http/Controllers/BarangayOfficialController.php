<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\BarangayOfficial;
use Illuminate\Support\Facades\Auth;

class BarangayOfficialController extends Controller
{

    public function createOfficial()
    {
        // Get the residents specific to the barangay of the authenticated user
        $barangayId = Auth::user()->barangay_id;
        $residents = Resident::where('barangay_id', $barangayId)->select('id', 'first_name', 'last_name')->get();

        return view('barangay.officials.create', compact('residents'));
    }

    // Store new barangay official
    public function storeOfficial(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'position' => 'required|string|max:255',
            'committee' => 'required|string|max:255',
            'start_of_service' => 'required|date',
            'end_of_service' => 'required|date|after:start_of_service',
            'purok' => 'required|integer|between:1,7',
        ]);

        $barangayId = Auth::user()->barangay_id;

        // Create a new barangay official for the authenticated user's barangay
        BarangayOfficial::create([
            'resident_id' => $request->resident_id,
            'barangay_id' => $barangayId,
            'position' => $request->position,
            'committee' => $request->committee,
            'start_of_service' => $request->start_of_service,
            'end_of_service' => $request->end_of_service,
            'purok' => $request->purok,
        ]);

        return redirect()->route('barangay.dashboard')->with('success', 'Official added successfully.');
    }
}
