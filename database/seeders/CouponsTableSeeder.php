<?php

namespace Database\Seeders;

use App\Models\Coupon;
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
            'code' => 'FIXED10',
            'type' => 'fixed',
            'value' => 10,
        ]);

        Coupon::create([
            'code' => 'PERCENT10',
            'type' => 'percent',
            'percent_off' => 10,
        ]);
        
        Coupon::create([
            'code' => 'MIXED10',
            'type' => 'mixed',
            'value' => 10,
            'percent_off' => 10,
        ]);

        Coupon::create([
            'code' => 'REJECTED10',
            'type' => 'rejected',
            'percent_off' => 10,
            'value' => 10,
        ]);
    }
}
