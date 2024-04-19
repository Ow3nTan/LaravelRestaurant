@extends('admin.layouts.admin_layout')
{{-- <x-header data="Users" /> --}}

@section('content')
    @php
        $pageTitle = 'Users';
    @endphp 

    <div class="card">
        <div class="card-header">
            {{ $pageTitle }}
        </div>

        <div class="card-body">
            <!-- USERS TABLE -->
            <table class="table table-bordered users-table">
                <!-- Table header -->
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Manage</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>
                            <button class="btn btn-success btn-sm rounded-0">
                                <a href="{{ route('users.edit', ['user_id' => $user->user_id]) }}" style="color: white;">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </button>
                        </td>
                        <td>{{ $user->role }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if(session('success'))
        <script type="text/javascript">
            swal("Success", "{{ session('success') }}", "success");
        </script>
    @endif
@endsection
