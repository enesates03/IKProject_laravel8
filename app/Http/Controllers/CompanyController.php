<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyFormRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$datalist=Company::all();
        $datalist=Company::all();
        $query=Company::query();
        //$datalist->when(request()->filter('name'),fn($query)=>$query->where('name' , '=' ,"%".request()->input('name')."%"))->get();
        /*$datalist
            ->when(request()->input('name'),fn($query)=>$query->where('name' , '=' ,request()->input('name')))
            ->get();*/
        if (request()->input('name')){$datalist =$query->where('name' , 'LIKE' ,"%".request()->input('name')."%")->get();}
        if (request()->input('address')){$datalist =$query->where('address' , 'LIKE' ,"%".request()->input('address')."%")->get();}
        if (request()->input('phone')){$datalist =$query->where('phone' , 'LIKE' ,"%".request()->input('phone')."%")->get();}
        if (request()->input('email')){$datalist =$query->where('email' , 'LIKE' ,"%".request()->input('email')."%")->get();}
        if (request()->input('website')){$datalist =$query->where('website' , 'LIKE' ,"%".request()->input('website')."%")->get();}

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
       //dd($request->input('name'));
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
        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->phone = $request->input('phone');
        $company->email = $request->input('email');
        if($request->has('logo')){
            $data->logo = Storage::putFile('images',$request->file('logo'));}
        $company->website = $request->input('website');
        $company->save();
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
        try{
            //DB::table('Company') ->where('id','=',$id)->delete();
            $company->delete();
            return redirect()->route('company.index')
                ->with('success', 'The company deleted successfully');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('company.index')
                ->with('fail', 'The company has employees that cannot be deleted');
        }
    }
}
