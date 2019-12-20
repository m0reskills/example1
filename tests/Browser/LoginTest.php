<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /** @test */
    public function user_can_login ()
    {
//        $user = factory(User::class)->create([
//            'email' => 'user@user.com'
//        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->visit('/login')
                ->assertSee('Запомнить меня')
                ->type('email', 'user@user.com')
                ->type('password', 'password1')
                ->press('ВХОД')
                ->assertPathIs('/');
        });
    }
}
