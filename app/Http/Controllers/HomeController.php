<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
       return view('home.index');
    }

    public function getStations(Request $request)
    {
        $validatedData = $request->validate([
            'distance' => 'required',
            'latitude'=> 'required',
            'longitude'=> 'required'
        ]);

        $latitude=$request->latitude;
        $longitude=$request->longitude;
        $distance=$request->distance;

        $nearestStationsList = DB::table('stations')->selectRaw('*, ( 3959 * acos( cos( radians( ? ) ) * 
        cos( radians( latitude ) ) * cos( radians( longitude ) - radians( ? ) ) +
        sin( radians( ? ) ) * sin( radians( latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
            ->having('distance', '<', $distance)
            ->orderBy('distance')->get();


       return view('home.nearest',compact('nearestStationsList'));


    }

}
