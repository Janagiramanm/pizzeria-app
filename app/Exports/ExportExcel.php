<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportExcel implements FromView
{
   
    public function view(): View 
    {
        
        return view('livewire.reports.excel', [
            //'sales' => Sale::all()
        ]);
    }
}