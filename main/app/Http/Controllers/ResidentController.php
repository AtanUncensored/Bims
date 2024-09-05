<?php

namespace App\Http\Controllers;


use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    public function index()
    {
        // Get the currently logged-in user's barangay_id
        $userBarangayId = Auth::user()->barangay_id;
    
        // Retrieve all residents that belong to the user's barangay
        $residents = Resident::where('barangay_id', $userBarangayId)->get();
    
        // Return the view with the residents
        return view('barangay.residents.index', compact('residents'));
    }
    
}
