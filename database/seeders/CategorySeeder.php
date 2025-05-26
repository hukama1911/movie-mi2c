<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('categories')->insert(
            [
                'category_name' => 'Action',
                'description' => 'Flim dengan adegan adegan penuh aksi dan keterangan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Comedy',
                'description' => 'Flim  yang bertujuan untuk menghibur dan mengundang tawa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Drama',
                'description' => 'Flim  yang terfokus papa pengembangan karakter dan konflik emosional.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Romance',
                'description' => 'Flim  yang berpusat pad aisah cinta dan hubungan romatis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        );
    }
}
