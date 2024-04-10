<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            ['menu_id' => 1, 'menu_name' => 'Moroccan Couscous', 'menu_description' => 'Moroccan couscous is a traditional dish consisting of fluffy semolina grains steamed to perfection, accompanied by a rich and aromatic stew of tender meat, vegetables, &amp; fragrant spices.', 'menu_price' => 14.00, 'menu_image' => '88737_couscous_meat.jpg', 'category_id' => 8],
            ['menu_id' => 2, 'menu_name' => 'Beef Hamburger', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 3.80, 'menu_image' => 'burger.jpeg', 'category_id' => 1],
            ['menu_id' => 3, 'menu_name' => 'Ice Cream', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 7.50, 'menu_image' => 'summer-dessert-sweet-ice-cream.jpg', 'category_id' => 2],
            ['menu_id' => 5, 'menu_name' => 'Coffee', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 10.00, 'menu_image' => 'coffee.jpeg', 'category_id' => 3],
            ['menu_id' => 6, 'menu_name' => 'Ice Tea', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 3.20, 'menu_image' => '76643_ice_tea.jpg', 'category_id' => 3],
            ['menu_id' => 7, 'menu_name' => 'Bucatini', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 20.00, 'menu_image' => 'macaroni.jpeg', 'category_id' => 4],
            ['menu_id' => 8, 'menu_name' => 'Cannelloni', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 10.80, 'menu_image' => 'cooked_pasta.jpeg', 'category_id' => 4],
            ['menu_id' => 9, 'menu_name' => 'Margherita', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 24.00, 'menu_image' => 'pizza.jpeg', 'category_id' => 5],
            ['menu_id' => 11, 'menu_name' => 'Moroccan Tajine', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 20.00, 'menu_image' => '58146_Moroccan Chicken Tagine.jpeg', 'category_id' => 8],
            ['menu_id' => 12, 'menu_name' => 'Moroccan Bissara', 'menu_description' => 'Bissara is a traditional Moroccan dish made from dried split fava beans (also known as broad beans) that are cooked and blended into a smooth and flavorful soup.', 'menu_price' => 10.00, 'menu_image' => '61959_Bissara.jpg', 'category_id' => 8],
            ['menu_id' => 16, 'menu_name' => 'Couscous', 'menu_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam posuere, lectus et mollis ultricies, justo arcu dignissim enim, eu eleifend lectus nulla.', 'menu_price' => 20.00, 'menu_image' => '76635_57738_w1024h768c1cx256cy192.jpg', 'category_id' => 8],

        ]);
    }
}
