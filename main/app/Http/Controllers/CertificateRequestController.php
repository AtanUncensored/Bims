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

        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'certificate_type_id' => 'required|exists:certificate_types,id',
            'requester_name' => 'nullable|string|max:255',
            'purpose' => 'nullable|string|max:255',
            'date_needed' => 'nullable|date',
        ]);
    

        $resident = Resident::find($validated['resident_id']);
        $fullName = $resident->first_name . ' ' . $resident->last_name . ' ' . $resident->suffix;
        $birthDate = $resident->birth_date;
        $age = \Carbon\Carbon::parse($birthDate)->age;
    

        $barangayId = Auth::user()->barangay_id;
    

        CertificateRequest::create([
            'user_id' => Auth::user()->id,
            'resident_id' => $validated['resident_id'],
            'certificate_type_id' => $validated['certificate_type_id'],
            'requester_name' => $validated['requester_name'] ?? Auth::user()->name,
            'purpose' => $validated['purpose'],
            'date_needed' => $validated['date_needed'],
            'barangay_id' => $barangayId,
        ]);
    
        $certificateType = CertificateType::find($validated['certificate_type_id']);
        $tableName = $certificateType->table_name;
    
        $commonData = [
            'user_id' => Auth::user()->id,
            'resident_id' => $validated['resident_id'],
            'name' => $fullName,
            'age' => $age,
            'civil_status' => $resident->civil_status,
            'gender' => $resident->gender,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    
        if (in_array($tableName, ['cert_indigencies', 'cert_job_seekers', 'cert_unifast', 'cert_unemployment', 'cert_business'])) {
            DB::table($tableName)->insert($commonData);
        } elseif ($tableName == 'cert_residences') {
            DB::table($tableName)->insert(array_merge($commonData, [
                'date' => now(),
            ]));
        }
    
        $certificateName = $certificateType->certificate_name;

        return redirect()->back()->with('success', "You have successfully requested a $certificateName certificate.");
    }
    

    
    
}
