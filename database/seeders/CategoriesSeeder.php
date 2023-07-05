<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Category = [
            [
                'nama_kategori' => 'Komputer'
            ],
            [
                'nama_kategori' => 'Laptop'
            ],
            [
                'nama_kategori' => 'Handphone'
            ],
            [
                'nama_kategori' => 'Hardware'
            ],
            [
                'nama_kategori' => 'Software'
            ]

        ];

        foreach ($Category as $key => $val) {
            Category::create($val);
        }
        
    }
}
