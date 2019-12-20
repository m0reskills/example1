<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        Category::insert([
            ['name' => 'Laptops', 'slug' => 'laptops', 'image' => 'images/categories/1.jpg', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Desktops', 'slug' => 'desktops', 'image' => 'images/categories/1.jpg',  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mobile Phones', 'slug' => 'mobile-phones', 'image' => 'images/categories/1.jpg',  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Tablets', 'slug' => 'tablets', 'image' => 'images/categories/1.jpg',  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'TVs', 'slug' => 'tvs', 'image' => 'images/categories/1.jpg',  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Digital Cameras', 'slug' => 'digital-cameras', 'image' => 'images/categories/1.jpg',  'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Appliances', 'slug' => 'appliances', 'image' => 'images/categories/1.jpg',  'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
