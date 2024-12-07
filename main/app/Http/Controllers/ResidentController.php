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
use Carbon\Carbon;

class ResidentController extends Controller
{

public function index(Request $request)
{
    // Get the currently logged-in user's barangay_id
    $userBarangayId = Auth::user()->barangay_id;

    // Get the search query from the request
    $search = $request->input('search');

    // Get the selected filter values (Purok, Gender, and Age)
    $purokFilter = $request->input('purok_filter');
    $genderFilter = $request->input('gender_filter');
    $ageFilter = $request->input('age_filter'); // Get the selected age filter

    // Get the available households and users based on the logged-in user's barangay
    $households = Household::whereHas('user', function ($query) use ($userBarangayId) {
        $query->where('barangay_id', $userBarangayId);
    })->get();

    $puroks = Purok::where('barangay_id', $userBarangayId)->get();

    $users = User::where('barangay_id', $userBarangayId)->get();

    // Build the query for residents
    $residentsQuery = Resident::where('barangay_id', $userBarangayId);

    // Apply search filtering if a search term is provided
    if ($search) {
        $residentsQuery->where(function ($query) use ($search) {
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%");
        });
    }

    // Apply Purok filter if selected
    if ($purokFilter) {
        $residentsQuery->where('purok_id', $purokFilter);
    }

    // Apply Gender filter if selected
    if ($genderFilter) {
        $residentsQuery->where('gender', $genderFilter);
    }

    // Apply Age filter if selected
    if ($ageFilter) {
        switch ($ageFilter) {
            case 'children':
                // Filter residents between ages 0 and 12
                $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 0 AND 12');
                break;
            case 'teens':
                // Filter residents between ages 13 and 19
                $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 13 AND 19');
                break;
            case 'adults':
                // Filter residents between ages 20 and 39
                $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 20 AND 39');
                break;
            case 'middle_aged':
                // Filter residents between ages 40 and 59
                $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 40 AND 59');
                break;
            case 'senior':
                // Filter residents 60 years or older
                $residentsQuery->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 60');
                break;
        }
    }

    // Order residents by last name
    $residents = $residentsQuery->orderBy('last_name')->get()->map(function ($resident) {
        // Calculate the age based on birth_date
        $resident->age = Carbon::parse($resident->birth_date)->age;
        return $resident;
    });

    // Return the view with the residents and filter data
    return view('barangay.residents.index', compact('residents', 'search', 'puroks', 'households', 'users', 'purokFilter', 'genderFilter', 'ageFilter'));
}



    public function exportExcel()
    {
        $barangayId = auth()->user()->barangay_id;
        return Excel::download(new ResidentDataExport($barangayId), 'residents.xlsx');
    }

    
}
