<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="Welcome To {{config('app.name')}}">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <!-- Favocon -->
    <link rel="shortcut icon" href="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671441634/lazreb/lab_1_r017da.jpg" type="image/x-icon">
    <!-- Style -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.map')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>{{config('app.name')}}</title>
</head>

<body>
    <!-- Header -->
    @includeIf('layouts.frontend-header')
    <!-- Header Ends -->

    <!-- Page-Content -->
    @yield('page-content')
    <!-- Page-Content Ends -->

    <!-- Footer -->
    @includeIf('layouts.frontend-footer')

    <script>
        // this function used to creat th countUp  animation for business websites
        // use the three parameters to customize it 
        // call it for every element
        // note that may be small diffrance in the count 100 be 99 so chack it 
        function numCounter(tagId, maxCount, speed) {
            var initialNumber = 0;

            function counter() {
                document.getElementById(tagId).innerHTML = initialNumber;
                ++initialNumber;
            }
            var counterDelay = setInterval(counter, speed);

            function totalTime() {
                clearInterval(counterDelay);
            }
            var totalPeriod = speed * (maxCount);
            setTimeout(totalTime, totalPeriod);
        }

        numCounter("Projects", 636, 10);
        numCounter("Clients", 336, 10);
        numCounter("Partners", 436, 10);
        numCounter("Move", 536, 10);
    </script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/main.js')}}"></script>
</body>

</html>