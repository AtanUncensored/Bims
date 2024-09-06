<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function index()
    {
        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;

        // Fetch budget reports belonging to the user's barangay
        $budgetReports = Budget::where('barangay_id', $userBarangayId)->get();

        // Return the view with the budget reports for the user
        return view('barangay.budget-report.index', ['budgetReports' => $budgetReports]);
    }

    public function createBudgetReport() {
        return view('barangay.budget-report.create_budget_report');
    }

    public function storeBudgetReport(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'item' => 'required|string|max:255',
            'cost' => 'required|string|max:255',
            'period_from' => 'required|date',
            'period_to' => 'required|date',
        ]);

        // Get the currently logged-in user's barangay
        $userBarangayId = Auth::user()->barangay_id;
        $userId = Auth::user()->id;

        // Create a new budget report and associate it with the user's barangay
        $budgetReport = new Budget($validatedData);
        $budgetReport->user_id = $userId;  // Associate report with user
        $budgetReport->barangay_id = $userBarangayId;  // Associate report with barangay
        $budgetReport->save();

        return back()->with('success', 'Budget report added successfully.');
    }
}
