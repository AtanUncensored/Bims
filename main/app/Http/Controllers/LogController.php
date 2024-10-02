<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index() {
        $logs = auth()->user()->logs;
        return view('barangay.logs.index', compact('logs'));
    }
}
