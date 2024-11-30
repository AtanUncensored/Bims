<?php

namespace App\Http\Controllers;


use App\Models\Resident;
use App\Models\User;
use App\Models\Purok;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export\ResidentDataExport;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        // Get the currently logged-in user's barangay_id
        $userBarangayId = Auth::user()->barangay_id;

        // Get the search query from the request
        $search = $request->input('search');

        $households = Household::whereHas('user', function ($query) use ($userBarangayId) {
            $query->where('barangay_id', $userBarangayId);
        })->get();

        $puroks = Purok::where('barangay_id', $userBarangayId)->get();

        $users = User::where('barangay_id', $userBarangayId)->get();

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
        return view('barangay.residents.index', compact('residents', 'search', 'puroks', 'households', 'users'));
    }

    public function exportExcel()
    {
        $barangayId = auth()->user()->barangay_id;
        return Excel::download(new ResidentDataExport($barangayId), 'residents.xlsx');
    }

    
}
