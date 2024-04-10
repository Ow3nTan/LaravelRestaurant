<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_id' => 1,
            'username' => 'admin_user',
            'email' => 'user_admin@gmail.com',
            'full_name' => 'User Admin',
            'password' =>'f7c3bc1d808e04732adf679965ccc34ca7ae3441',
        ]);
    }
}
