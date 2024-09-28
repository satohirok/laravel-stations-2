<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <!-- Styles -->

    </head>
    <body class="">
        <div class="container mt-3">
            @if (Route::has('login'))

                    @auth

                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                    @else

                        <a href="{{ route('login') }}" class="btn btn-outline-danger">Log in</a>



                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-danger underline">Register</a>
                        @endif
                    @endauth

            @endif
    </body>
</html>
