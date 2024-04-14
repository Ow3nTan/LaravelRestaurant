<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $pageTitle ?? 'Admin Panel' }}</title>

        <script src="{{ asset('admin/design/js/jquery.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('admin/design/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/design/css/main.css') }}">

        <script src="{{ asset('admin/design/js/bootstrap.bundle.min.js') }}"></script>
        {{-- <script src="{{ asset('admin/design/js/bootstrap.min.js') }}"></script> --}}
        <script src="{{ asset('admin/design/js/main.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>

    <body>
        @include('admin.components.navbar')

        <div class="container">
            @yield('content')
        </div>
    </body>

</html>
