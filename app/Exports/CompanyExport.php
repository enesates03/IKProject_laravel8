<?php

namespace App\Exports;

use App\Models\Company;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CompanyExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        return view('export.company',[
           'datalist'=>Company::all()
        ]);
    }
}
