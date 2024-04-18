{{-- resources/views/menus/create.blade.php --}}
@extends('admin.layouts.admin_layout')

@section('title', 'Add New Menu')

@section('content')
    @php
        $pageTitle = 'Menu - Dishes';
    @endphp 

    <x-header data="Menu" />
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Menu</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('menus') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="menu_name">Menu Name:</label>
                            <input type="text" class="form-control" name="menu_name" required>
                        </div>

                        <div class="form-group">
                            <label for="menu_category">Menu Category:</label>
                            <select class="form-control" name="menu_category" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="menu_description">Description:</label>
                            <textarea class="form-control" name="menu_description" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="menu_price">Price:</label>
                            <input type="text" class="form-control" name="menu_price" required>
                        </div>

                        <div class="form-group">
                            <label for="menu_image">Image:</label>
                            <input type="file" class="form-control-file" name="menu_image" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
