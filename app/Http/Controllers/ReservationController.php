<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{

    public function checkAvailability(Request $request)
    {
        $selected_date = $request->input('reservation_date');
        $selected_time = $request->input('reservation_time');
        $number_of_guests = $request->input('number_of_guests');

        $availableTables = DB::table('table')
            ->select('table_id')
            ->whereNotIn('table_id', function ($query) use ($selected_date) {
                $query->select('t.table_id')
                    ->from('table as t')
                    ->join('reservation as r', 't.table_id', '=', 'r.table_id')
                    ->whereDate('r.selected_time', $selected_date)
                    ->where('r.liberated', 0)
                    ->where('r.canceled', 0);
            })->get();

        if ($availableTables->isEmpty()) {
            return view('table-reservation', ['failed' => 'ALL TABLES ARE RESERVED']);
        } else {
            return view('table-reservation', ['selected_date' => $selected_date, 'selected_time' => $selected_time, 'number_of_guests' => $number_of_guests, 'availableTables' => $availableTables]);
        }
    }

    public function makeReservation(Request $request)
    {
        // Validate request data

        // Create new client
        $client = Client::create([
            'client_name' => $request->input('client_full_name'),
            'client_phone' => $request->input('client_phone_number'),
            'client_email' => $request->input('client_email')
            
        ]);
        // dd($client);
        // Create new reservation
        $reservation = Reservation::create([
            'date_created' => now(),
            'client_id' => $client->id,
            'selected_time' => $request->input('selected_date') . ' ' . $request->input('selected_time'),
            'nbr_guests' => $request->input('number_of_guests'),
            'table_id' => $request->input('table_id')

        ]);

        // Handle success or error

        // Redirect or return response
        return view('table-reservation', ['success' => 'Reservation created successfully!']);
    }
}
