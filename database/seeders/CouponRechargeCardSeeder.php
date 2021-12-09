<?php

namespace Database\Seeders;

use App\Models\RechargeCard;
use Illuminate\Database\Seeder;

class CouponRechargeCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RechargeCard::insert([
            [
                'merchant_id'          => '1',
                'name'                 => '水果一',
                'price'                => '99.99',
                'denomination'         => '199.99',
                'activity_description' => '<div>This is description</div>>',
                'type'                 => 1,
                'is_online'            => null,
            ],
            [
                'merchant_id'          => '1',
                'name'                 => '水果二',
                'price'                => '99.99',
                'denomination'         => '199.99',
                'activity_description' => '<div>This is description</div>>',
                'type'                 => 2,
                'is_online'            => 0,
            ],
            [
                'merchant_id'          => '1',
                'name'                 => '水果二',
                'price'                => '99.99',
                'denomination'         => '199.99',
                'activity_description' => '<div>This is description</div>>',
                'type'                 => 2,
                'is_online'            => 1,
            ],
        ]);
    }
}
