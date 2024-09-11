<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index() {
        return view('barangay.complaints.index');
    }

    public function userIndex() {
        return view('user.complaint.index');
    }
}
