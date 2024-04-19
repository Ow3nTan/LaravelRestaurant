<?php

namespace App\Http\Controllers;

use App\Models\PlacedOrder;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Reservation;


class DashboardController extends Controller
{
    public function handleAjaxRequest(Request $request)
    {
        if ($request->has('do_') && $request->input('do_') == 'Deliver_Order') {
            return $this->deliverOrder($request);
        } elseif ($request->has('do_') && $request->input('do_') == 'Cancel_Order') {
            return $this->cancelOrder($request);
        }
    }

    protected function deliverOrder(Request $request)
    {
        $orderId = $request->input('order_id');

        // Update order as delivered
        PlacedOrder::where('order_id', $orderId)->update(['delivered' => true]);

        return response()->json([
            'message' => 'The order has been marked as delivered successfully!'
        ]);
    }

    protected function cancelOrder(Request $request)
    {
        $orderId = $request->input('order_id');
        $cancellationReason = $request->input('cancellation_reason_order');

        // Update order as canceled with cancellation reason
        PlacedOrder::where('order_id', $orderId)->update([
            'canceled' => true,
            'cancellation_reason' => $cancellationReason
        ]);

        return response()->json([
            'message' => 'The order has been canceled successfully!'
        ]);
    }

    public function getPlacedOrders()
    {
        $placed_orders = PlacedOrder::with('client')
            ->where('canceled', 0)
            ->where('delivered', 0)
            ->orderBy('order_time')
            ->get();

        $count = $placed_orders->count();

        return compact('placed_orders', 'count');
    }

    public function getOrderMenus($orderId)
    {
        $menus = Menu::select('menu_name', 'quantity', 'menu_price')
            ->join('in_order', 'menu.menu_id', '=', 'in_order.menu_id')
            ->where('in_order.order_id', $orderId)
            ->get();

        $totalPrice = 0;

        foreach ($menus as $menu) {
            $totalPrice += $menu->menu_price * $menu->quantity;
        }

        return compact('menus', 'totalPrice');
    }

    public function getCompletedOrders()
    {
        $completedOrders = PlacedOrder::with('client')
            ->where('delivered', 1)
            ->where('canceled', 0)
            ->orderBy('order_time')
            ->get();

        $count = $completedOrders->count();

        return compact('completedOrders', 'count');
    }

    public function getCancelledOrders()
    {
        $cancelledOrders = PlacedOrder::with('client')
            ->where('canceled', 1)
            ->orderBy('order_time')
            ->get();

        $count = $cancelledOrders->count();

        return compact('cancelledOrders', 'count');
    }

    public function getRecentReservations()
    {
        $reservations = Reservation::where('selected_time', '>', now())
            ->where('canceled', 0)
            ->get();

        $count = $reservations->count();

        return compact("reservations", "count");
    }

    public function getCompletedReservations()
    {
        $reservations = Reservation::where('selected_time', '<', now())
            ->where('canceled', 0)
            ->orderBy('selected_time')
            ->get();
        $count = $reservations->count();

        return compact("reservations", "count");
    }

    public function getCanceledReservations()
    {
        $reservations = Reservation::where('canceled', 1)
            ->orderBy('date_created')
            ->get();
        $count = $reservations->count();

        return compact("reservations", "count");
    }
}
