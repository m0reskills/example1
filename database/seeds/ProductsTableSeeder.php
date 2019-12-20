<?php

use App\Entity\Product\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
           'name' => 'Boasi grand crema',
           'slug' => 'Boasi-grand-crema',
           'code' => 1221,
           'details' => 'Perfect coffee',
           'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolor dolorem eos iusto, laudantium repudiandae similique voluptate? Ad aliquam cupiditate libero nihil nisi quis tempore, temporibus tenetur veritatis vitae voluptatibus.
',
            'price' => 3.80,
            'old_price' => 7.10,
        ])->categories()->attach(2);

        $product = Product::find(1);
        $product->categories()->attach(1);
        Product::create([
           'name' => 'Spetema classic',
           'slug' => 'Spetema-classic',
            'code' => '65a221',
            'details' => 'Awesome coffe',
           'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolor dolorem eos iusto, laudantium repudiandae similique voluptate? Ad aliquam cupiditate libero nihil nisi quis tempore, temporibus tenetur veritatis vitae voluptatibus.
',
            'price' => 2.40,
            'old_price' => 5.40,
        ])->categories()->attach(1);
        Product::create([
           'name' => 'Spetema hard',
           'slug' => 'spetema-hard',
            'code' => 2321,
            'details' => 'Wonderful coffe',
           'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolor dolorem eos iusto, laudantium repudiandae similique voluptate? Ad aliquam cupiditate libero nihil nisi quis tempore, temporibus tenetur veritatis vitae voluptatibus.
',
            'price' => 4.33,
            'old_price' => 6.55,
        ])->categories()->attach(3);
    }
}
