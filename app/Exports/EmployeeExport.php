<?php

namespace App\Exports;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeeExport implements FromView
{
    /**
    * @return view
    */
    public function view():View
    {
        return view('export.employee',[
            'datalist'=>Employee::all(),
            'data'=>Company::all()
        ]);
    }
}
