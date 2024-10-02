<?php

namespace App\Http\Controllers;

use App\Models\CertResidency;
use App\Models\CertUnifast;
use App\Models\Purok;
use Illuminate\Http\Request;

class CertificateController extends Controller
{

    //Admin certificate access
    public function index() {
        $certResidencies = CertResidency::all();
        $unifastRecords = CertUnifast::all();

        // Return the view with the records
         return view('barangay.certificates.index', compact('certResidencies', 'unifastRecords'));
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
    
}
