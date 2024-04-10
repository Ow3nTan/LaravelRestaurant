<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ImageGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_gallery')->insert([
            ['image_id' => 1, 'image_name' => 'Moroccan Tajine', 'image' => '58146_Moroccan Chicken Tagine.jpeg'],
            ['image_id' => 2, 'image_name' => 'Italian Pasta', 'image' => 'img_1.jpg'],
            ['image_id' => 3, 'image_name' => 'Cook', 'image' => 'img_2.jpg'],
            ['image_id' => 4, 'image_name' => 'Pizza', 'image' => 'img_3.jpg'],
            ['image_id' => 5, 'image_name' => 'Burger', 'image' => 'burger.jpeg'],
        ]);
    }
}
