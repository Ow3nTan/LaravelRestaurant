<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $pageTitle ?? 'Admin Panel' }}</title>
    </head>

    <body>
        @include('admin.components.navbar')

        <div class="container">
            @yield('content')
        </div>
    </body>

</html>
