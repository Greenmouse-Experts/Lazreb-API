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
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <div class="icon">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671643224/lazreb/Vector_3_zibjrf.png" draggable="false" alt="">
                    </div>
                    <div class="last">
                        <h4>
                        Hire a Vehicle
                        </h4>
                        <p>
                        Hire your choice vehicle in the best working condition for your special occasions and use.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="icon">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671643223/lazreb/Group_47464_vdc9pb.png" draggable="false" alt="">
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
                <div class="col-lg-1"></div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <div class="icon">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671643222/lazreb/Group_47465_o8nce6.png" draggable="false" alt="">
                    </div>
                    <div class="last">
                        <h4>
                        Lease Vehicle
                        </h4>
                        <p>
                        Get the best deals and offer when leasing a vehicle of your choice for your duration of time.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="icon">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671643224/lazreb/Vector_2_1_u8dhuz.png" draggable="false" alt="">
                    </div>
                    <div class="last">
                        <h4>
                        Charter Vehicle
                        </h4>
                        <p>
                        Our Charter and transportation services are top notch, guaranteeing you the comfort you need for a successful journey
                        </p>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section>
<!--Carter Ends-->

@endsection