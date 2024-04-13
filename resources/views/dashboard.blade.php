@php
    use App\Models\Client;
    use App\Models\PlacedOrder;
    use App\Models\Reservation;
    use App\Models\Menu;
    use App\Models\Inorder;
    use App\Models\MenuCategory;
@endphp

@php
    // session_start();
@endphp

@php
    $pageTitle = 'Dashboard';
@endphp



{{-- @if (session('username_restaurant_qRewacvAqzA') && session('password_restaurant_qRewacvAqzA')) --}}


@push('scripts')
    <script type="text/javascript">
        var vertical_menu = document.getElementById("vertical-menu");
        var current = vertical_menu.getElementsByClassName("active_link");
        if (current.length > 0) {
            current[0].classList.remove("active_link");
        }
        vertical_menu.getElementsByClassName('dashboard_link')[0].classList.add("active_link");
    </script>
@endpush

<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="panel panel-green ">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-3">
                        <i class="fa fa-users fa-4x"></i>
                    </div>
                    <div class="col-sm-9 text-right">
                        <div class="huge"><span>{{ Client::countItems('client_id', 'client') }}</span>
                        </div>
                        <div>Total Clients</div>
                    </div>
                </div>
            </div>
            <a href="client.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-3">
                        <i class="fas fa-utensils fa-4x"></i>
                    </div>
                    <div class="col-sm-9 text-right">
                        <div class="huge"><span>{{ Client::countItems('menu_id', 'menu') }}</span></div>
                        <div>Total Menus</div>
                    </div>
                </div>
            </div>
            <a href="menu.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-3">
                        <i class="far fa-calendar-alt fa-4x"></i>
                    </div>
                    <div class="col-sm-9 text-right">
                        <div class="huge"><span>32</span></div>
                        <div>Total Appointments</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-3">
                        <i class="fas fa-pizza-slice fa-4x"></i>
                    </div>
                    <div class="col-sm-9 text-right">
                        <div class="huge">
                            <span>{{ Client::countItems('order_id', 'placed_order') }}</span>
                        </div>
                        <div>Total Orders</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>


