@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Services Requests</h1>
            <div class="ml-auto">
                <div class="input-group"> 
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a> 
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a> 
                    <a href="" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a> 
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