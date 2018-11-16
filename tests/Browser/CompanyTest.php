<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompanyTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCompanyPages()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/companies')->assertTitle('View all Companies');

            $browser->visit('/companies/create')
                ->type('name', 'Company 1')
                ->click('@submit')
                ->assertPathIs('/companies')	;
        });
    }
}
