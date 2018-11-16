<?php

namespace App\Http\Controllers;

use App\Company;
use App\Events\CompanyDeleted;
use App\Station;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=Company::paginate(10);

        return view('company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::all();
        return view('company.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $company=new Company();
        $company->name=$request->name;

        if($request->has('parent_company'))
        {
           $parent=Company::find($request->parent_company);
           $parent->addChild($company);
        }
        else{
            $company->save();
        }

        return redirect('companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $child_companies=$company->getChildren();
        return view('company.show',compact('company','child_companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $company->name=$request->name;
        $company->save();

        return redirect( route('companies.show',['id'=>$company->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company_id = $company->id;
        $parent = $company->getParent();
        $station_count = $company->station_count;
        $company->forceDelete();
        Station::where("company_id", $company_id)->delete();
        event(new CompanyDeleted($parent,$station_count));

        return redirect('/companies');
    }
}
