@extends('admin.layouts.admin_layout')
{{-- <x-header data="Clients" /> --}}

@section('content')
    @php
        $pageTitle = 'Clients';
    @endphp 

    <div class="card">
        <div class="card-header">
            {{ $pageTitle }}
        </div>
        <div class="card-body">
            <table class="table table-bordered clients-table">
                <thead>
                    <tr>
                        <th scope="col">Client Name</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">E-mail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->client_name }}</td>
                            <td>{{ $client->client_phone }}</td>
                            <td>{{ $client->client_email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
    </div>
@endsection
