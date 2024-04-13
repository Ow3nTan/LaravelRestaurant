<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            ClientSeeder::class,
            ImageGallerySeeder::class,
            InOrderSeeder::class,
            MenuCategorySeeder::class,
            MenuSeeder::class,
            PlacedOrderSeeder::class,
            ReservationSeeder::class,
            TableSeeder::class,
            UserSeeder::class,
            WebsiteSettingSeeder::class,
        ]);
    }
}
