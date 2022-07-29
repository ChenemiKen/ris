<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet">  -->
        <!-- <link rel="stylesheet" href="{{asset('fonts/new_font/stylesheet.css')}}" /> -->
        <!-- Fontawesome CDN -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" /> -->
        <!-- General CSS Files -->
        <!-- <link rel="stylesheet" href="{{asset('css/app.min.css')}}" /> -->
        <!-- <link rel="stylesheet" href="bootstrap.min.css" /> -->
        <!-- Template CSS -->
        <!-- {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}" /> --}} -->
        <!-- <link rel="stylesheet" href="{{asset('css/main.css')}}" /> -->
        <!-- <link rel="stylesheet" href="{{asset('css/components.css')}}" /> -->
        <!-- Custom style CSS -->
        <!-- <link rel="stylesheet" href="./custom.css" /> -->
        <!-- Responsive CSS -->
        <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/responsive.css')}}" /> -->

        <style>     
        /*# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiY3VzdG9tLmNzcyIsInNvdXJjZXMiOlsiY3VzdG9tLnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiJ9 */

        /*# sourceMappingURL=custom.css.map */

        /* additional styles */
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
            .pupil-details-table,.pupil-details-table td{
                border: none !important;
            }

            .pupil-details-table tr {
                border-bottom: 1px solid rgb(145, 143, 143);
            }
            .pupil-details-table td{
                padding: 2rem 2rem 1rem 0rem;
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
            .dirrow{
                display: flex;
                justify-content: space-evenly;
            }
            .dir{
                box-shadow: 2px 2px 10px #888888;
                padding: 4rem 1rem;
                text-align: center;
                margin-right: 3rem;
                margin-bottom: 4rem;
            }
            .dir-sm{
                padding: 1rem 0.5rem !important;
            }
            .dir p{
                color: #5c5b5b;
                font-weight: bold;
            }
            .btn-disable{
                background-color: #2B2875;
                color: white;
                margin-left: .5rem;
                margin-right: .5rem;
                margin-top: 1.5rem;
                margin-bottom: 2rem;
            }
            .btn-disable:hover{
                background-color: #830249 !important;
                color: white !important;
            }
            .btn-enable{
                background-color: #830249;
                color: white;
                margin-left: .5rem;
                margin-right: .5rem;
                margin-top: 1.5rem;
                margin-bottom: 2rem;
            }
            .btn-enable:hover{
                background-color: #2B2875 !important;
                color: white !important;
            }
            .access-message-div{
                display: flex;
                flex-direction: column;
                align-self: center;
                margin-top: 5rem;
                justify-content: center;
                align-items: center;
                align-content: center;
            }
            .access-message{
                background-color: #eedafc;
                border-radius: 0.5rem;
                padding: 2rem;
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
                <div class="main-content container my-5 py-5">
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
