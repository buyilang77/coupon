<?php

namespace Database\Seeders;

use App\Models\LogisticsCompany;
use Illuminate\Database\Seeder;

class LogisticsCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LogisticsCompany::insert([
            [
                'name' => '韵达快递'
            ],
            [
                'name' => '申通快递'
            ],
            [
                'name' => '圆通速递'
            ],
            [
                'name' => '中通速递'
            ],
            [
                'name' => '百世汇通'
            ],
            [
                'name' => '顺丰速运'
            ],
            [
                'name' => '京东物流'
            ],
            [
                'name' => '天天快递'
            ],
            [
                'name' => '德邦物流'
            ],
            [
                'name' => '国通快递'
            ],
        ]);
    }
}
