@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Services Requests</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('admin.dashboard')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Dashboard"> <span> <i class="fe fe-airplay"></i> </span> </a>
                    <a href="{{route('admin.users')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Users"> <span> <i class="fa fa-user"></i> </span> </a>
                    <a href="{{route('admin.get.services')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('admin.users.services.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Services Requests"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('admin.users.notifications')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Notifications"> <span> <i class="fa fa-bell"></i> </span> </a>
                    <a href="{{route('admin.users.transactions')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Transactions"> <span> <i class="fa fa-money"></i> </span> </a>
                </div>
            </div>
        </div>
        <!-- End page-header -->
        <!-- Row -->
        <div class="row">
            @foreach($services as $service)
            <div class="col-12">
                <a href="{{ route('user.view.requested.services', Crypt::encrypt($service->id))}}">
                    <div class="offer offer-primary">
                        <div class="shape">
                            <div class="shape-text"> 
                            @if($service->name == 'Hire A Vehicle')
                                {{\App\Models\HireVehicle::where('service_id', $service->id)->get()->count()}}
                            @elseif($service->name == 'Charter A Vehicle')
                                {{\App\Models\CharterVehicle::where('service_id', $service->id)->get()->count()}}
                            @elseif($service->name == 'Lease A Vehicle')
                                {{\App\Models\LeaseVehicle::where('service_id', $service->id)->get()->count()}}
                            @elseif($service->name == 'Partner Fleet Management')
                                {{\App\Models\PartnerFleetManagement::where('service_id', $service->id)->get()->count()}}
                            @endif
                            </div>
                        </div>
                        <div class="offer-content">
                            <h3 class="lead"> {{$service->name}} </h3>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <div class="col-12">
                <a href="{{route('admin.users.partnership.requests')}}">
                    <div class="offer offer-warning">
                        <div class="shape">
                            <div class="shape-text"> 
                            {{$partnerFleetManagement}}
                            </div>
                        </div>
                        <div class="offer-content">
                            <h3 class="lead"> Partner Fleet Management</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div> <!-- End Row -->
    </div>
</div>
@endsection