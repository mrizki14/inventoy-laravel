<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'role' => 'Admin'
            ],
            [
                'role' => 'User'
            ],
        ];

        foreach ($role as $key => $val) {
            Role::create($val);
        }
    }
}
