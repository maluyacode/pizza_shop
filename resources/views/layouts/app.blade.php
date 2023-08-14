<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">
    <link href="https://code.jquery.com/jquery-3.6.0.min.js">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    @yield('styles')
    {{-- Dropzone --}}

    <script src="{{ asset('asset/dropzone.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('asset/dropzone.min.css') }}">
    {{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" style="color: #fff">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Pizza Shop') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto" style="font-size: 16px !important;">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            <div class="dropdown-menu category-dropdown" aria-labelledby="navbarDropdownMenuLink">
                                {{-- <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a> --}}
                            </div>
                        </li>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto" style="gap: 10px; align-items:center">
                        <!-- Authentication Links -->
                        <li class="nav-item search-item">
                            <form action="{{ route('search') }}" method="GET" class="form-inline search-form">
                                @csrf
                                <div class="form-group ui-widget">
                                    <input type="text" class="form-control" placeholder="Enter terms ex. pizza"
                                        name="term" id="tags">
                                </div>
                                <button type="submit" class="btn btn-outline-secondary">Search</button>
                            </form>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <a href="{{ route('view.cart') }}" class="btn btn-outline-warning" href=""><i
                                    class="bi bi-cart4"></i> Cart
                                <span>({{ Session::get('cart') ? count(Session::get('cart')) : 0 }})</span></a>
                            <div class="dropdown show" style="height: fit-content;">
                                <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Management
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('chart') }}">Charts</a>
                                    <a class="dropdown-item" href="{{ route('product.index') }}">Manage Product</a>
                                    <a class="dropdown-item" href="{{ url('/category') }}">Manage Category</a>
                                    <a class="dropdown-item" href="{{ route('user.index') }}">Manage User</a>
                                    <a class="dropdown-item" href="{{ route('payment.index') }}">Manage Payment</a>
                                    <a class="dropdown-item" href="{{ route('order.index') }}">Manage Order</a>
                                </div>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="btn nav-link dropdown-toggle" href="{{ route('logout') }}"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    @if (count(Auth::user()->media) > 0)
                                        <img src="{{ Auth::user()->media[0]->original_url }}"
                                            style="width: 40px; height: 40px; border-radius: 50%; object-fit:cover">
                                    @else
                                        <img src="{{ asset('/storage/images/profilePic.jpg') }}"
                                            style="width: 40px; border-radius: 50%;">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('user.orders') }}">Orders</a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="display:flex; flex-direction:row; align-items:center; justify-content:space-between; position:absolute; width:100%; height:40px">
                <strong>{{ $message }}</strong>
                <button type="button" class="close btn btn-sm btn-outline-danger" data-dismiss="alert"
                    aria-label="Close">
                    <span>x</span>
                </button>
            </div>
        @endif
        @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert"
                style="display:flex; flex-direction:row; align-items:center; justify-content:space-between; position:absolute; width:100%; height:40px">
                <strong>{{ $message }}</strong>
                <button type="button" class="close btn btn-sm btn-outline-danger" data-dismiss="alert"
                    aria-label="Close">
                    <span>x</span>
                </button>
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script> --}}
    @yield('scripts')
    <script src="{{ asset('js/header.js') }}"></script>
</body>

</html>
