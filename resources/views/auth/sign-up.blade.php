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
    <title>{{config('app.name')}} - Signup</title>
</head>

<body>
    <section>
        <div class="container-fluid g-0">
            <div class="row">
                <div class="col-xl-3"></div>
                <div class="col-xl-6">
                    <div class="form-sec">
                        <a> <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669194994/lazreb/IMG-20221122-WA0030_1_1_mceisb.png"></a>
                        <h2>Create Your Account</h2>
                        <div class="line-rule"></div>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Full Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="text" placeholder="Enter Your First Name" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Sex</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <select>
                                                <option value="Select gender">Select gender</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="email" placeholder="Enter Your Email" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Phone number</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="tel" placeholder="Enter Your Phone number" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="password" placeholder="Enter Your Password" required>
                                            <i class="toggle-password fa fa-fw fa-eye-slash" title="Toggle to show/hide password"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Confirm password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <input type="password" placeholder="Comfirm Password" required>
                                            <i class="toggle-password fa fa-fw fa-eye-slash" title="Toggle to show/hide password"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Referral Code</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <input type="text" placeholder="Enter referral code (if any)" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text">
                                By Signing Up, I Agree to the Terms and Conditions and Privacy Policy</p>
                            <!--Button-->
                            <div class="mb-3">
                                <button type="submit">Sign Up</button>
                            </div>
                        </form>
                        <!--Alt Opt-->
                        <p class="alt-opt">Already have an account ? <a href="{{ route('log')}}">Login</a></p>
                    </div>
                </div>
                <div class="col-xl-3"></div>
            </div>
        </div>
    </section>
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