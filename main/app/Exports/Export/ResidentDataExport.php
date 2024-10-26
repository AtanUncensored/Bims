<?php

namespace App\Exports\Export;

use App\Models\Resident;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class ResidentDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $residents;

    public function __construct($barangayId) {
        // Fetch residents only from the specified barangay
        $this->residents = Resident::where('barangay_id', $barangayId)->get();
    }

    public function view() : View {
        return view('barangay.export-residents.residentdetails', [
            'residents' => $this->residents
        ]);
    }
}
