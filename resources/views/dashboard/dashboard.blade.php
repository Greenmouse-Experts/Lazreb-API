@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- app-content-->
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title"><span class="subpage-title">Welcome, </span>{{Auth::user()->name}}</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="My Requests"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->
        <!-- Row -->
        <div class="row">
            <div class="col-sm-6 col-lg-6 col-xl-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-3">Total Service Requested</h6>
                        <h2 class="mb-2 number-font"><i class="zmdi zmdi-compass text-primary mr-2"></i>{{$userRequestServices}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 col-xl-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-3">Total People Referred</h6>
                        <h2 class="mb-2 number-font"><i class="fa fa-user text-secondary mr-2"></i>{{$referrals}}</h2>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->

        <div class="row">
            @foreach($services as $service)
            @if($service->name == 'Hire A Vehicle')
                <div class="col-lg-6 col-md-6">
                    <div class="offer offer-primary">
                        <div class="shape">
                            <div class="shape-text">
                                {{\App\Models\HireVehicle::where('user_id', Auth::user()->id)->where('service_id', $service->id)->get()->count()}}
                            </div>
                        </div>
                        <div class="offer-content">
                            <h3 class="lead"> {{$service->name}} </h3>
                        </div>
                    </div>
                </div>
            @elseif($service->name == 'Charter A Vehicle')
                <div class="col-lg-6 col-md-6">
                    <div class="offer offer-info">
                        <div class="shape">
                            <div class="shape-text">
                                {{\App\Models\CharterVehicle::where('service_id', $service->id)->where('user_id', Auth::user()->id)->get()->count()}}
                            </div>
                        </div>
                        <div class="offer-content">
                            <h3 class="lead"> {{$service->name}} </h3>
                        </div>
                    </div>
                </div>
            @elseif($service->name == 'Lease A Vehicle')
                <div class="col-lg-6 col-md-6">
                    <div class="offer offer-warning">
                        <div class="shape">
                            <div class="shape-text">
                                {{\App\Models\LeaseVehicle::where('service_id', $service->id)->where('user_id', Auth::user()->id)->get()->count()}}
                            </div>
                        </div>
                        <div class="offer-content">
                            <h3 class="lead"> {{$service->name}} </h3>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
            <div class="col-lg-6 col-md-6">
                    <div class="offer offer-success">
                        <div class="shape">
                            <div class="shape-text">
                                {{$partnerFleetManagement}}
                            </div>
                        </div>
                        <div class="offer-content">
                            <h3 class="lead"> Partner Fleet Management </h3>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Transactions</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered  mb-0 text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Slip</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <img class="userpicimg" src="{{$transaction->slip}}" width="50">
                                        </td>
                                        <td>{{$transaction->description}}</td>
                                        <td>{{$transaction->created_at->toDayDateTimeString()}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Activities</h3>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group projects-list">
                            @foreach($notifications as $notification)
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 font-weight-sembold text-dark">{{\App\Models\User::where('id', $notification->from)->first()->name}}</h6>
                                    <h6 class="text-dark mb-0 font-weight-sembold text-dark"></h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between"> 
                                    <span class="text-muted">{{$notification->subject}}</span> <span class="text-muted">{{$notification->created_at->diffForHumans()}}</span> </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
    </div>
    <!--End side app-->
</div>
<!-- End app-content-->
@endsection