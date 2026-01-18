<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Shipping Record System</title>
    <link rel="icon" href="{{ asset('images/logo1.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}" style="font-style:italic">
                    <img src="{{ asset('images/logo1.png') }}" alt="" style="max-height:40px;">
                    <span style="color: green;">Shipping</span><span style="color: #3335e8;">Record</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto ms-md-5">
                        @if(auth()->user()->role_id == 1)
                        <li class="mx-md-3 my-3">
                            <a href="{{ url('/order/add') }}" class="text-decoration-none fw-bold text-success">တင်ပို့ကုန်ထည့်သွင်းရန်</a>
                        </li>
                        <li class="mx-md-3 my-3">
                            <a href="{{ url('/user/'.auth()->user()->id.'/orders') }}" class="text-decoration-none fw-bold text-success">အချက်လက်ကြည့်ရန်</a>
                        </li>
                        @endif
                        @if(auth()->user()->role_id == 2)
                        <li class="mx-md-3 my-3">
                            <a href="{{ url('/orders') }}" class="text-decoration-none fw-bold text-success">ပို့ကုန်စာရင်းကြည့်ရန်</a>
                        </li>
                        <li class="mx-md-3 my-3">
                            <a href="{{ url('/facts/add') }}" class="text-decoration-none fw-bold text-success">အချက်လက်ထည့်သွင်းရန်</a>
                        </li>
                        <li class="mx-md-3 my-3">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle text-success text-decoration-none fw-bold" data-bs-toggle="dropdown" aria-expanded="false">
                                    အချက်အလက်ကြည့်ရန်
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item text-success fw-bold" href="{{ url('/categories') }}">ကုန်ပစ္စည်းအမျိုးအစားများ</a></li>
                                    <li><a class="dropdown-item text-success fw-bold" href="{{ url('/products') }}">ကုန်အမည်များ</a></li>
                                    <li><a class="dropdown-item text-success fw-bold" href="{{ url('/sourceareas') }}">ပွဲရုံများ</a></li>
                                    <li><a class="dropdown-item text-success fw-bold" href="{{ url('/gates') }}">တင်ပို့ဂိတ်များ</a></li>
                                    <li><a class="dropdown-item text-success fw-bold" href="{{ url('/shops') }}">ဆိုင်များ</a></li>
                                </ul>
                            </div>
                        </li>

                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-success" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item fw-bold text-success" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    ထွက်ရန်
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a href="{{url('change-password')}}" class="dropdown-item fw-bold text-success">စကားဝှက်ပြောင်းရန်</a>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1 py-4">
            @yield('content')
        </main>
        <footer class="text-center py-2 px-2 mt-lg-5" style="background: rgba(28, 1, 56, 1);color: #fff;">
            <p style="font-size: 1.2em;" class="pt-2">
                &copy; 2025 Yangon-Lashio Shipping Record System. All rights reserved
            </p>
        </footer>
    </div>

</body>

</html>