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
                'username'   => 'admin',
                'admin_name' => 'Administrator',
                'password'   => '$2y$10$MCx0jMhYwf1ais1veHIldOrtfbnnwsxVXlQ.1qgvjmLB8CBRlfdMS',
            ],
        ]);
    }
}
