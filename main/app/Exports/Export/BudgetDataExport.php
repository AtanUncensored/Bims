<?php

namespace App\Exports\Export;

use App\Models\Budget;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class BudgetDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $budgets;
    private $totalExpenses;


    public function __construct($barangayId) {

        $this->budgets = Budget::where('barangay_id', $barangayId)->get();

        $this->totalExpenses = $this->budgets->sum('cost');
    }

    public function view() : View {
        return view('barangay.export-budgets.budgetdetails', [
            'budgets' => $this->budgets,
            'totalExpenses' => $this->totalExpenses,
        ]);
    }
}
