<?php

namespace Database\Seeders;

use App\Models\SystemDomain;
use Illuminate\Database\Seeder;

class SystemDomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemDomain::insert([
            [
                'type' => 'merchant',
                'domain' => 'api.merchant.coupon.com',
            ],
            [
                'type' => 'admin',
                'domain' => 'api.admin.coupon.com',
            ],
        ]);
    }
}
