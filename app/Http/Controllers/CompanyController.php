<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datalist = Company::all();
        return view('company.index', ['datalist'=>$datalist]);
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
        //Company::create($request->all());
        $data = new Company;
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->email = $request->input('email');
        if($request->has('logo')){
            $data->logo = Storage::putFile('images',$request->file('logo'));}

        $data->website = $request->input('website');
        $data->save();

        return redirect()->route('company_index')
            ->with('success', 'Company created successfully.');
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
    public function edit(Company $company,$id)
    {
        $data = Company::find($id);
        return view('company.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyFormRequest $request, Company $company,$id)
    {
        $data = Company::find($id);
        $data->name = $request->input('name');
        $data->address = $request->input('address');
        $data->phone = $request->input('phone');
        $data->email = $request->input('email');
        if($request->has('logo')){
            $data->logo = Storage::putFile('images',$request->file('logo'));}
        $data->website = $request->input('website');
        $data->save();
        return redirect()->route('company_index')
            ->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company,$id)
    {
        try{
            //DB::table('Company') ->where('id','=',$id)->delete();
            $data = Company::find($id);
            $data->delete();
            return redirect()->route('company_index')
                ->with('success', 'Company deleted successfully');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('company_index')
                ->with('fail', 'The company has employees that cannot be deleted');
        }
    }
}
