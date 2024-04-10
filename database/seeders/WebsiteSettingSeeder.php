<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('website_setting')->insert([
            ['option_id' => 1, 'option_name' => 'restaurant_name', 'option_value' => 'VINCENT PIZZA'],
            ['option_id' => 2, 'option_name' => 'restaurant_email', 'option_value' => 'vincent.pizza@gmail.com'],
            ['option_id' => 3, 'option_name' => 'admin_email', 'option_value' => 'admin_email@gmail.com'],
            ['option_id' => 4, 'option_name' => 'restaurant_phonenumber', 'option_value' => '088866777555'],
            ['option_id' => 5, 'option_name' => 'restaurant_address', 'option_value' => '1580  Boone Street, Corpus Christi, TX, 78476 - USA'],
        ]);
    }
}
