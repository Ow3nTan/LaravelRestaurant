<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PlacedOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('placed_order')->insert([
            ['order_id' => 7, 'order_time' => '2020-06-22 12:01:00', 'client_id' => 9, 'delivery_address' => 'Bloc A Nr 80000 Hay ElAgadir', 'delivered' => 0, 'canceled' => 1, 'cancellation_reason' => 'Sorry! I changed my mind!'],
            ['order_id' => 8, 'order_time' => '2020-06-23 06:07:00', 'client_id' => 10, 'delivery_address' => 'Chengdu, China', 'delivered' => 0, 'canceled' => 1, 'cancellation_reason' => ''],
            ['order_id' => 9, 'order_time' => '2020-06-24 16:40:00', 'client_id' => 11, 'delivery_address' => 'Hay El Houda Agadir', 'delivered' => 1, 'canceled' => 0, 'cancellation_reason' => NULL],
            ['order_id' => 10, 'order_time' => '2023-07-01 04:02:00', 'client_id' => 16, 'delivery_address' => 'Bloc A', 'delivered' => 0, 'canceled' => 0, 'cancellation_reason' => NULL],
            ['order_id' => 11, 'order_time' => '2023-10-30 20:09:00', 'client_id' => 18, 'delivery_address' => 'Test testst asds', 'delivered' => 0, 'canceled' => 0, 'cancellation_reason' => NULL],
            ['order_id' => 12, 'order_time' => '2023-10-30 21:46:00', 'client_id' => 19, 'delivery_address' => 'tests sd', 'delivered' => 0, 'canceled' => 0, 'cancellation_reason' => NULL],
        ]);
    }
}
