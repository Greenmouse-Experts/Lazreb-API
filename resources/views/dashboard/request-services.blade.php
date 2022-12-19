@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Services</h1>
            <div class="ml-auto">
                <div class="input-group"> 
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a> 
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a> 
                    <a href="{{route('user.help.support')}}" class="btn btn-danger btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a> 
                </div>
            </div>
        </div> 
        <!-- End page-header -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 feature">
                                <div class="fa-stack fa-lg fa-1x border btn-primary mb-3"> <i class="fa fa-globe fa-stack-1x text-white"></i> </div>
                            </div>
                            <div class="col-xl-10 col-lg-9">
                                <div class="mt-1">
                                    <h4 class="font-weight-semibold">Web design</h4>
                                    <p class="text-default">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 feature">
                                <div class="fa-stack fa-lg fa-1x border bg-orange mb-3"> <i class="fa fa-building-o fa-stack-1x text-white"></i> </div>
                            </div>
                            <div class="col-xl-10 col-lg-9">
                                <div class="mt-1">
                                    <h4 class="font-weight-semibold">Web Development</h4>
                                    <p class="text-default">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 feature">
                                <div class="fa-stack fa-lg fa-1x border bg-pink mb-3"> <i class="fa fa-file-word-o fa-stack-1x text-white"></i> </div>
                            </div>
                            <div class="col-xl-10 col-lg-9">
                                <div class="mt-1">
                                    <h4 class="font-weight-semibold">Wordpress</h4>
                                    <p class="text-default">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 feature">
                                <div class="fa-stack fa-lg fa-1x border bg-blue mb-3"> <i class="fa fa-camera fa-stack-1x text-white"></i> </div>
                            </div>
                            <div class="col-xl-10 col-lg-9">
                                <div class="mt-1">
                                    <h4 class="font-weight-semibold">photography</h4>
                                    <p class="text-default">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 feature">
                                <div class="fa-stack fa-lg fa-1x border bg-purple mb-3"> <i class="fa fa-pencil-square-o fa-stack-1x text-white"></i> </div>
                            </div>
                            <div class="col-xl-10 col-lg-9">
                                <div class="mt-1">
                                    <h4 class="font-weight-semibold">Development</h4>
                                    <p class="text-default">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2 col-lg-3 feature">
                                <div class="fa-stack fa-lg fa-1x border bg-success mb-3"> <i class="fa fa-eercast fa-stack-1x text-white"></i> </div>
                            </div>
                            <div class="col-xl-10 col-lg-9">
                                <div class="mt-1">
                                    <h4 class="font-weight-semibold">Android</h4>
                                    <p class="text-default">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
    </div>
</div>
@endsection