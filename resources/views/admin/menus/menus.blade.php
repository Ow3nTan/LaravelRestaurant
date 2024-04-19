@extends('admin.layouts.admin_layout')

<x-header data="Menu - Dishes" />

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@section('scripts')
    @parent
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        var vertical_menu = document.getElementById("vertical-menu");
        var current = vertical_menu.getElementsByClassName("active_link");

        if (current.length > 0) {
            current[0].classList.remove("active_link");
        }

        vertical_menu.getElementsByClassName('menu_categories_link')[0].className += " active_link";
    </script>
@endsection

@section('content')
    @php
        $pageTitle = 'Menu - Dishes';
    @endphp


    <div class="card">
        <div class="card-header">
            {{ $pageTitle }}
        </div>
        <div class="card-body">

            <!-- ADD NEW MENU BUTTON -->
            <div class="above-table" style="margin-bottom: 1rem!important;">
                <a href="{{ url('menus/create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i>
                    <span>Add new Menu</span>
                </a>
            </div>

            <!-- MENUS TABLE -->
            <table class="table table-bordered menus-table">
                <thead>
                    <tr>
                        <th scope="col">Menu Name</th>
                        <th scope="col">Menu Category</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu['menu_name'] }}</td>
                            <td style="text-transform: capitalize">{{ $menu['category_id'] }}</td>
                            <td>{{ $menu['menu_description'] }}</td>
                            <td>${{ $menu['menu_price'] }}</td>
                            <td>
                                <ul class="list-inline m-0">

                                    <!-- VIEW BUTTON -->
                                    <li class="list-inline-item" data-toggle="tooltip" title="View">
                                        <button class="btn btn-primary btn-sm rounded-0" type="button" data-toggle="modal"
                                            data-target="#viewModal{{ $menu['menu_id'] }}" data-placement="top">
                                            <i class="fa fa-eye"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="viewModal{{ $menu['menu_id'] }}" tabindex="-1"
                                            role="dialog" aria-labelledby="viewModalLabel{{ $menu['menu_id'] }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="thumbnail" style="cursor:pointer">
                                                            @php $source = "anotherImages/" . $menu['menu_image']; @endphp
                                                            <img src="{{ asset($source) }}" alt="{{ $menu['menu_name'] }}">
                                                            <div class="caption">
                                                                <h3>
                                                                    <span
                                                                        style="float: right;">${{ $menu['menu_price'] }}</span>
                                                                    {{ $menu['menu_name'] }}
                                                                </h3>
                                                                <p>{{ $menu['menu_description'] }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- EDIT BUTTON -->
                                    <li class="list-inline-item" data-toggle="tooltip" title="Edit">
                                        <button class="btn btn-success btn-sm rounded-0">
                                            <a href="{{ url('menus/edit', $menu['menu_id']) }}" style="color: white;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </button>
                                    </li>

                                    <!-- DELETE BUTTON -->
                                    <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal"
                                            data-target="#deleteModal{{ $menu['menu_id'] }}" data-placement="top"><i
                                                class="fa fa-trash"></i>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $menu['menu_id'] }}" tabindex="-1"
                                            role="dialog" aria-labelledby="deleteModalLabel{{ $menu['menu_id'] }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete Menu</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this Menu
                                                        "{{ strtoupper($menu['menu_name']) }}"?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="button" data-id="{{ $menu['menu_id'] }}"
                                                            class="btn btn-danger delete_menu_bttn">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
