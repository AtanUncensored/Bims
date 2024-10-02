<?php

namespace App\Http\Controllers;


use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        // Get the currently logged-in user's barangay_id
        $userBarangayId = Auth::user()->barangay_id;

        // Get the search query from the request
        $search = $request->input('search');

        // Retrieve residents that belong to the user's barangay
        // Apply search filtering if a search term is provided
        $residents = Resident::where('barangay_id', $userBarangayId)
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('last_name')
            ->get();

        // Return the view with the residents and the search term
        return view('barangay.residents.index', compact('residents', 'search'));
    }

    
}
