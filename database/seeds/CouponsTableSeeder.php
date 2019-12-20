<?php

use App\Coupon;
use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code' => 'ABC123',
            'type' => 'fixed',
            'value' => 2,
        ]);
        Coupon::create([
            'code' => 'ABC12',
            'type' => 'percent',
            'percent' => 5,
        ]);
    }
}
