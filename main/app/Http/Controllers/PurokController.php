<?php

namespace App\Http\Controllers;

use App\Models\Purok;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurokController extends Controller
{
    public function index() {

        $userBarangayId = Auth::user()->barangay_id;

        $puroks = Purok::where('barangay_id', $userBarangayId)->get();

        return view('barangay.puroks.index', compact('puroks'));
    }

    public function createPurok() {
        return view('barangay.puroks.create');
    }

    public function storePurok(Request $request) {
        $request->validate([
            'barangay_id' => 'nullable',
            'purok_name'  => 'required',
            'purok_number'=> 'required'
        ]);

        $barangayId = Auth::user()->barangay_id;

        Purok::create([
            'barangay_id' => $barangayId,
            'purok_name'  => $request->purok_name,
            'purok_number'=> $request->purok_number
        ]);


        return back();
        
    }

    public function viewPurok(Purok $purok)
    {
        // Fetch residents belonging to the specific Purok
        $residents = Resident::where('purok_id', $purok->id)->get();

        // Count total residents in that Purok
        $totalResidents = $residents->count();

        // Count male residents
        $totalMales = $residents->where('gender', 'male')->count();

        // Count female residents
        $totalFemales = $residents->where('gender', 'female')->count();

        // $totalHouseholds = $residents->pluck('household_id')->unique()->count();


        // Return the view with the data
        return view('barangay.puroks.viewPurok', compact('purok', 'totalResidents', 'totalMales', 'totalFemales', 'residents',));
    }


    

}
