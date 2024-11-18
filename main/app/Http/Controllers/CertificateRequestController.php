<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use App\Models\Household;
use App\Models\HouseholdMember;
use App\Models\Request as CertificateRequest;
use App\Models\Resident;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CertificateRequestController extends Controller
{
    public function create()
    {
        // get sa ang user 
        $userHouseholds = Household::where('user_id', Auth::id())->pluck('id');
    
        //sa mga resident nani sa household
        $residents = Resident::whereHas('householdMembers', function ($query) use ($userHouseholds) {
            $query->whereIn('household_id', $userHouseholds);
        })->get();
    
        $certificateTypes = CertificateType::all();
    
        return view('certificates.request-form', compact('residents', 'certificateTypes'));
    }
    
    

    public function store(HttpRequest $request)
{
    // Validate incoming request data
    $validated = $request->validate([
        'resident_id' => 'required|exists:residents,id',
        'certificate_type_id' => 'required|exists:certificate_types,id',
        'requester_name' => 'nullable|string|max:255',
        'purpose' => 'nullable|string|max:255',
        'date_needed' => 'nullable|date',
    ]);

    // Fetch the resident data
    $resident = Resident::find($validated['resident_id']);
    $fullName = $resident->first_name . ' ' . $resident->last_name;
    $birthDate = $resident->birth_date;
    $age = \Carbon\Carbon::parse($birthDate)->age;

    // Get the authenticated user's barangay
    $barangayId = Auth::user()->barangay_id;

    // Create a new record in the requests table
    CertificateRequest::create([
        'user_id' => Auth::user()->id,
        'resident_id' => $validated['resident_id'],
        'certificate_type_id' => $validated['certificate_type_id'], // Ensure this is included
        'requester_name' => $validated['requester_name'] ?? Auth::user()->name,
        'purpose' => $validated['purpose'],
        'date_needed' => $validated['date_needed'],
        'barangay_id' => $barangayId, // Add barangay_id
    ]);

    // Fetch the certificate type to determine the target table
    $certificateType = CertificateType::find($validated['certificate_type_id']);
    $tableName = $certificateType->table_name;

    // Insert data into the appropriate certificate table
    if ($tableName == 'cert_indigencies') {
        DB::table($tableName)->insert([
            'user_id' => Auth::user()->id,
            'resident_id' => $validated['resident_id'],
            'name' => $fullName,
            'age' => $age,
            'civil_status' => $resident->civil_status,
            'gender' => $resident->gender,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    } elseif ($tableName == 'cert_job_seekers') {
        DB::table($tableName)->insert([
            'user_id' => Auth::user()->id,
            'resident_id' => $validated['resident_id'],
            'name' => $fullName,
            'age' => $age,
            'civil_status' => $resident->civil_status,
            'gender' => $resident->gender,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    } elseif ($tableName == 'cert_residences') {
        DB::table($tableName)->insert([
            'user_id' => Auth::user()->id,
            'resident_id' => $validated['resident_id'],
            'name' => $fullName,
            'age' => $age,
            'date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    } else {
        // Handle additional certificate types here if necessary
    }

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Certificate requested successfully.');
}

    
    
}
