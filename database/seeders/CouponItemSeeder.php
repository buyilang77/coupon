<?php

namespace Database\Seeders;

use App\Models\CouponItem;
use Illuminate\Database\Seeder;

class CouponItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CouponItem::insert([
            [
                "coupon_id" => 1,
                "code"      => "apple00000010",
                "password"  => '453497',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000011",
                "password"  => '516086',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000012",
                "password"  => '267361',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000013",
                "password"  => '413922',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000014",
                "password"  => '659177',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000015",
                "password"  => '777742',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000016",
                "password"  => '073076',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000017",
                "password"  => '703704',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000018",
                "password"  => '678894',
                "status"    => 0,
            ],
            [
                "coupon_id" => 1,
                "code"      => "apple00000019",
                "password"  => '809637',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000010",
                "password"  => '126368',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000011",
                "password"  => '416360',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000012",
                "password"  => '873519',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000013",
                "password"  => '075868',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000014",
                "password"  => '542356',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000015",
                "password"  => '691917',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000016",
                "password"  => '914553',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000017",
                "password"  => "531534",
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000018",
                "password"  => '099661',
                "status"    => 0,
            ],
            [
                "coupon_id" => 2,
                "code"      => "grapefruit00000019",
                "password"  => '770761',
                "status"    => 0,
            ],
        ]);
    }
}
