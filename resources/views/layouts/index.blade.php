<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KNOMPUNG</title>
    <link rel="shortcut icon"
        href="https://scontent.fbkk14-1.fna.fbcdn.net/v/t1.15752-9/271586309_3849771325247301_4125587798937102478_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=ae9488&_nc_eui2=AeEsrxK0BqFhdkhMNaDWXhDUv94aP7t75Ze_3ho_u3vll6lVhhMAOSr1L035Ph7fHMMohlldUwgfun3Ju_Y3MHCA&_nc_ohc=VGvjauG0Ab8AX8XIqag&_nc_ht=scontent.fbkk14-1.fna&oh=03_AVKq60aRglxyxia9HoW7pIRfYXQ-BQI_SU-Y8W76why4SQ&oe=6212D9A0"
        type="image/x-icon" />

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
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a href="/" class="navbar-brand text-dark">KNOMPUNG</a>
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
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('reviews') ? 'active' : '' }}" href="/reviews">Review</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
                    </li>
                </ul>
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 sm:block">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-evenly list-group-horizontal">
                            @auth
                                @php
                                    $count_cart = DB::table('user_products')
                                        ->where('user_id', Auth()->user()->id)
                                        ->count();
                                    $count_bell = DB::table('order_approves')
                                        ->where('approvel', 0)
                                        ->count();
                                @endphp
                                {{-- <li class="nav-item">
                                    <a class="nav-link mx-1 position-relative" href="{{ url('/order-historys') }}">
                                        <i class="fas fa-history"></i>
                                        <span class="position-absolute translate-middle-x badge bg-danger"
                                            style="font-size: 9px">
                                            0
                                        </span>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link mx-1 position-relative" href="{{ url('/my-products') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="position-absolute translate-middle-x badge bg-danger"
                                            style="font-size: 9px">
                                            {{ $count_cart }}
                                        </span>
                                    </a>
                                </li>
                                @role('admin')
                                    <!-- Nav Item - bell -->
                                    <li class="nav-item mx-1">
                                        <a class="nav-link" href="{{ url('/order-approval') }}">
                                            <i class=" fas fa-bell"></i>
                                            <span class="position-absolute translate-middle-x badge bg-danger"
                                                style="font-size: 9px">{{ $count_bell }}</span>
                                        </a>
                                    </li>
                                @endrole
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                        @if (Auth::user()->image != null)
                                            <img class="img-profile rounded-circle" width="30px"
                                                src="{{ asset(Auth::user()->image) }}">
                                        @else
                                            <img class="img-profile rounded-circle" width="30px"
                                                src="https://image.shutterstock.com/mosaic_250/169412572/1040084344/stock-vector-man-icon-vector-1040084344.jpg">
                                        @endif
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in position-absolute"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="{{ url('/home') }}">
                                            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Home
                                        </a>
                                        <a class="dropdown-item" href="{{ url('/profile') }}">
                                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Profile
                                        </a>
                                        <a class="dropdown-item disabled" href="#">
                                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Settings
                                        </a>
                                        <a class="dropdown-item disabled" href="#">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Activity Log
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                            data-bs-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
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

    @auth
        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <script src="{{ mix('/js/app.js') }}" defer></script>
</body>

</html>
