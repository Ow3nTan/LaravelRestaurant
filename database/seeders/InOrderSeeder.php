<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class InOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('in_order')->insert([
            ['id' => 8, 'order_id' => 10, 'menu_id' => 16, 'quantity' => 1],
            ['id' => 9, 'order_id' => 11, 'menu_id' => 12, 'quantity' => 1],
            ['id' => 10, 'order_id' => 11, 'menu_id' => 16, 'quantity' => 1],
            ['id' => 11, 'order_id' => 12, 'menu_id' => 11, 'quantity' => 1],
            ['id' => 12, 'order_id' => 12, 'menu_id' => 12, 'quantity' => 1],
            ['id' => 13, 'order_id' => 12, 'menu_id' => 16, 'quantity' => 1],
        ]);
    }
}
