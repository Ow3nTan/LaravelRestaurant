<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_category')->insert([
            ['category_id' => 1, 'category_name' => 'burgers'],
            ['category_id' => 2, 'category_name' => 'desserts'],
            ['category_id' => 3, 'category_name' => 'drinks'],
            ['category_id' => 4, 'category_name' => 'pasta'],
            ['category_id' => 5, 'category_name' => 'pizzas'],
            ['category_id' => 6, 'category_name' => 'salads'],
            ['category_id' => 8, 'category_name' => 'Traditional Food'],
        ]);
    }
}
