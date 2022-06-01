<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
        <title>R.I.S Portal - @yield('title')</title>
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo.png')}}" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="{{asset('fonts/new_font/stylesheet.css')}}" />
        <!-- Fontawesome CDN -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{asset('css/app.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}" />
        <link rel="stylesheet" href="{{asset('css/main.css')}}" />
        <link rel="stylesheet" href="{{asset('css/components.css')}}" />
        <!-- Custom style CSS -->
        <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
        <!-- Responsive CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" />
        @section('page-extrahead')@show
    </head>

    <body>
        {{-- <div class="loader"></div> --}}
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <!--============================== Start Dashboard (Edit) ==============================-->
                <div class="navbar-bg"></div>
                {{-- navbar --}}
                <nav class="navbar navbar-expand-lg main-navbar sticky mu_mes_not_pro_dashboard">
                    <div class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li>
                                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a>
                            </li>
                            <li>
                              @yield('page-heading')
                            </li>
                        </ul>
                    </div>
                    <ul class="navbar-nav navbar-right">     
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="mu_profile_items nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <span class="d-none d-lg-inline-block mu_profile_items_right">
                                    <span class="mu_profile_items_right2"> Welcome, {{Auth::user()->fullname}}</i></span>
                                </span>
                                <span class="mu_profile_items_left"><img alt="image" src="{{asset('img/profile.png')}}" class="user-img-radious-style" /></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right pullDown mu_profile_items_a_design">
                                <a href="User_module_account.html" class="dropdown-item has-icon"> 
                                    <i class="fas fa-user"></i> 
                                    Edit Profile 
                                </a>
                                <a href="User_module_account.html" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i>
                                    Change password
                                </a>
                                <a href="{{route('logout')}}" class="dropdown-item has-icon">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                {{-- end navbar --}}
                {{-- sidebar --}}
                @section('sidebar')
                <div class="main-sidebar sidebar-style-2">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <a href="index.html">
                                <span class="logo-name"><img src="{{asset('img/logo.png')}}" /></span>
                            </a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="dropdown">
                                <a class="nav-link" href="{{route('results')}}"><span><strong>Results</strong></span></a>
                            </li>
                            @can('is-admin')
                                <li class="dropdown">
                                    <a class="nav-link active" href="{{route('primary-reports')}}"><span>Primary results</span></a>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link" href="{{route('nursery-reports')}}"><span>Nursery results</span></a>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link" href="{{route('playgroup-reports')}}"><span>Playgroup results</span></a>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link" href="{{route('beacon-reports')}}"><span>Beacon results</span></a>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link" href="{{route('terms')}}"><span>Manage Terms</span></a>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link" href="{{route('subjects')}}"><span>Manage Subjects</span></a>
                                </li>
                                <li class="dropdown">
                                    <a class="nav-link" href="{{route('skills')}}"><span>Manage Skills</span></a>
                                </li>
                            @endcan
                            <li class="dropdown">
                                <a class="nav-link" href="{{route('home')}}"><span><strong>Back to Dashboard</strong></span></a>
                            </li>
                        </ul>
                    </aside>
                </div>
                @show
                {{-- end sidebar --}}
                <!--============================== End Dashboard (Edit) ==============================-->
                
                <!--============================== Start Main Content ==============================-->
                <div class="main-content">
                    <section class="section">
                        <div class="section-body"> 
                            {{-- Session messages --}}
                            <div id="app">
                                @include('layouts.flash_message')
                                @yield('content')
                            </div>
                            @section('page-content')@show
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{route('primary-reports')}}">
                                        <div class="dir">
                                            <p href="">Primary Results</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('nursery-reports')}}">
                                        <div class="dir">
                                            <p href="">Nursery Results</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('beacon-reports')}}">
                                        <div class="dir">
                                            <p href="">Beacon Results</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('playgroup-reports')}}">
                                        <div class="dir">
                                            <p href="">Playgroup Results</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{route('terms')}}">
                                        <div class="dir dir-sm">
                                            <p href="">Terms</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{route('subjects')}}">
                                        <div class="dir dir-sm">
                                            <p href="">Subjects</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{route('skills')}}">
                                        <div class="dir dir-sm">
                                            <p href="">Skills</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!--============================== End Main Content ==============================-->
            </div>
        </div>

        @section('page-extrascripts')@show
        <!-- General JS Scripts -->
        <script src="{{asset('js/app.min.js')}}"></script>
        <!-- JS Libraies -->
        <!-- Page Specific JS File -->
        <!-- Template JS File -->
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        {{-- <script src="{{asset('js/scripts2.js')}}"></script> --}}
        {{-- <script src="{{asset('js/calendar.js')}}"></script> --}}
        <!-- Start Main JS -->
        <script src="{{asset('js/custom.js')}}"></script>
    </body>
    <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
