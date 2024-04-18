{{-- resources/views/menus/edit.blade.php --}}
@extends('admin.layouts.admin_layout')

@section('title', 'Edit Menu')

@section('content')
    @php
        $pageTitle = 'Menu - Dishes';
    @endphp 
    
    <x-header data="Menu" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Menu</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('menus', $menu) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="menu_name">Menu Name:</label>
                            <input type="text" class="form-control" name="menu_name" value="{{ $menu->menu_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="menu_category">Menu Category:</label>
                            <select class="form-control" name="menu_category" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" @if($menu->category_id == $category->category_id) selected @endif>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="menu_description">Description:</label>
                            <textarea class="form-control" name="menu_description" rows="3" required>{{ $menu->menu_description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="menu_price">Price:</label>
                            <input type="text" class="form-control" name="menu_price" value="{{ number_format($menu->menu_price, 2) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="menu_image">Image:</label>
                            <input type="file" class="form-control-file" name="menu_image">
                            <small>Current Image: <img src="{{ asset('storage/' . $menu->menu_image) }}" width="100"></small>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
