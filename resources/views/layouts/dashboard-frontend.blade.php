<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="IndoUi – Bootstrap 4 Admin Dashboard HTML Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="admin, admin dashboard template, admin panel template, admin template, best bootstrap admin template, bootstrap 4 admin template, bootstrap 4 dashboard template, bootstrap admin template, bootstrap dashboard template, html admin template, html5 dashboard template, html5 admin template, modern admin template, simple admin template, template admin bootstrap 4"> <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('dash/assets/images/brand/favicon.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('dash/assets/images/brand/favicon.ico')}}"> <!-- Title -->
    <title>IndoUi – Bootstrap 4 Admin Dashboard HTML Template</title>
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
            @includeIf('layouts.dashboard-header')
            <!-- Header Ends -->

            <!-- Sidebar -->
            @includeIf('layouts.dashboard-sidebar')
            <!-- Sidebar Ends -->

            <!-- Page-Content -->
            @yield('page-content')
            <!-- Page-Content Ends -->

            <!-- Footer -->
            @includeIf('layouts.dashboard-footer')
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
    <script src="{{URL::asset('dash/assets/switcher/js/switcher.js')}}"></script>
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