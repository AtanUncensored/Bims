<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurokController extends Controller
{
    public function index() {
        return view('barangay.puroks.index');
    }
}
