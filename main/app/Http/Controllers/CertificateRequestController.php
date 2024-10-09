<?php

namespace App\Http\Controllers;

use App\Models\CertificateType;
use App\Models\Request as CertificateRequest;
use App\Models\Resident;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CertificateRequestController extends Controller
{
    public function create()
    {
        // Fetch all residents without filtering by barangay_id
        $residents = Resident::all();
    
        // Fetch all certificate types
        $certificateTypes = CertificateType::all();
    
        return view('certificates.request-form', compact('residents', 'certificateTypes'));
    }
    

    public function store(HttpRequest $request)
{
    // Validate the request
    $validated = $request->validate([
        'resident_id' => 'required|exists:residents,id',
        'certificate_type_id' => 'required|exists:certificate_types,id',
        'requester_name' => 'nullable|string|max:255',
        'purpose' => 'nullable|string|max:255',
        'date_needed' => 'nullable|date',
    ]);

    // Fetch the resident
    $resident = Resident::find($validated['resident_id']);
    $fullName = $resident->first_name . ' ' . $resident->last_name;

    // Calculate age from birth date
    $birthDate = $resident->birth_date; // Assuming 'birth_date' is the column name
    $age = \Carbon\Carbon::parse($birthDate)->age;

    // Save the request
    CertificateRequest::create([
        'user_id' => Auth::user()->id,
        'resident_id' => $validated['resident_id'],
        'certificate_type_id' => $validated['certificate_type_id'],
        'requester_name' => $validated['requester_name'] ?? Auth::user()->name,
        'purpose' => $validated['purpose'],
        'date_needed' => $validated['date_needed'],
    ]);

    // Insert into the correct certificate table based on the selected certificate type
    $certificateType = CertificateType::find($validated['certificate_type_id']);
    $tableName = $certificateType->table_name;

    // Check if the certificate type is 'indigency'
    if ($tableName == 'cert_indigencies') {
        DB::table($tableName)->insert([
            'user_id' => Auth::user()->id,
            'resident_id' => $validated['resident_id'],
            'name' => $fullName, // Combine first name and last name
            'age' => $age, // Insert calculated age
            'civil_status' => $resident->civil_status, // Assuming 'status' is in the resident table
            'gender' => $resident->gender, // Assuming 'gender' is in the resident table
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    } else {
        // Handle for other certificate types like 'cert_residences'
        DB::table($tableName)->insert([
            'user_id' => Auth::user()->id,
            'resident_id' => $validated['resident_id'],
            'name' => $fullName, // Combine first name and last name
            'age' => $age, // Insert calculated age
            'date' => now(), // Insert current date
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->back()->with('success', 'Certificate requested successfully.');
}

    
}
