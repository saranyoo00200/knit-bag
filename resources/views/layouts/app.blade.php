<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KNOMPUNG</title>
    <link rel="shortcut icon" href="https://scontent.fbkk14-1.fna.fbcdn.net/v/t1.15752-9/271586309_3849771325247301_4125587798937102478_n.jpg?_nc_cat=110&ccb=1-5&_nc_sid=ae9488&_nc_eui2=AeEsrxK0BqFhdkhMNaDWXhDUv94aP7t75Ze_3ho_u3vll6lVhhMAOSr1L035Ph7fHMMohlldUwgfun3Ju_Y3MHCA&_nc_ohc=VGvjauG0Ab8AX8XIqag&_nc_ht=scontent.fbkk14-1.fna&oh=03_AVKq60aRglxyxia9HoW7pIRfYXQ-BQI_SU-Y8W76why4SQ&oe=6212D9A0" type="image/x-icon" />


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    {{-- icon --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- Styles -->

    {{-- bootstrap 4.6 --}}
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-light" id="page-top">
    <div id="app">
        @guest
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        KNOMPUNG
                        {{-- {{ config('app.name', 'Laravel') }} --}}
                    </a>
                    <div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                                            href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="py-3">
                @yield('content')
            </main>
        @else
            @php
                $count_cart = DB::table('user_products')
                    ->where('user_id', Auth()->user()->id)
                    ->count();
            @endphp
            <!-- Page Wrapper -->
            <div id="wrapper">

                <!-- Sidebar -->
                <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                        <div class="sidebar-brand-icon rotate-n-15">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="sidebar-brand-text mx-3">KNIT BAG</div>
                    </a>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/home') }}">
                            <i class="fas fa-home"></i>
                            <span>Home Page</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    @role('admin')
                        <!-- Heading -->
                        <div class="sidebar-heading">
                            Management
                        </div>

                        <li class="nav-item {{ request()->routeIs('products') ? 'active' : '' }}">
                            <a class="nav-link {{ request()->routeIs('products') ? '' : 'collapsed' }}" href="#"
                                data-toggle="collapse" data-target="#Products" aria-expanded="true" aria-controls="Products">
                                <i class="fab fa-product-hunt"></i>
                                <span>Products</span>
                            </a>
                            <div id="Products" class="collapse {{ request()->routeIs('products') ? 'show' : '' }}"
                                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Custom Products:</h6>
                                    <a class="collapse-item {{ request()->routeIs('products') ? 'active' : '' }}"
                                        href="{{ url('/management/products') }}">Products</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item {{ request()->routeIs('users') ? 'active' : '' }}">
                            <a class="nav-link {{ request()->routeIs('users') ? '' : 'collapsed' }}" href="#"
                                data-toggle="collapse" data-target="#Users" aria-expanded="true" aria-controls="Users">
                                <i class="fas fa-user-tag"></i>
                                <span>Users</span>
                            </a>
                            <div id="Users" class="collapse {{ request()->routeIs('users') ? 'show' : '' }}"
                                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Custom Users:</h6>
                                    <a class="collapse-item {{ request()->routeIs('users') ? 'active' : '' }}"
                                        href="{{ url('/management/users') }}">Users</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item {{ request()->routeIs('checkSales') ? 'active' : '' }}">
                            <a class="nav-link {{ request()->routeIs('checkSales') ? '' : 'collapsed' }}" href="#"
                                data-toggle="collapse" data-target="#CheckSales" aria-expanded="true" aria-controls="Users">
                                <i class="fas fa-search-dollar"></i>
                                <span>Check sales</span>
                            </a>
                            <div id="CheckSales" class="collapse {{ request()->routeIs('checkSales') ? 'show' : '' }}"
                                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">check sales:</h6>
                                    <a class="collapse-item {{ request()->routeIs('checkSales') ? 'active' : '' }}" href="
                                                                                /check-sales">Sales</a>
                                </div>
                            </div>
                        </li>

                        <!-- Divider -->
                        <hr class="sidebar-divider d-none d-md-block">
                    @endrole

                    <!-- my product -->
                    <div class="sidebar-heading">
                        my selected product
                    </div>

                    <li class="nav-item {{ request()->routeIs('myProducts', 'orderHistorys') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('myProducts', 'orderHistorys') ? '' : 'collapsed' }}"
                            href="#" data-toggle="collapse" data-target="#myProducts" aria-expanded="true"
                            aria-controls="Products">
                            <i class="fas fa-shopping-cart"></i>
                            <span>My Products</span>
                        </a>
                        <div id="myProducts"
                            class="collapse {{ request()->routeIs('myProducts', 'orderHistorys') ? 'show' : '' }}"
                            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Custom Products:</h6>
                                <a class="collapse-item {{ request()->routeIs('myProducts') ? 'active' : '' }}"
                                    href="{{ url('/my-products') }}">Products</a>
                                <a class="collapse-item {{ request()->routeIs('orderHistorys') ? 'active' : '' }}"
                                    href="{{ url('/order-historys') }}">Order Historys</a>
                            </div>
                        </div>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                </ul>
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Topbar -->
                        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                            <!-- Sidebar Toggle (Topbar) -->
                            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                <i class="fa fa-bars"></i>
                            </button>

                            <!-- Topbar Search -->
                            <form
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <!-- Topbar Navbar -->
                            <ul class="navbar-nav ml-auto">

                                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                                <li class="nav-item dropdown no-arrow d-sm-none">
                                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-search fa-fw"></i>
                                    </a>
                                    <!-- Dropdown - Messages -->
                                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                        aria-labelledby="searchDropdown">
                                        <form class="form-inline mr-auto w-100 navbar-search">
                                            <div class="input-group">
                                                <input type="text" class="form-control bg-light border-0 small"
                                                    placeholder="Search for..." aria-label="Search"
                                                    aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-search fa-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>

                                <!-- Nav Item - heart -->
                                <li class="nav-item mx-1">
                                    <a class="nav-link" href="{{ url('/order-historys') }}">
                                        <i class="fas fa-history"></i>
                                        <span class="badge badge-danger badge-counter">0</span>
                                    </a>
                                </li>

                                <!-- Nav Item - cart -->
                                <li class="nav-item mx-1">
                                    <a class="nav-link" href="{{ url('/my-products') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span class="badge badge-danger badge-counter">{{ $count_cart }}</span>
                                    </a>
                                </li>

                                <div class="topbar-divider d-none d-sm-block"></div>

                                <!-- Nav Item - User Information -->
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span
                                            class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                        @if (Auth::user()->image != null)
                                            <img class="img-profile rounded-circle"
                                                src="{{ asset(Auth::user()->image) }}">
                                        @else
                                            <img class="img-profile rounded-circle"
                                                src="https://image.shutterstock.com/mosaic_250/169412572/1040084344/stock-vector-man-icon-vector-1040084344.jpg">
                                        @endif
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown">
                                        <a class="dropdown-item {{ request()->routeIs('home') ? 'active' : '' }}"
                                            href="{{ url('/home') }}">
                                            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Home
                                        </a>
                                        <a class="dropdown-item {{ request()->routeIs('profile') ? 'active' : '' }}"
                                            href="{{ url('/profile') }}">
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
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>

                            </ul>

                        </nav>
                        <!-- End of Topbar -->

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <section> {{-- - class="py-4" - --}}
                                @yield('content')
                            </section>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="mt-auto bg-white">
                        <section class="container p-2">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6 col-lg-8 text-md-start">
                                    <div class="p-3 text-auto">Ecommerce for <u>KNOMPUNG</u> stores.</div>
                                </div>
                                <div class="col-md-6 col-lg-4 ml-lg-0 text-center text-md-end">
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
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
        @endguest


    </div>

    <!-- Scripts -->

    {{-- vue app --}}
    <script src="{{ mix('/js/app.js') }}"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @yield('script')

    <!-- End Scripts -->
</body>

</html>
