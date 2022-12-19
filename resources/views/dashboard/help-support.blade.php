@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Help & Support</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-danger btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->
        <div class="row ">
            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-6 ">
                <div class="card service">
                    <div class="card-body">
                        <div class="item-box text-center">
                            <div class=" text-center  mb-4 text-primary"><i class="fa fa-phone"></i></div>
                            <div class="item-box-wrap">
                                <h5 class="mb-2 font-weight-semibold">Phone Customer Care</h5>
                                <p class="text-default mb-0">+2323131312312123123</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
                <div class="card service">
                    <div class="card-body">
                        <div class="item-box text-center">
                            <div class=" text-center text-danger mb-4"><i class="fa fa-envelope"></i></div>
                            <div class="item-box-wrap">
                                <h5 class="mb-2 font-weight-semibold">Email Customer Care</h5>
                                <p class="text-default mb-0">lazreb@lazreb.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
                <div class="card service">
                    <div class="card-body">
                        <div class="item-box text-center">
                            <div class=" text-center text-success mb-4"><i class="fa fa-user-secret"></i></div>
                            <div class="item-box-wrap">
                                <h5 class="mb-2 font-weight-semibold">Privacy Policy</h5>
                                <a href="#"><p class="text-default mb-0">Click to read through our privacy and policy</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-6">
                <div class="card service">
                    <div class="card-body">
                        <div class="item-box text-center">
                            <div class="text-center text-secondary mb-4"><i class="fa fa-shield"></i></div>
                            <div class="item-box-wrap">
                                <h5 class="mb-2 font-weight-semibold">Terms and Conditions</h5>
                                <a href="#"><p class="text-default mb-0">Click to read through our terms and conditions</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End side app-->
</div>
@endsection