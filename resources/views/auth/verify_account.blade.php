<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <!-- Favocon -->
    <link rel="shortcut icon" href="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671441634/lazreb/lab_1_r017da.jpg" type="image/x-icon">
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
    <title>{{config('app.name')}} - Verify Email</title>
    <script>
        window.setTimeout(function() {
            $(".alert-timeout").fadeTo(500, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 8000);
    </script>
</head>

<body>
    <!-- Alerts  Start-->
    <div style="z-index: 100000; width: 100%; position: absolute;">
        @include('layouts.alert')
    </div>
    <!-- Alerts End -->
    <div class="login-main accept">
        <div class="container-fluid g-0">
            <div class="row">
                <div class="col-xl-4"></div>
                <div class="col-xl-4">
                    <div class="form-sec">
                        <a href="/"> <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671441634/lazreb/lab_1_r017da.jpg"></a>
                        <h2>Verify Your Account</h2>
                        <div class="line-rule"></div>
                        <form method="POST" action="{{ route('email.confirmation', Crypt::encrypt($user->id))}}">
                            @csrf
                            <p class="text">Before proceeding, please check your email for a verification code.</p>
                            <p class="text">
                                If you don't hear from us within the next few minutes, please make sure to check your spam folder or use a different email address
                            </p>
                            <!--Email-->
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8 text-align: center;">
                                    <div class="mb-4 mt-4" style="display: flex; justify-content: center;">
                                        <input type="number" name="first" class="code" min="0" max="9" required />
                                        <input type="number" name="second" class="code" min="0" max="9" required />
                                        <input type="number" name="third" class="code" min="0" max="9" required />
                                        <input type="number" name="fourth" class="code" min="0" max="9" required />
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <!--Button-->
                            <div class="mb-4">
                                <button class="form-btn" type="submit">Verify Account</button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route('email.verify.resend', Crypt::encrypt($user->email)) }}">
                            @csrf
                            <div class="text-center text-dark">
                                {{ __('If you did not receive the email') }},
                                <button class="text-dark" style="margin-top: 0px; border: none; background: transparent;" type="submit">{{ __('Click here to request another') }}</button>
                            </div>
                        </form>
                        <!--Alt Opt-->
                    </div>
                </div>
                <div class="col-xl-4"></div>
            </div>
        </div>
    </div>
    <script>
        // Verify Account
        const codes = document.querySelectorAll(".code");

        codes[0].focus();

        codes.forEach((code, index) => {
            code.addEventListener("keydown", (e) => {
                if (e.key >= 0 && e.key < 10) {
                    codes[index].value = "";
                    setTimeout(() => {
                        codes[index + 1].focus();
                    }, 10);
                } else if (e.key === "Backspace") {
                    setTimeout(() => {
                        codes[index - 1].focus();
                    }, 10);
                }
            });
        });
    </script>
</body>