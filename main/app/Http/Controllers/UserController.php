<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index() {
        return view('user.dashboard');
    }

    public function showBudgetReports()
    {
        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;

        // Fetch budget reports belonging to the user's barangay
        $budgetReports = Budget::where('barangay_id', $userBarangayId)->get();

        // Return the view with the budget reports for the user
        return view('user.index', ['budgetReports' => $budgetReports]);
    }
}

