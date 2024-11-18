<?php

namespace App\Http\Controllers;

use App\Models\CertIndigency;
use App\Models\CertJobSeeker;
use App\Models\CertResidency;
use App\Models\CertUnifast;
use App\Models\Purok;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Request as CertificateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CertificateController extends Controller
{

    //Admin certificate access
    public function index()
    {
        $certResidencies = CertResidency::with('requests')->get();
        $certIndigencies = CertIndigency::with('requests')->get();
        $certJobSeekers = CertJobSeeker::with('requests')->get();

        return view('barangay.certificates.index', compact('certResidencies', 'certIndigencies', 'certJobSeekers'));
    }

    

    //User certificate access
    public function residencyIndex(){

        $puroks = Purok::all(); 

        return view('user.certificates.residency', compact('puroks'));
    }

    public function unifastIndex(){
        return view('user.certificates.unifast');
    }

    public function unemploymentIndex(){
        return view('user.certificates.unemployment');
    }

    public function indigencyIndex(){
        return view('user.certificates.indigency');
    }

    public function jobseekIndex(){
        return view('user.certificates.jobseek');
    }

    public function downloadCertificatePDF($certificateId)
    {
        // Retrieve the barangay ID of the authenticated user
        $barangayId = auth()->user()->barangay_id;

        // Retrieve the certificate request for the authenticated user's barangay and specified certificate
        $certificateRequest = CertificateRequest::whereHas('resident', function ($query) use ($barangayId) {
            $query->where('barangay_id', $barangayId);
        })
        ->with('resident', 'certificateType') // Ensure we load certificateType to access the name
        ->findOrFail($certificateId);

        // Get the certificate name from the certificateType relationship
        $certificateName = $certificateRequest->certificateType->certificate_name;

        // Map each certificate name to its corresponding Blade view
        $certificateViews = [
            'Residency Certificate' => 'barangay.certificates.residency-pdf',
        ];

        // Get the view based on the certificate name
        $view = $certificateViews[$certificateName] ?? 'barangay.certificates.default_certificate';

        // Prepare data for the PDF view
        $pdfData = [
            'certificateRequest' => $certificateRequest,
        ];

        // Load the view, render it to PDF, and trigger download
        $pdf = Pdf::loadView($view, $pdfData);
        return $pdf->download("{$certificateName}.pdf");
    }


    
    
}
