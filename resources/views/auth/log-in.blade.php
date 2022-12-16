<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <!-- Favocon -->
    <link rel="shortcut icon" href="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669194994/lazreb/IMG-20221122-WA0030_1_1_mceisb.png" type="image/x-icon">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Style -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.map')}}">
    <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('auth/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{config('app.name')}} - LogIn</title>
</head>

<body>
    <main class="login-main">
        <div class="container-fluid g-0">
            <div class="row">
                <div class="col-xl-4"></div>
                <div class="col-xl-4">
                    <div class="form-sec">
                        <a> <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669194994/lazreb/IMG-20221122-WA0030_1_1_mceisb.png"></a>
                        <h2>Login To Your Account</h2>
                        <div class="line-rule"></div>
                        <form>
                            <!--Email-->
                            <div class="mb-4">
                                <label for="email">Email</label>
                                <input type="email" placeholder="Enter email address" required>
                            </div>
                            <!--Password-->
                            <div class="mb-4">
                                <label for="password">Password</label>
                                <a href="#" class="forgot">Forgotten Password?</a>
                                <input type="password" placeholder="Enter password" required>
                                <i class="toggle-password fa fa-fw fa-eye-slash" title="Toggle to show/hide password"></i>
                            </div>
                            <!--Button-->
                            <div class="mb-4">
                                <button type="submit">Log In</button>
                            </div>
                        </form>
                        <!--Alt Opt-->
                        <p class="alt-opt">Don't have an account? <a href="{{ route('sign')}}">Signup</a></p>
                    </div>
                </div>
                <div class="col-xl-4"></div>
            </div>
        </div>
    </main>
    <script>
            // Script for Show/Hide Password 
            $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        </script>
</body>