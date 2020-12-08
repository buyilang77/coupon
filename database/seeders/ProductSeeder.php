<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::insert([
            [
                'merchant_id' => 1,
                'name'        => '红富士大苹果',
                'description' => '<p>Hello, Apple.</p>',
                'created_at'  => '2020-10-27 14:52:46',
                'updated_at'  => '2020-10-27 14:52:46',
            ],
            [
                'merchant_id' => 1,
                'name'        => '红心西柚',
                'description' => '<p>Hello, Grapefruit.</p>',
                'created_at'  => '2020-10-27 14:52:46',
                'updated_at'  => '2020-10-27 14:52:46',
            ],
        ]);
    }
}
