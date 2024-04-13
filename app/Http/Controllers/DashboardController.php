<?php

namespace App\Http\Controllers;

use App\Models\PlacedOrder;

use Illuminate\Http\Request;

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
}