<div class="card" style="margin: 20px 10px">

    <div class="card-header tab" style="padding:0px;">
        <button class="tablinks_orders active"
            onclick="openTab(event, 'recent_orders','tabcontent_orders','tablinks_orders')">Recent Orders</button>
        <button class="tablinks_orders"
            onclick="openTab(event, 'completed_orders','tabcontent_orders','tablinks_orders')">Completed
            Orders</button>
        <button class="tablinks_orders"
            onclick="openTab(event, 'canceled_orders','tabcontent_orders','tablinks_orders')">Canceled
            Orders</button>
    </div>


    <div class="card-body">
        <div class='responsive-table'>


            <table class="table X-table tabcontent_orders" id="recent_orders" style="display:table">
                <thead>
                    <tr>
                        <th>
                            Order Time Created
                        </th>
                        <th>
                            Selected Menus
                        </th>
                        <th>
                            Total Price
                        </th>
                        <th>
                            Client
                        </th>
                        <th>
                            Manage
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $placed_orders = PlacedOrder::with('client')
                            ->where('canceled', 0)
                            ->where('delivered', 0)
                            ->orderBy('order_time')
                            ->get();

                        $count = $placed_orders->count();
                    @endphp

                    @if ($count == 0)
                        <tr>
                            <td colspan='5' style='text-align:center;'>
                                List of your recent orders will be presented here
                            </td>
                        </tr>
                    @else
                        @foreach ($placed_orders as $order)
                            <tr>
                                <td>
                                    {{ $order->order_time }}
                                </td>
                                <td>
                                    @php
                                        $menus = Menu::select('menu_name', 'quantity', 'menu_price')
                                            ->join('in_order', 'menu.menu_id', '=', 'in_order.menu_id')
                                            ->where('in_order.order_id', $order->order_id)
                                            ->get();

                                        $total_price = 0;
                                    @endphp

                                    @foreach ($menus as $menu)
                                        <span style='display:block'>{{ $menu->menu_name }}</span>

                                        @php
                                            $total_price += $menu->menu_price * $menu->quantity;
                                        @endphp
                                    @endforeach
                                </td>
                                <td>
                                    {{ $total_price }}$
                                </td>
                                <td>
                                    <button class='btn btn-info btn-sm rounded-0' type='button' data-toggle='modal'
                                        data-target='#client_{{ $order->client_id }}' data-placement='top'>
                                        {{ $order->client_id }}
                                    </button>

                                    <!-- Client Modal -->
                                    <div class='modal fade' id='client_{{ $order->client_id }}' tabindex='-1'
                                        role='dialog' aria-hidden='true'>
                                        <div class='modal-dialog' role='document'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>Client Details</h5>
                                                    <button type='button' class='close' data-dismiss='modal'
                                                        aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <div class='modal-body'>
                                                    <ul>
                                                        <li><span style='font-weight: bold;'>Full name: </span>
                                                            {{ $order->client_name }}</li>
                                                        <li><span style='font-weight: bold;'>Phone number:
                                                            </span>{{ $order->client_phone }}</li>
                                                        <li><span style='font-weight: bold;'>E-mail:
                                                            </span>{{ $order->client_email }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <ul class='list-inline m-0'>
                                        <!-- Deliver Order BUTTON -->
                                        <li class='list-inline-item' data-toggle='tooltip' title='Deliver Order'>
                                            <button class='btn btn-info btn-sm rounded-0' type='button'
                                                data-toggle='modal'
                                                data-target='#deliver_order{{ $order->order_id }}'
                                                data-placement='top'>
                                                <i class='fas fa-truck'></i>
                                            </button>

                                            <!-- DELIVER MODAL -->
                                            <div class='modal fade' id='deliver_order{{ $order->order_id }}'
                                                tabindex='-1' role='dialog'
                                                aria-labelledby='deliver_order{{ $order->order_id }}'
                                                aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title'>Deliver Order</h5>
                                                            <button type='button' class='close'
                                                                data-dismiss='modal' aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            Mark order as delivered?
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-secondary'
                                                                data-dismiss='modal'>Cancel</button>
                                                            <button type='button' data-id='{{ $order->order_id }}'
                                                                class='btn btn-info deliver_order_button'>
                                                                Yes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- CANCEL BUTTON -->
                                        <li class='list-inline-item' data-toggle='tooltip' title='Cancel Order'>
                                            <button class='btn btn-danger btn-sm rounded-0' type='button'
                                                data-toggle='modal' data-target='#cancel_order{{ $order->order_id }}'
                                                data-placement='top'>
                                                <i class='fas fa-calendar-times'></i>
                                            </button>

                                            <!-- CANCEL MODAL -->
                                            <div class='modal fade' id='cancel_order{{ $order->order_id }}'
                                                tabindex='-1' role='dialog'
                                                aria-labelledby='cancel_order{{ $order->order_id }}'
                                                aria-hidden='true'>
                                                <div class='modal-dialog' role='document'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title'>Cancel Order</h5>
                                                            <button type='button' class='close'
                                                                data-dismiss='modal' aria-label='Close'>
                                                                <span aria-hidden='true'>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <div class='form-group'>
                                                                <label>Cancellation Reason</label>
                                                                <textarea class='form-control' id='cancellation_reason_order_{{ $order->order_id }}' required='required'></textarea>
                                                            </div>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-secondary'
                                                                data-dismiss='modal'>No</button>
                                                            <button type='button' data-id='{{ $order->order_id }}'
                                                                class='btn btn-danger cancel_order_button'>
                                                                Cancel Order
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- COMPLETED ORDERS -->

            <table class="table X-table tabcontent_orders" id="completed_orders">
                <thead>
                    <tr>
                        <th>
                            Order Time Created
                        </th>
                        <th>
                            Menus
                        </th>
                        <th>
                            Client
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $completedOrders = DB::table('placed_order as po')
                            ->join('client as c', 'po.client_id', '=', 'c.client_id')
                            ->where('po.delivered', 1)
                            ->where('po.canceled', 0)
                            ->orderBy('po.order_time')
                            ->get();
                        $count = count($completedOrders);
                    @endphp

                    @if ($count == 0)
                        <tr>
                            <td colspan='5' style='text-align:center;'>
                                List of your completed orders will be presented here
                            </td>
                        </tr>
                    @else
                        @foreach ($completedOrders as $order)
                            <tr>
                                <td>
                                    {{ $order->order_time }}
                                </td>
                                <td>
                                    @php
                                        $menus = DB::table('menu')
                                            ->join('in_order', 'menu.menu_id', '=', 'in_order.menu_id')
                                            ->select('menu.menu_name', 'in_order.quantity')
                                            ->where('in_order.order_id', '=', $order->order_id)
                                            ->get();
                                    @endphp
                                    @foreach ($menus as $menu)
                                        <span style='display:block'>{{ $menu->menu_name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $order->client_name }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- CANCELED ORDERS -->

            <table class="table X-table tabcontent_orders" id="canceled_orders">
                <thead>
                    <tr>
                        <th>
                            Order Time Created
                        </th>
                        <th>
                            Client
                        </th>
                        <th>
                            Cancellation Reason
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $cancelledOrders = PlacedOrder::with('client')
                            ->where('canceled', 1)
                            ->orderBy('order_time')
                            ->get();

                        $count = $cancelledOrders->count();
                    @endphp

                    @if ($count == 0)
                        <tr>
                            <td colspan='5' style='text-align:center;'>
                                List of your canceled orders will be presented here
                            </td>
                        </tr>
                    @else
                        @foreach ($cancelledOrders as $order)
                            <tr>
                                <td>
                                    {{ $order->order_time }}
                                </td>
                                <td>
                                    {{ $order->client_name }}
                                </td>
                                <td>
                                    {{ $order->cancellation_reason }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- END ORDERS TABS -->

<!-- START RESERVATIONS TABS -->

<div class="card" style = "margin: 20px 10px">

    <!-- TABS BUTTONS -->

    <div class="card-header tab" style="padding:0px;">
        <button class="tablinks_reservations active"
            onclick="openTab(event, 'recent_reservations','tabcontent_reservations','tablinks_reservations')">Recent
            Reservations</button>
        <button class="tablinks_reservations"
            onclick="openTab(event, 'completed_reservations','tabcontent_reservations','tablinks_reservations')">Completed
            Reservations</button>
        <button class="tablinks_reservations"
            onclick="openTab(event, 'canceled_reservations','tabcontent_reservations','tablinks_reservations')">Canceled
            Reservations</button>
    </div>

    <!-- TABS CONTENT -->

    <div class="card-body">
        <div class='responsive-table'>

            <!-- RECENT RESERVATIONS -->

            <table class="table X-table tabcontent_reservations" id="recent_reservations" style="display:table">
                <thead>
                    <tr>
                        <th>
                            Reservation Time Created
                        </th>
                        <th>
                            Reservation Date and Time
                        </th>
                        <th>
                            Number of Guests
                        </th>
                        <th>
                            Table ID
                        </th>
                        <th>
                            Manage
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $reservations = DB::table('reservation')
                            ->where('selected_time', '>', now())
                            ->where('canceled', 0)
                            ->get();
                        $count = $reservations->count();
                    @endphp

                    @if ($count == 0)
                        <tr>
                            <td colspan='5' style='text-align:center;'>
                                List of your upcoming reservations will be presented here
                            </td>
                        </tr>
                    @else
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>
                                    {{ $reservation->date_created }}
                                </td>
                                <td>
                                    {{ $reservation->selected_time }}
                                </td>
                                <td>
                                    {{ $reservation->nbr_guests }}
                                </td>
                                <td>
                                    {{ $reservation->table_id }}
                                </td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <!-- Liberate Table BUTTON -->
                                        <li class="list-inline-item" data-toggle="tooltip" title="Liberate Table">
                                            <button class="btn btn-info btn-sm rounded-0" type="button"
                                                data-toggle="modal"
                                                data-target="#liberate_table_{{ $reservation->reservation_id }}"
                                                data-placement="top">
                                                <i class="far fa-check-circle"></i>
                                            </button>

                                            <!-- LIBERATE MODAL -->
                                            <div class="modal fade"
                                                id="liberate_table_{{ $reservation->reservation_id }}" tabindex="-1"
                                                role="dialog"
                                                aria-labelledby="liberate_table_{{ $reservation->reservation_id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Liberate Table</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Free this Table?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="button"
                                                                data-id="{{ $reservation->reservation_id }}"
                                                                class="btn btn-info liberate_table_button">
                                                                Yes
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- CANCEL BUTTON -->
                                        <li class="list-inline-item" data-toggle="tooltip"
                                            title="Cancel Reservation">
                                            <button class="btn btn-danger btn-sm rounded-0" type="button"
                                                data-toggle="modal"
                                                data-target="#cancel_reservation_{{ $reservation->reservation_id }}"
                                                data-placement="top">
                                                <i class="fas fa-calendar-times"></i>
                                            </button>

                                            <!-- CANCEL MODAL -->
                                            <div class="modal fade"
                                                id="cancel_reservation_{{ $reservation->reservation_id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="cancel_reservation_{{ $reservation->reservation_id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Cancel Reservation</h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Cancellation Reason</label>
                                                                <textarea class="form-control" id="cancellation_reason_reservation_{{ $reservation->reservation_id }}"
                                                                    required="required"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">No</button>
                                                            <button type="button"
                                                                data-id="{{ $reservation->reservation_id }}"
                                                                class="btn btn-danger cancel_order_button">
                                                                Cancel Reservation
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>


            <table class="table X-table tabcontent_reservations" id="completed_reservations">
                <thead>
                    <tr>
                        <th>
                            Reservation Date Created
                        </th>
                        <th>
                            Reservation Date
                        </th>
                        <th>
                            Table ID
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $reservations = DB::table('reservation')
                            ->where('selected_time', '<', now())
                            ->where('canceled', 0)
                            ->orderBy('selected_time')
                            ->get();
                        $count = $reservations->count();
                    @endphp

                    @if ($count == 0)
                        <tr>
                            <td colspan="3" style="text-align:center;">
                                List of your completed reservations will be presented here
                            </td>
                        </tr>
                    @else
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>
                                    {{ $reservation->date_created }}
                                </td>
                                <td>
                                    {{ $reservation->selected_time }}
                                </td>
                                <td>
                                    {{ $reservation->table_id }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- CANCELED RESERVATIONS -->

            <table class="table X-table tabcontent_reservations" id="canceled_reservations">
                <thead>
                    <tr>
                        <th>
                            Reservation Date Created
                        </th>
                        <th>
                            Cancellation Reason
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $reservations = DB::table('reservation')->where('canceled', 1)->orderBy('date_created')->get();

                        $count = count($reservations);
                    @endphp

                    @if ($count == 0)
                        <tr>
                            <td colspan="2" style="text-align:center;">
                                List of your canceled reservations will be presented here
                            </td>
                        </tr>
                    @else
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>
                                    {{ $reservation->date_created }}
                                </td>
                                <td>
                                    {{ $reservation->cancellation_reason }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- @else
    @php
        // header('Location: index.php');
        // exit();
    @endphp
@endif --}}


<!-- JS SCRIPTS -->

<script type="text/javascript">
    // WHEN DELIVER ORDER BUTTON IS CLICKED

    $('.deliver_order_button').click(function() {

        var order_id = $(this).data('id');
        var do_ = 'Deliver_Order';

        $.ajax({
            url: "/ajax_files/dashboard_ajax.php",
            type: "POST",
            data: {
                do_: do_,
                order_id: order_id,
            },
            success: function(data) {
                $('#deliver_order' + order_id).modal('hide');
                swal("Order Delivered", "The order has been marked as delivered", "success").then((
                    value) => {
                    window.location.replace("dashboard.php");
                });

            },
            error: function(xhr, status, error) {
                alert('AN ERROR HAS BEEN OCCURRED WHILE TRYING TO PROCESS YOUR REQUEST!');
            }
        });
    });

    // WHEN CANCEL ORDER BUTTON IS CLICKED

    $('.cancel_order_button').click(function() {

        var order_id = $(this).data('id');
        var cancellation_reason_order = $('#cancellation_reason_order_' + order_id).val();

        var do_ = 'Cancel_Order';


        $.ajax({
            url: "/ajax_files/dashboard_ajax.php",
            type: "POST",
            data: {
                order_id: order_id,
                cancellation_reason_order: cancellation_reason_order,
                do_: do_
            },
            success: function(data) {
                $('#cancel_order' + order_id).modal('hide');
                swal("Order Canceled", "The order has been canceled successfully", "success").then((
                    value) => {
                    window.location.replace("dashboard.php");
                });
            },
            error: function(xhr, status, error) {
                alert('AN ERROR HAS BEEN OCCURRED WHILE TRYING TO PROCESS YOUR REQUEST!');
            }
        });
    });
</script>
