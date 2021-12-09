<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::insert([
            [
                'merchant_id'          => 1,
                'price'                => 9.99,
                'original_price'       => 99.99,
                'title'                => '苹果大放送',
                'services_phone'       => '1059928888',
                'activity_description' => '我们承诺在公司的经营活动中，对内持续提升ESG管治水平，坚持低碳运营模式，加强信息安全管理和数据隐私保护',
                'products'             => "[1]",
                'prefix'               => 'apple',
                'start_number'         => 10,
                'quantity'             => 10,
                'length'               => 8,
                'created_at'           => '2020-10-27 14:52:46',
                'updated_at'           => '2020-10-27 14:52:46',
            ],
            [
                'merchant_id'          => 1,
                'price'                => 9.99,
                'original_price'       => 99.99,
                'title'                => '西柚大放送',
                'services_phone'       => '1059928888',
                'activity_description' => '我们承诺在公司的经营活动中，对内持续提升ESG管治水平，坚持低碳运营模式，加强信息安全管理和数据隐私保护',
                'products'             => "[2]",
                'prefix'               => 'grapefruit',
                'start_number'         => 10,
                'quantity'             => 10,
                'length'               => 8,
                'created_at'           => '2020-10-27 14:52:46',
                'updated_at'           => '2020-10-27 14:52:46',
            ],
        ]);
    }
}
