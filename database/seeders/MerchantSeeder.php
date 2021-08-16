<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Merchant::insert([
            [
                'username'      => 'ethan-ke',
                'surname'       => '柯柯',
                'merchant_name' => '柯柯',
                'phone'         => '18529536820',
                'password'      => '$2y$10$vSOu1mjkPiTxh6G/PBD1.u2XXyKqNHDJMCugePTnkptp2y.o6EJzO',
                'region'        => '["610000","610100","610113"]',
                'address'       => '高新一路',
                'status'        => 1,
                'created_at'    => '2020-10-27 14:52:46',
                'updated_at'    => '2020-10-27 14:52:46',
            ],
            [
                'username'      => 'snail-xian',
                'surname'       => '蜗牛',
                'merchant_name' => '西安蜗牛',
                'phone'         => '18529536820',
                'password'      => '$2y$10$tYa1pOCDSxWvb5j.e1QQRuGPtDyu0TlRTMn/0bs.VnoKWJiyOzCNy',
                'region'        => '["610000","610100","610113"]',
                'address'       => '高新一路',
                'status'        => 0,
                'created_at'    => '2020-10-27 14:52:46',
                'updated_at'    => '2020-10-27 14:52:46',
            ],
        ]);
    }
}
