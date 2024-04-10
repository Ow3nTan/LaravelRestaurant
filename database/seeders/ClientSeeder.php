<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client')->insert([
            ['client_id' => 9, 'client_name' => 'Client 1', 'client_phone' => '02020202020', 'client_email' => 'client1@gmail.com'],
            ['client_id' => 10, 'client_name' => 'Client 10', 'client_phone' => '0638383933', 'client_email' => 'client10@gmail.com'],
            ['client_id' => 11, 'client_name' => 'Client 11', 'client_phone' => '06242556272', 'client_email' => 'client11@yahoo.fr'],
            ['client_id' => 13, 'client_name' => 'Client 12', 'client_phone' => '030303030202', 'client_email' => 'client1133@gmail.com'],
            ['client_id' => 14, 'client_name' => 'Client 12', 'client_phone' => '030303030', 'client_email' => 'client14@gmail.com'],
            ['client_id' => 16, 'client_name' => 'Client 14', 'client_phone' => '0203203203', 'client_email' => 'client14@gmail.com'],
            ['client_id' => 17, 'client_name' => 'Client 17', 'client_phone' => '0737373822', 'client_email' => 'client17@gmail.com'],
            ['client_id' => 18, 'client_name' => 'Client 12', 'client_phone' => '02920320', 'client_email' => 'client12@yahoo.fr'],
            ['client_id' => 19, 'client_name' => 'Test', 'client_phone' => '1034304300', 'client_email' => 'test@gmail.com'],
        ]);
    }
}
