<?php

namespace Tests\Browser;

use App\Entity\Product\Product;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UpdateQuantityTest extends DuskTestCase
{
    /** @test */
    public function item_can_updated()
    {
        $product = factory(Product::class)->create([
            'name' => 'coffee 1',
            'slug' => 'coffee1'
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/catalog/coffee1')
                    ->assertSee('coffee 1');
        });
    }
}
