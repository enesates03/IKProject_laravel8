<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompanyImport;
use App\Exports\CompanyExport;
use PDF;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Company::query()
            ->when($request->input('name'), fn ($query, $value) => $query->where('name', 'LIKE', '%'.$value.'%'))
            ->when($request->input('address'), fn ($query, $value) => $query->where('address', 'LIKE', '%'.$value.'%'))
            ->when($request->input('phone'), fn ($query, $value) => $query->where('phone', 'LIKE', '%'.$value.'%'))
            ->when($request->input('email'), fn ($query, $value) => $query->where('email', 'LIKE', '%'.$value.'%'))
            ->when($request->input('website'), fn ($query, $value) => $query->where('website', 'LIKE', '%'.$value.'%'))
            ->get();

        return view('company.index', ['datalist'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyFormRequest $request)
    {
        $attributes=$request->all();
        if($request->has('logo')){
            $attributes['logo']=Storage::putFile('images',$request->file('logo'));
        }
        Company::create($attributes);
        return redirect()->route('company.index')
            ->with('success', 'The company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit',['data'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyFormRequest $request, Company $company)
    {
        $attributes=$request->all();
        if($request->has('logo')){
            $attributes['logo']=Storage::putFile('images',$request->file('logo'));
        }
        $company->update($attributes);
        return redirect()->route('company.index')
            ->with('success', 'The company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $message='The company deletes successfully';
        $key='success';
        try{
            $company->delete();
        }catch (\Illuminate\Database\QueryException $e) {
            $message='The company has employees that cannot be deleted';
            $key='fail';
        }
        return redirect()->route('company.index')
            ->with($key, $message);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new CompanyExport, 'company.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExportCSV()
    {
       return Excel::download(new CompanyExport, 'company.csv');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExportPDF()
    {
        return Excel::download(new CompanyExport, 'company.pdf');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xls,xlsx'
        ]);

        try {
            $file = $request->file('file')->store('temp');
            $import = new CompanyImport;
            $import->import($file);
            if ($import->failures()->isNotEmpty()) {
                return back()->withFailures($import->failures());
            }
            $key='success';
            $message='Companies successfully created';
        }catch (\ErrorException $e ){
                $key='fail';
                $message='header error inside excel file';
        }
        return back()->with($key, $message);
}

    public function fileDowload()
    {
        $myFile = public_path("download/company_info.xlsx");
        $headers = ['Content-Type: application/xlsx'];
        $newName = 'company_info.xlsx';

        return response()->download($myFile, $newName, $headers);
    }
}
