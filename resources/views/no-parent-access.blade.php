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
        @section('page-extrahead')@show
    </head>

   <body>
        <div class="access-message-div">
            <h6 class="access-message">
                Access to the portal is restricted for now as upload of results is currently ongoing.</br>
                Do check back at a later time. For more information, contact the school management. Thanks!
            </h6>
        </div>
   </body>
    <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
