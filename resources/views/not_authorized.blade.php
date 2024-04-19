<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Not Authorized</title>
    </head>

    <body>
        <div>
            <p>You are not authorized to access this page.</p>
            <p>Redirecting you to the home page in 3 seconds...</p>
        </div>

        <script>
            setTimeout(function() {
                window.location.href = "{{ url('/home') }}";
            }, 3000);
        </script>
    </body>

</html>
