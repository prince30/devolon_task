<?php

namespace Tests\Unit;

use App\Company;
use App\Station;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test Stations routes.
     *
     * @return void
     */
    public function testRoutes()
    {
        $response = $this->get(route('stations.index'));
        $response->assertStatus(200);

        $response = $this->get(route('stations.create'));
        $response->assertStatus(200);

        $station = Station::first();
        if($station!=null) {

            $response = $this->get(route('stations.show',['id'=>$station->id]));
            $response->assertStatus(200);
            $response->assertSeeText($station->name);

            $response = $this->get(route('stations.edit',['id'=>$station->id]));
            $response->assertStatus(200);
            $response->assertSeeText('Update Station');

        } else {

            $response = $this->get(route('stations.show',['id'=>2]));
            $response->assertStatus(404);

            $response = $this->get(route('stations.edit',['id'=>5]));
            $response->assertStatus(404);
        }
    }


    public function testDatabase()
    {
        $companies = factory(Company::class,3)->create()
            ->each(function ($company) {
                $company->stations()->save(factory(Station::class)->make());
            });

        foreach (($companies) as $company) {
            $this->assertDatabaseHas('stations',['id'=>$company->stations->first()->id]);
        }
    }
}
