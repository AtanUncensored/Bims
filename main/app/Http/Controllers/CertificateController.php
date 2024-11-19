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
use Illuminate\Support\Facades\DB;
class CertificateController extends Controller
{
    public function index()
{
    $barangayId = Auth::user()->barangay_id;

    // Retrieve all certificate requests
    $certificateRequests = DB::table('requests')
        ->leftJoin('residents', 'requests.resident_id', '=', 'residents.id')
        ->leftJoin('certificate_types', 'requests.certificate_type_id', '=', 'certificate_types.id')
        ->select(
            'requests.id',
            'certificate_types.certificate_name as certificate_type',
            DB::raw('CONCAT(residents.first_name, " ", residents.last_name) as full_name'),
            DB::raw('YEAR(CURDATE()) - YEAR(residents.birth_date) as age'),
            'residents.gender',
            'requests.purpose',
            'requests.date_needed',
            'requests.requester_name',
            'requests.created_at',
            'requests.downloaded_at'
        )
        ->where('requests.barangay_id', $barangayId)
        ->get();

    // Group by 'latest' and 'downloaded'
    $latestRequests = $certificateRequests->whereNull('downloaded_at')->sortByDesc('created_at')->take(5); 
    $downloadedRequests = $certificateRequests->filter(function ($request) {
        return !is_null($request->downloaded_at); // Filter downloaded requests
    });

    return view('barangay.certificates.index', compact('latestRequests', 'downloadedRequests', 'certificateRequests'));
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

    public function downloadCertificatePDF(Request $request, $certificateId)
{
    // Retrieve the certificate request with the certificateType relationship
    $certificateRequest = CertificateRequest::with('certificateType')
        ->findOrFail($certificateId);

    // Get the certificate name from the certificateType relationship
    $certificateType = $certificateRequest->certificateType;

    if (!$certificateType) {
        abort(404, "The certificate request does not have a valid certificate type.");
    }

    $certificateName = $certificateType->certificate_name;

    // Map each certificate name to its corresponding Blade view
    $certificateViews = [
        'Residency Certificate'      => 'barangay.certificates.residency-pdf',
        'Job Seeker Certificate'     => 'barangay.certificates.jobseeker-pdf',
        'Indigency Certificate'      => 'barangay.certificates.indigency-pdf',
        'Unifast Certificate'        => 'barangay.certificates.unifast-pdf',
        'Unemployment Certificate'   => 'barangay.certificates.unemployment-pdf',
        'Business Certificate'       => 'barangay.certificates.business-pdf',
    ];

    // Find the view based on the certificate type
    if (!array_key_exists($certificateName, $certificateViews)) {
        abort(404, "The certificate type '{$certificateName}' does not have an associated view.");
    }

    $view = $certificateViews[$certificateName];

    // Prepare the data to pass to the view
    $pdfData = [
        'certificateRequest' => $certificateRequest,
    ];

    // Check if the view exists
    if (!view()->exists($view)) {
        abort(404, "The view for '{$certificateName}' does not exist.");
    }

    // Generate the PDF
    $pdf = Pdf::loadView($view, $pdfData);

    // Mark as downloaded (only if it hasn't been marked already)
    if (!$certificateRequest->downloaded_at) {
        $certificateRequest->downloaded_at = now();
        $certificateRequest->save();
    }
    // Create a filename including the requester's name and date
    $requesterName = $certificateRequest->requester_name ?? 'unknown'; 
    $requesterName = str_replace(' ', '_', $requesterName); 
    $currentDate = now()->format('Y-m-d'); 
    $fileName = str_replace(' ', '_', $certificateName) . "_{$requesterName}_{$currentDate}.pdf";

    // Determine if the user wants to print or download
    $action = $request->query('action', 'download'); // Default to 'download' if no query parameter is set

    if ($action === 'print') {
        // Stream the PDF to the browser for printing
        return $pdf->stream($fileName);
    }

    // Default to downloading the PDF
    return $pdf->download($fileName);
}


    
    
}
