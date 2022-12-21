@extends('layouts.frontend')

@section('page-content')
<!-- Welcome Page -->
<!--Breadcrumb-->
<section class="Breadcrumb" style="background-image: url(https://res.cloudinary.com/greenmouse-tech/image/upload/v1669633671/lazreb/Rectangle_61_1_tlkncf.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Our Services</h1>
                <p><a href="{{ route('index')}}">Home</a> <i class="bi bi-arrow-left-right"></i> Our Services</p>
            </div>
        </div>
    </div>
</section>
<!--Breadcrumb Ends-->

<!--Carter-->
    <section class="Carter">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="icon">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669633672/lazreb/Rectangle_92_giytak.png" draggable="false" alt="">
                    </div>
                    <div class="last">
                        <h4>
                            Charter & Transportation
                        </h4>
                        <p>
                            Our Charter and transportation services are top notch, guaranteeing you the comfort you need for a successful journey
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669633672/lazreb/Rectangle_94_z6ufl9.png" draggable="false" alt="">
                    </div>
                    <div class="last">
                        <h4>
                            Vehicles Leasing
                        </h4>
                        <p>
                        Cars and automobiles in best condition are available for leasing at affordable rates.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669633672/lazreb/Rectangle_96_kaf3ks.png" draggable="false" alt="">
                    </div>
                    <div class="last">
                        <h4>
                            Fleet Management
                        </h4>
                        <p>
                            We are specialized in convoy and motorcade management with the best vehicle collection
                        </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669633671/lazreb/Rectangle_92_1_zz0jea.png" draggable="false" alt="">
                    </div>
                    <div class="last">
                        <h4>
                        Vehicles Rentals
                        </h4>
                        <p>
                        Hire your choice vehicle in the best working condition for your special occasions and use.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--Carter Ends-->

@endsection