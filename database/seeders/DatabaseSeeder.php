<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MerchantSeeder::class,
            SystemDomainSeeder::class,
            ProductSeeder::class,
            CouponSeeder::class,
            CouponItemSeeder::class,
        ]);
    }
}
