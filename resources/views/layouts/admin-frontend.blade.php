<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Lazreb, Logistics"> <!-- Favicon -->
    <link rel="icon" href="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671441634/lazreb/lab_1_r017da.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671441634/lazreb/lab_1_r017da.jpg" type="image/x-icon">
    <title>{{config('app.name')}} - Admin Dashboard</title>
    <!--Bootstrap css-->
    <link rel="stylesheet" href="{{URL::asset('dash/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <!--Style css -->
    <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('dash/assets/css/dark-style.css')}}" rel="stylesheet"> <!-- P-scrollbar css-->
    <link href="{{URL::asset('dash/assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet"> <!-- Sidemenu css -->
    <link href="{{URL::asset('dash/assets/css/closed-sidemenu.css')}}" rel="stylesheet">
    <!---Icons css-->
    <link href="{{URL::asset('dash/assets/css/icons.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
    <script>
        window.setTimeout(function() {
            $(".alert-timeout").fadeTo(500, 0).slideUp(1000, function(){
                $(this).remove(); 
            });
        }, 8000);
    </script>
</head>

<body class="app sidebar-mini rtl light-mode" data-new-gr-c-s-check-loaded="14.1089.0" data-gr-ext-installed="">
    <!-- Alerts  Start-->
    <div style="z-index: 100000; width: 100%; position: absolute; top: 0">
        @include('layouts.alert')
    </div>

    <div class="page">
        <div class="page-main">
            <!-- Header -->
            @includeIf('layouts.admin-header')
            <!-- Header Ends -->

            <!-- Sidebar -->
            @includeIf('layouts.admin-sidebar')
            <!-- Sidebar Ends -->

            <!-- Page-Content -->
            @yield('page-content')
            <!-- Page-Content Ends -->

            <!-- Footer -->
            @includeIf('layouts.admin-footer')
            <!-- Footer Ends -->
        </div>
    </div>

    <!-- Back to top -->
    <a href="#top" id="back-to-top" style="display: none;"><i class="fa fa-angle-up"></i></a>
    <!-- Jquery js-->
    <script src="{{URL::asset('dash/assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/js/jquery.sparkline.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/js/circle-progress.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/rating/jquery.rating-stars.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/sidemenu/sidemenu.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/p-scrollbar/p-scrollbar-leftmenu.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/sidebar/sidebar.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/counters/jquery.missofis-countdown.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/counters/counter.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/chart/chart.bundle.js')}}"></script>
    <script src="{{URL::asset('dash/assets/plugins/chart/utils.js')}}"></script>
    <script src="{{URL::asset('dash/assets/js/index5.js')}}"></script>
    <script src="{{URL::asset('dash/assets/js/custom.js')}}"></script>
    <script>
        function myCopy() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
        }

        function myCopyCode() {
        /* Get the text field */
        var copyText = document.getElementById("myCode");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
        }
    </script>
</body>

</html>