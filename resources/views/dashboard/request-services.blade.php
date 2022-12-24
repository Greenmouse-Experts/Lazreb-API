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
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="My Requests"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a> 
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a> 
                </div>
            </div>
        </div> 
        <!-- End page-header -->
        <!-- Row -->
        <div class="row">
            @foreach($services as $service)
            <div class="col-12">
                <a href="{{ route('user.get.service', Crypt::encrypt($service->id))}}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-2 col-lg-3 feature">
                                    <div class="fa-stack fa-lg fa-1x border btn-primary mb-3"> 
                                        <img src="{{$service->thumbnail}}" width="500"/>
                                    </div>
                                </div>
                                <div class="col-xl-10 col-lg-9">
                                    <div class="mt-1">
                                        <h4 class="font-weight-semibold">{{$service->name}}</h4>
                                        <p class="text-default">{{$service->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div> <!-- End Row -->
    </div>
</div>
@endsection