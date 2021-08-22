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
                'type' => 'merchant-api',
                'domain' => 'api.merchant.hipi5.com',
            ],
            [
                'type' => 'shop-api',
                'domain' => 'api.shop.hipi5.com',
            ],
            [
                'type' => 'admin-api',
                'domain' => 'api.admin.hipi5.com',
            ],
        ]);
    }
}
