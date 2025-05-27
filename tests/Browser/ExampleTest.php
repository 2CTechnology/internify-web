<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    public function testLandingPage()
    {
        $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->assertSee('Selamat Datang di Internify');
        });
    }

}
