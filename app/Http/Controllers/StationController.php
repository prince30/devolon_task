<?php

namespace App\Http\Controllers;

use App\Company;
use App\Events\StationAdded;
use App\Events\StationRemoved;
use App\Jobs\DecrementStationCount;
use App\Jobs\IncrementStationCount;
use App\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations=Station::all();
        $company=Company::first();
        return view('station.index',compact('stations','company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::all();
        return view('station.create',compact('companies'));
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
            'latitude'=>'required',
            'longitude'=>'required',
            'parent_company'=>'required|integer'
        ]);

        $company=Company::find($request->parent_company);

        $station=new Station();
        $station->name=$request->name;
        $station->longitude=$request->longitude;
        $station->latitude=$request->latitude;

        $company->stations()->save($station);

        event(new StationAdded($station));

        return redirect('/stations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station)
    {
        return view('station.show',compact('station'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {
        $companies=Company::all();
        return view('station.edit',compact('station','companies'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Station $station)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'parent_company'=>'required|integer'
        ]);
        $company=Company::find($request->parent_company)->first();

        $station=new Station();
        $station->name=$request->name;
        $station->longitude=$request->longitude;
        $station->latitude=$request->latitude;

        $company->stations()->save($station);

        return redirect( route('companies.show',['id'=>$station->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station)
    {
        $station->forceDelete();
        event(new StationRemoved($station));
        return redirect(route('stations.index'));
    }
}
