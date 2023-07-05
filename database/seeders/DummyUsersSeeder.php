<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'user inven',
                'email' => 'user@gmail.com',
                'role_id' => '2',
                'password' => bcrypt('123456')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
        $adminData = [
            [
                'name' => 'admin inven',
                'email' => 'admin@gmail.com',
                'role_id' => '1',
                'password' => bcrypt('123456')
            ],
        ];

        foreach ($adminData as $key => $val) {
            Admin::create($val);
        }
    }
}
