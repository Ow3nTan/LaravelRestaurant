@extends('admin.layouts.admin_layout')
{{-- <x-header data="Edit User" /> --}}

@section('content')
    @php
        $pageTitle = 'Edit User';
    @endphp 

    <div class="card">
        <div class="card-header">
            {{ $pageTitle }}
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" class="user_form" action="{{ route('users.update', ['user_id' => $user->user_id]) }}">
                @csrf
                <div class="panel-X">
                    <div class="panel-header-X">
                        <div class="main-title">
                            {{ $user->username }}
                        </div>
                    </div>
                    <div class="save-header-X">
                        <div style="display:flex">
                            <div class="icon">
                                <i class="fa fa-sliders-h"></i>
                            </div>
                            <div class="title-container">User details</div>
                        </div>
                        <div class="button-controls">
                            <button type="submit" name="edit_user_sbmt" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <div class="panel-body-X">
                        <!-- User ID -->
                        <input type="hidden" name="user_id" value="{{ $user->user_id }}" >

                        <!-- Username INPUT -->
                        <div class="form-group">
                            <label for="user_name">Username</label>
                            <input type="text" class="form-control" value="{{ $user->username }}" placeholder="Username" name="user_name">
                            <!-- Add validation error message if needed -->
                        </div>
                    
                        <!-- FULL NAME INPUT -->
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" value="{{ $user->full_name }}" placeholder="Full Name" name="full_name">
                            <!-- Add validation error message if needed -->
                        </div>
                        
                        <!-- User Email INPUT -->
                        <div class="form-group">
                            <label for="user_email">User E-mail</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" placeholder="User Email" name="user_email">
                            <!-- Add validation error message if needed -->
                        </div>

                        <!-- User Password INPUT -->
                        <div class="form-group">
                            <label for="user_password">User Password</label>
                            <input type="password" class="form-control" value="{{ $user->password }}" placeholder="Change password" name="user_password">
                            <!-- Add validation error message if needed -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
