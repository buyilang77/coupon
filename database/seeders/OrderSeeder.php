<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::insert([
            [
                'merchant_id'          => 1,
                'logistics_company_id' => 1,
                'tracking_number'      => '1088764440507',
                'coupon_id'            => 1,
                'code'                 => '100001',
                'product_id'           => 1,
                'consignee'            => '柯柯',
                'phone'                => '18529536820',
                'region'               => '["610000", "610100", "610113"]',
                'address'              => '瑞欣大厦',
                'status'               => 0,
                'created_at'           => '2020-12-08 10:02:36',
            ],
        ]);
    }
}
