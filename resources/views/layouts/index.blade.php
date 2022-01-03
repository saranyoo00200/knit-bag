<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- icon --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">


    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css"
        integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body>
    {{-- <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div> --}}

    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a href="/" class="navbar-brand text-dark">KNIT BAG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('reviews') ? 'active' : '' }}" href="/reviews">Review</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
                    </li>
                </ul>
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 sm:block">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Log
                                        in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div id="app">
        @yield('content')
    </div>

    <footer class="mt-auto bg-white text-center">
        <section class="container p-2">
            <div class="row d-flex align-items-center">
                <div class="col-md-7 col-lg-8 text-center text-md-start">
                    <div class="p-3">Ecommerce for <u>KNOMPUNG</u> stores.</div>
                </div>
                <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                    <!-- Facebook -->
                    <a class="btn btn-outline-secondary btn-floating m-1" role="button"><i
                            class="fab fa-facebook-f"></i></a>

                    <!-- Twitter -->
                    <a class="btn btn-outline-secondary btn-floating m-1" role="button"><i
                            class="fab fa-twitter"></i></a>

                    <!-- Google -->
                    <a class="btn btn-outline-secondary btn-floating m-1" role="button"><i
                            class="fab fa-google"></i></a>

                    <!-- Instagram -->
                    <a class="btn btn-outline-secondary btn-floating m-1" role="button"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </section>
    </footer>

    <script src="{{ mix('/js/app.js') }}" defer></script>
</body>

</html>
