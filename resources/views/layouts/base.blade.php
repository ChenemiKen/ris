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
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}" />
        <link rel="stylesheet" href="{{asset('css/main.css')}}" />
        <link rel="stylesheet" href="{{asset('css/components.css')}}" />
        <!-- Custom style CSS -->
        <link rel="stylesheet" href="{{asset('css/custom.css')}}" />
        <!-- Responsive CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" />
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
                        {{-- <li class="dropdown dropdown-list-toggle mu_notific_pos">
                            <a href="#" data-toggle="dropdown" class="noti_red nav-link notification-toggle nav-link-lg">
                                <i data-feather="bell" class="bell"></i>
                                <span class="noti_red_posi"></span>
                            </a>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                                <div class="dropdown-list-content dropdown-list-message">
                                    <a href="#" class="dropdown-item">
                                        <span class="dropdown-item-avatar text-white"> <img alt="image" src="{{asset('img/profile.png')}}" class="rounded-circle" /> </span>
                                        <span class="dropdown-item-desc">
                                            <span class="message-user">Victoria <span class="mu_not_light_font"> added to wishlist iPhone.</span></span>
                                            <span class="time">2 Min Ago</span>
                                        </span>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <span class="dropdown-item-avatar text-white">
                                            <img alt="image" src="{{asset('img/profile.png')}}" class="rounded-circle" />
                                        </span>
                                        <span class="dropdown-item-desc">
                                            <span class="message-user">Victoria <span class="mu_not_light_font">added to wishlist apple.</span></span>
                                            <span class="time">5 Min Ago</span>
                                        </span>
                                    </a>
                                    
                                    <a href="#" class="dropdown-item">
                                        <span class="dropdown-item-avatar text-white">
                                            <img alt="image" src="{{asset('img/profile.png')}}" class="rounded-circle" />
                                        </span>
                                        <span class="dropdown-item-desc">
                                            <span class="message-user">Victoria <span class="mu_not_light_font">added to wishlist apple.</span></span> <span class="time">1 Days Ago</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </li> --}}
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="mu_profile_items nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <span class="d-none d-lg-inline-block mu_profile_items_right">
                                    <span class="mu_profile_items_right2"> Welcome, {{Auth::user()->firstname}} {{Auth::user()->lastname}}</i></span>
                                </span>
                                <span class="mu_profile_items_left"><img alt="image" src="{{asset('img/profile.png')}}" class="user-img-radious-style" /></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right pullDown mu_profile_items_a_design">
                                <a href="User_module_account.html" class="dropdown-item has-icon"> 
                                    <i class="fas fa-user"></i> 
                                    Profile 
                                </a>
                                <a href="User_module_account.html" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i>
                                    Account Settings
                                </a>
                                <a href="help.html" class="dropdown-item has-icon">
                                    <i class="fas fa-headset"></i>
                                    Help & Support
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
                <div class="main-sidebar sidebar-style-2">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <a href="index.html">
                                {{-- <span class="mini-logo "><img alt="img" src="{{asset('img/logo.png')}}" class="header-logo" /></span>  --}}
                                <span class="logo-name"><img src="{{asset('img/logo.png')}}" /></span>
                            </a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="dropdown">
                                <a class="nav-link active" href="{{route('pupils')}}"><span>Pupils</span></a>
                            </li>
                             <li class="dropdown">
                                <a class="nav-link" href="{{route('teachers')}}"><span>Teachers</span></a>
                            </li>
                            <li class="dropdown">
                                <a class="nav-link" href="parent.html"><span>Parents</span></a>
                            </li>
                             <li class="dropdown">
                                <a class="nav-link" href="results.html"><span>Results</span></a>
                            </li>
                             <li class="dropdown">
                                <a class="nav-link" href="messages.hml"><span>Messages</span></a>
                            </li>
                             <li class="dropdown">
                                <a class="nav-link" href="homework.html"><span>Homework</span></a>
                            </li>
                             <li class="dropdown">
                                <a class="nav-link" href="calendar.html"><span>School Calendar</span></a>
                            </li>
                            <li class="dropdown">
                                <a class="nav-link" href="birthday.html"><span>Today's Birthdays</span></a>
                            </li>
                        </ul>
                    </aside>
                </div>
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
                        </div>
                    </section>
                </div>
                <!--============================== End Main Content ==============================-->
            </div>
        </div>

        <!--Start Gift Exchange Modal -->
        {{-- <div class="gift-modal modal fade" id="add-modals" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Start gift exchange -->
                    <div class="gift-exchange">
                        <!-- start gift exchange left content -->
                        <div class="gift-exchange-left-content">
                            <div class="gift-exchange-heading-text">
                                <h2>Create Gift Exchange</h2>
                                <p>Just need a few details from you, and our elves will do the rest!</p>
                            </div>
                            <div class="gift-exchange-form-btn">
                                <form action="">
                                    <input type="text" placeholder="New Gift Exchnage" name="exchange" id="exchange" />
                                </form>
                                <div class="gift-exchange-btn">
                                    <button>Create Event</button>
                                    <button data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <!-- end gift exchange left content -->

                        <!-- start gift exchange right content -->
                        <div class="gift-exchange-right-content">
                            <img src="assets/img/popup/gift.png" alt="Images" />
                        </div>
                        <!-- end gift exchange right content -->
                    </div>
                    <!-- End gift exchange -->
                </div>
            </div>
        </div> --}}
        <!--End Gift Exchange Modal -->

        <!-- General JS Scripts -->
        <script src="{{asset('js/app.min.js')}}"></script>
        <!-- JS Libraies -->
        <!-- Page Specific JS File -->
        <!-- Template JS File -->
        <script src="{{asset('js/scripts.js')}}"></script>
        {{-- <script src="{{asset('js/scripts2.js')}}"></script> --}}
        <script src="{{asset('js/calendar.js')}}"></script>
        <!-- Start Main JS -->
        <script src="{{asset('js/main.js')}}"></script>
    </body>
    <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
