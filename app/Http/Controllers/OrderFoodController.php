<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuCategory;
use App\Models\PlacedOrder;
use App\Models\InOrder;
use App\Models\Client;

class OrderFoodController extends Controller
{
    public function index()
    {
        $menu_categories = MenuCategory::with('menus')->get();
        // dd($menu_categories);
        return view('order_food', ['menu_categories' => $menu_categories]);
    }
    public function store(Request $request)
    { {
            // Validate the incoming request data
            $request->validate([
                'client_full_name' => 'required',
                'client_email' => 'required|email',
                'client_phone_number' => 'required',
                'client_delivery_address' => 'required',
                'selected_menus' => 'required|array',
            ]);

            $client = Client::where('client_email', $request->input('client_email'))->first();
            if (!$client) {
                $client = Client::create([
                    'client_name' => $request->input('client_full_name'),
                    'client_phone' => $request->input('client_phone_number'),
                    'client_email' => $request->input('client_email')
                ]);
            }
            // Create a new PlacedOrder instance\

            // Get the client details from the request
            // $clientFullName = $request->input('client_full_name');
            // $clientPhoneNumber = $request->input('client_phone_number');
            // $clientEmail = $request->input('client_email');

            // // Create a new Client instance
            // $client = Client::create([
            //     'client_name' => $clientFullName,
            //     'client_phone' => $clientPhoneNumber,
            //     'client_email' => $clientEmail
            // ]);


            // Attach the client to the placed order
            // $placedOrder->client()->associate($client);

            // Save the placed order
            // $placedOrder->save();
            $placedOrder = PlacedOrder::create([
                'delivery_address' => $request->input('client_delivery_address'),
                'order_time' => date('Y-m-d H:i:s'),
                'client_id' => $client['client_id']
            ]);
            // Attach selected menus to the placed order
            foreach ($request->input('selected_menus') as $menuId) {
                $inOrder = new InOrder();
                $inOrder->order_id = $placedOrder->order_id;
                $inOrder->menu_id = $menuId;
                $inOrder->save();
            }

            // Redirect back to the order food page with a success message
            return redirect('order_food');
        }
    }
}
