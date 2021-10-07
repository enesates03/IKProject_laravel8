<?php

namespace App\Http\Controllers;

use App\Exports\CompanyIDExport;
use App\Exports\EmployeeExport;
use App\Http\Requests\EmployeeFormRequest;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Models\Company;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datalist = Employee::all();
        $data = DB::select('select * from companies where id');
        $query=Employee::query();
        if (request()->input('firstname')){$datalist =$query->where('firstname' , 'LIKE' ,"%".request()->input('firstname')."%")->get();}
        if (request()->input('lastname')){$datalist =$query->where('lastname' , 'LIKE' ,"%".request()->input('lastname')."%")->get();}
        if (request()->input('email')){$datalist =$query->where('email' , 'LIKE' ,"%".request()->input('email')."%")->get();}
        if (request()->input('phone')){$datalist =$query->where('phone' , 'LIKE' ,"%".request()->input('phone')."%")->get();}
        if (request()->input('company')){$datalist =$query->where('company' , 'LIKE' ,"%".request()->input('company')."%")->get();}

        return view('employee.index',['datalist'=>$datalist,'data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datalist=Company::select(['id','name'])->get();
        return view('employee.create',['datalist'=>$datalist]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeFormRequest $request)
    {
        Employee::create($request->all());
        return redirect()->route('employee.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $datalist=Company::select(['id','name'])->get();
        return view('employee.edit',['data'=>$employee,'datalist'=>$datalist]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeFormRequest $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->route('employee.index')
            ->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExport()
    {
        return Excel::download(new EmployeeExport, 'employee.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExportCompanyID()
    {
        return Excel::download(new CompanyIDExport, 'companyID.pdf');
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExportCSV()
    {
        return Excel::download(new EmployeeExport, 'employee.csv');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileExportPDF()
    {
        return Excel::download(new EmployeeExport, 'employee.pdf');
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
        $file=$request->file('file')->store('temp');
        $import=new EmployeeImport;
        $import->import($file);

        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
            $key='success';
            $message='Companies successfully created';
        }catch (\Exception $e ){
            $key='fail';
            $message='error excel file check the column';
        }
        return back()->with($key, $message);
    }

    public function fileDowload()
    {
        return Response::download('download/employee_info.xlsx');
    }

}
