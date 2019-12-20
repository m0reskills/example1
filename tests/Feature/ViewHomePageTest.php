<?php

namespace Tests\Feature;

use App\Entity\Product\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewHomePageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function home_page_loads_correctly ()
    {
        //Arrange

        //Act
        $response = $this->get('/');

        //Assert
        $response->assertStatus(200);
        $response->assertSee('Spetema');

    }
/** @test */
    public function featured_product_is_visible ()
    {
        $featuredProduct = Product::create([
            'name' => 'Boasi grand crema',
            'slug' => 'Boasi-grand-crema',
            'code' => 1221,
            'details' => 'Perfect coffee',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolor dolorem eos iusto, laudantium repudiandae similique voluptate? Ad aliquam cupiditate libero nihil nisi quis tempore, temporibus tenetur veritatis vitae voluptatibus.
',
            'price' => 3.80,
            'old_price' => 7.10,
        ])->categories()->attach(2);

        //Act
        $responce = $this->get('/');

        //Assert
        $responce->assertSee($featuredProduct->name);
        $responce->assertSee($featuredProduct->price);
    }
}
