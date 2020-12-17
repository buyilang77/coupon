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
                'price'       => '88.88',
                'carousel'    => '[{"uid": 1607653883234, "url": "http://api.merchant.hipi5.com/storage/merchant/merchant_1/2020-12-11/9GlL9Xy0XHXEfnSwWrlpVpCjbdAYZZXp4Q9h3LiK.jpeg", "name": "e5a5a02309a41f9f5def56684808d9ae.jpeg", "status": "success"}, {"uid": 1607653888725, "url": "http://api.merchant.hipi5.com/storage/merchant/merchant_1/2020-12-11/jy1svJV6gneZ7CgnGEpPtGQyqh7ytbkfD9KUbTgR.jpeg", "name": "1791ba14088f9c2be8c610d0a6cc0f93.jpeg", "status": "success"}]',
                'description' => '<p>Hello, Apple.</p>',
                'created_at'  => '2020-10-27 14:52:46',
                'updated_at'  => '2020-10-27 14:52:46',
            ],
            [
                'merchant_id' => 1,
                'name'        => '红心西柚',
                'price'       => '99.99',
                'carousel'    => '[{"uid": 1607653883234, "url": "http://api.merchant.hipi5.com/storage/merchant/merchant_1/2020-12-11/9GlL9Xy0XHXEfnSwWrlpVpCjbdAYZZXp4Q9h3LiK.jpeg", "name": "e5a5a02309a41f9f5def56684808d9ae.jpeg", "status": "success"}, {"uid": 1607653888725, "url": "http://api.merchant.hipi5.com/storage/merchant/merchant_1/2020-12-11/jy1svJV6gneZ7CgnGEpPtGQyqh7ytbkfD9KUbTgR.jpeg", "name": "1791ba14088f9c2be8c610d0a6cc0f93.jpeg", "status": "success"}]',
                'description' => '<p>Hello, Grapefruit.</p>',
                'created_at'  => '2020-10-27 14:52:46',
                'updated_at'  => '2020-10-27 14:52:46',
            ],
        ]);
    }
}
