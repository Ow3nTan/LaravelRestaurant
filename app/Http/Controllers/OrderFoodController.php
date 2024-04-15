<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuCategory;
use App\Models\Menu;

class OrderFoodController extends Controller
{

    public function index()
    {
        $menu_categories = MenuCategory::with('menus')->get();
        return view('order_food', ['menu_categories' => $menu_categories]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'client_full_name' => 'required',
            'client_email' => 'required|email',
            'client_phone_number' => 'required',
            'client_delivery_address' => 'required',
            'selected_menus' => 'required|array',
        ]);

        // Save the order to the database...

        return redirect()->route('order_confirmation');
    }
}
