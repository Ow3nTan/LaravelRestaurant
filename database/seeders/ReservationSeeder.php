<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation')->insert([
            ['reservation_id' => 1, 'date_created' => '2020-07-18 09:07:00', 'client_id' => 13, 'selected_time' => '2020-07-30 09:07:00', 'nbr_guests' => 0, 'table_id' => 1, 'liberated' => 0, 'canceled' => 0, 'cancellation_reason' => NULL],
            ['reservation_id' => 2, 'date_created' => '2020-07-18 09:11:00', 'client_id' => 14, 'selected_time' => '2020-07-29 13:00:00', 'nbr_guests' => 4, 'table_id' => 1, 'liberated' => 0, 'canceled' => 0, 'cancellation_reason' => NULL],
            ['reservation_id' => 3, 'date_created' => '2023-07-01 04:01:00', 'client_id' => 15, 'selected_time' => '2023-07-02 05:00:00', 'nbr_guests' => 2, 'table_id' => 1, 'liberated' => 0, 'canceled' => 0, 'cancellation_reason' => NULL],
            ['reservation_id' => 4, 'date_created' => '2023-10-30 20:03:00', 'client_id' => 17, 'selected_time' => '2023-11-08 20:03:00', 'nbr_guests' => 1, 'table_id' => 1, 'liberated' => 0, 'canceled' => 0, 'cancellation_reason' => NULL],
        ]);
    }
}
