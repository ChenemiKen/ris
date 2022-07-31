<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet"> 
        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{public_path('css/bootstrap.min.css')}}" />
        <!-- Template CSS -->
        <link rel="stylesheet" href="{{public_path('css/main.css')}}" />

        <style>     
        /* additional styles */
            @page{
                margin:0cm;
                margin-top:1cm;
            }
            html{
                font-size: .8rem;
            }
            .font-medium {
                font-weight: 500;
            }
            .text-red-600 {
                --tw-text-opacity: 1;
                color: rgb(220 38 38 / var(--tw-text-opacity));
            }
            .text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem;
            }
            .list-disc {
                list-style-type: disc;
            }
            .list-inside {
                list-style-position: inside;
            }
            .mt-3 {
                margin-top: 0.75rem;
            }
            ol, ul, menu {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            .mb-4 {
                margin-bottom: .5rem;
            }
            .dark-link{
                color: rgb(20, 20, 20) !important;
            }
            .birthday-img{
                width: 13rem;
                height: 16rem;
            }
            .blue{
                color: rgb(111, 0, 255) !important;
            }
            .text-blue{
                color: #192F59;
            }
            .red{
                color: rgb(255, 0, 0) !important;
            }
            .green{
                color: rgb(0, 204, 68) !important;
            }
            .dtable{
                float:left;
                display:'block';
            }
            .max-score{
                margin-top:3rem;
            }

            .pupil-details-table,.pupil-details-table td{
                border: none !important;
            }

            .pupil-details-table tr {
                border-bottom: 1px solid rgb(145, 143, 143);
            }
            .pupil-details-table td{
                padding: 1.5rem 0rem .5rem 0rem;
            }
            .pupil-result-table th{
                background-color: #192F59;
                color: #fff;
            }
            .pupil-result-table td{
                background-color: #F4F4F4;
            }
            .pupil-result-table th, .pupil-result-table td{
                padding: 1rem;
            }
            .shade{
                width: 1.5rem !important;
                height: 1.5rem !important;
                background-color: rgb(20, 20, 20) !important;
            }
            
        </style>
        @section('page-extrahead')@show
    </head>

    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <!--============================== Start Dashboard (Edit) ==============================-->
                <!--============================== End Dashboard (Edit) ==============================-->
                <!--============================== Start Main Content ==============================-->
                <div class="main-content container">
                    <section class="section">
                        <div class="section-body"> 
                            @section('page-content')@show
                        </div>
                    </section>
                </div>
                <!--============================== End Main Content ==============================-->
            </div>
        </div>
    </body>
</html>
