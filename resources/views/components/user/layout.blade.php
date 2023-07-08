<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/template/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/template/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/template/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/template/templatemo.css')}}">
    <link rel="stylesheet" href="{{asset('css/user/css/style.css')}}">
    <script src="https://kit.fontawesome.com/e0462e4fee.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @yield('userStyles')
    <title>Prime webshop</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none"
                       href="mailto:info@company.com">info@dealleswinkel.be</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">+32 468 26 54 81</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank">
                        <i class="fab fa-facebook-f fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank">
                        <i class="fab fa-instagram fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-light" href="https://twitter.com/" target="_blank">
                        <i class="fab fa-twitter fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank">
                        <i class="fab fa-linkedin fa-sm fa-fw"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="{{route('home')}}">
                <img src="{{asset("img/logo_no_bg.png")}}" height="50">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#templatemo_main_nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                 id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link {{Route::is('home') ? 'text-success' : ''}}"
                               href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Route::is('productcategories.index') || Route::is('user.productcategories.show')
                                                || Route::is('productcategories.show') ? 'text-success' : ''}}"
                               href="{{route('productcategories.index')}}">Shop</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="contact.html">Contact</a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <a class="nav-icon position-relative text-decoration-none" href="{{route('carts.index')}}">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light
                        text-dark">{{Session::get('cart') ? count(Session::get('cart')) : 0}}</span>
                    </a>
                    @if(!Session::get('admin'))
                        <a class="nav-icon position-relative text-decoration-none" href="{{route('loginView')}}">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        </a>
                    @else
                        <a href="{{route('logout')}}" class="ms-2">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </nav>
    {{$slot}}
<x-user.footer></x-user.footer>
