<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\BarangayOfficial;
use App\Models\CertificateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomCertificateController extends Controller
{
    public function create()
    {
        $barangayId = auth()->user()->barangay_id;

        // Retrieve the certificate request (you might need to modify this based on your relationships)
        $certificateRequest = CertificateRequest::with('resident.purok') // Assuming there's a relationship
            ->where('user_id', auth()->id())  // Fetch request for the logged-in user
            ->firstOrFail();

        // Retrieve barangay officials
        $barangayOfficials = BarangayOfficial::with('resident')
            ->where('barangay_id', $barangayId)
            ->get();

        // Get barangay information
        $barangay = Barangay::findOrFail($barangayId);

        return view('certificates.customized', [
            'certificateRequest' => $certificateRequest,
            'barangayOfficials' => $barangayOfficials,
            'barangay' => $barangay,
        ]);
    }

    public function submit(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'certificate_name' => 'required|string|max:255',
            'certificate_body' => 'required|string|max:2000',
        ]);

        // Create a new certificate request
        CertificateRequest::create([
            'user_id' => auth()->id(),
            'certificate_name' => $validated['certificate_name'],
            'body' => $validated['certificate_body'],
        ]);

        // Redirect back with a success message
        return redirect()->route('certificates.customized')
                         ->with('success', 'Your customized certificate request has been submitted.');
    }
}
