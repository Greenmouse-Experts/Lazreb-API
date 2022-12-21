@extends('layouts.frontend')

@section('page-content')
<!-- Welcome Page -->
<!--Breadcrumb-->
<section class="Breadcrumb" style="background-image: linear-gradient(90deg,  #1d1d1d9a, #1d1d1d9a, #1a223ba2), url(https://res.cloudinary.com/greenmouse-tech/image/upload/v1671549922/lazreb/bread-faq_nal74q.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>FAQs</h1>
                <p><a href="{{ route('index')}}">Home</a> <i class="bi bi-arrow-left-right"></i> FAQs</p>
            </div>
        </div>
    </div>
</section>
<!--Breadcrumb Ends-->

<!--FAQ Page-->
<main class="faqPage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2>FAQ</h2>
                <div class="line-rule"></div>
            </div>
            <div class="col-lg-10">
                <div class="faq-box">
                    <details>
                        <summary>How can I rent a car</summary>
                        <div class="faq-content">
                            <p>Kindly sign up on our website or or visit the contact us page to rent a car</p>
                        </div>
                    </details>
                    <details>
                        <summary>What type of a car can I hire on lazreb?</summary>
                        <div class="faq-content">
                            <p>You can hire a wide variety of car,such as Prado Jeep, Hilux , Mini Bus , e.t.c</p>
                        </div>
                    </details>
                    <details>
                        <summary>Are expenses paid for if there is a breakdown on the vehicle before return date?</summary>
                        <div class="faq-content">
                            <p>We take care of expenses paterning car repairs</p>
                        </div>
                    </details>
                    <details>
                        <summary>Can I take my personal driver when I charter a vehicle?</summary>
                        <div class="faq-content">
                            <p>A driver is allocated to you on chatering a vehicle</p>
                        </div>
                    </details>
                    <details>
                        <summary>How long can I hire / lease a vehicle </summary>
                        <div class="faq-content">
                            <p>The time duration for a vehicle Lease or Hire is flexible to the clients choice, Althrough we have a short term lease and long term lease category</p>
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection