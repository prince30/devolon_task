<?php

namespace Tests\Unit;

use App\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Companies Routes
     *
     * @return void
     */
    public function testRoutes()
    {
        $response = $this->get(route('companies.index'));
        $response->assertStatus(200);

        $response = $this->get(route('companies.create'));
        $response->assertStatus(200);

        $company = Company::first();
        if($company!=null) {

            $response = $this->get(route('companies.show',['id'=>$company->id]));
            $response->assertStatus(200);
            $response->assertSeeText($company->name);

            $response = $this->get(route('companies.edit',['id'=>$company->id]));
            $response->assertStatus(200);
            $response->assertSeeText('Update Company');

        } else {
            $response = $this->get(route('companies.show',['id'=>2]));
            $response->assertStatus(404);

            $response = $this->get(route('companies.edit',['id'=>5]));
            $response->assertStatus(404);
        }


    }

    public function testDatabase()
    {
        $companies = factory(Company::class,10)->create();
        foreach (($companies) as $company) {
            $this->assertDatabaseHas('companies',['id'=>$company->id]);
            $this->assertDatabaseMissing('companies',['id'=>$company->id + 1000]);
        }
    }
}
