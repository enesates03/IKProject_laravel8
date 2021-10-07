<?php

namespace App\Exports;

use App\Models\Company;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CompanyIDExport implements FromView
{
    /**
    * @return view
    */
    public function view():View
    {
        return view('export.companyID',[
            'data'=>Company::all()
        ]);
    }
}
