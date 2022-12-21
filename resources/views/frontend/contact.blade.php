@extends('layouts.frontend')

@section('page-content')
<!-- Welcome Page -->
<!--Breadcrumb-->
<section class="Breadcrumb" style="background-image: linear-gradient(90deg,  #1d1d1d9a, #1d1d1d9a, #1a223ba2),  url(https://res.cloudinary.com/greenmouse-tech/image/upload/v1671549923/lazreb/bread-contact_fttdvx.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Contact Us</h1>
                <p><a href="{{ route('index')}}">Home</a> <i class="bi bi-arrow-left-right"></i> Contact Us</p>
            </div>
        </div>
    </div>
</section>
<!--Breadcrumb Ends-->

<!--Contact Page-->
<main class="contactPage">
    <!--Boxes-->
    <section class="boxes">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="box">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671550822/lazreb/pin_yjgpzn.png">
                        <h5>Address</h5>
                        <p><a href="#map">106, Isawo Road, Agric Bus Stop, Owutu, Ikorodu, Lagos State.</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671550823/lazreb/telephone_svojm8.png">
                        <h5>Phone Number</h5>
                        <p><a href="#">+2340-708-747-5680</a></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671550857/lazreb/email_xjeaa0.png">
                        <h5>Email Us</h5>
                        <p><a href="#"> support@lazrebleasinglogistics.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Form Section-->
    <section class="form-sec" id="message">
        <div class="container">
            <div class="row justify-content-center g-0">
                <div class="col-lg-6 form-area">
                    <h3>Message Us</h3>
                    <p>Drop us a message and we'll get back to you</p>
                    <form>
                        <div class="row">
                            <!--Full Name-->
                            <div class="col-lg-6">
                                <label for="name">FULL NAME</label>
                                <input type="text" placeholder="Name" required>
                            </div>
                            <!--Email Address-->
                            <div class="col-lg-6">
                                <label for="email">EMAIL ADDRESS</label>
                                <input type="email" placeholder="Email" required>
                            </div>
                            <!--Phone Number-->
                            <div class="col-lg-6">
                                <label for="phone">PHONE NUMBER</label>
                                <input type="tel" placeholder="Phone Number" required>
                            </div>
                            <!--Subject-->
                            <div class="col-lg-6">
                                <label for="subject">Subject</label>
                                <input type="text" placeholder="Subject" required>
                            </div>
                            <!--Message-->
                            <div class="col-lg-12">
                                <label for="message">Message</label>
                                <textarea cols="30" rows="5" placeholder="Type Your Message Here..." required></textarea>
                            </div>
                            <!--Button-->
                            <div class="col-lg-6">
                                <button type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="img-form-area">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Map Area-->
    <section class="map-area" id="map">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8070159.353263334!2d4.17939043005505!3d9.017382842503514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0baf7da48d0d%3A0x99a8fe4168c50bc8!2sNigeria!5e0!3m2!1sen!2sng!4v1642768890950!5m2!1sen!2sng" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection