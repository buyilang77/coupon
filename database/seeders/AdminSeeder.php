<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Admin::insert([
            [
                'username'   => 'adminth',
                'admin_name' => 'Administrator',
                'password'   => '$2y$10$CnAYTbaVGnKr53IZpcJ57O6UKdar8MQdpxuLlGWczbXYLxVHX2PPG',
            ],
        ]);
    }
}
