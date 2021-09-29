<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeFormRequest;
use App\Models\Employee;
use App\Models\Company;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

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
        //$data = Company::id();
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
        $datalist = DB::select('select * from companies where id');
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
        $datalist = DB::table('companies')->get()->where('id');
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
        //dd($request->input('firstname'));
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->phone = $request->input('phone');
        $employee->email = $request->input('email');
        $employee->company = $request->input('company');
        $employee->save();
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
}
