@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Welcome, </span>{{Auth::user()->name}}</h1>
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
        </div> <!-- End page-header -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-4"> <span class="avatar align-self-center avatar-lg br-3 cover-image bg-secondary-transparent" style="display: flex; align-content: center; justify-content: center; align-items: center;"> <i class="fe fe-users text-secondary"></i> </span>
                            <div class="svg-icons text-right ml-auto">
                                <p class="text-muted">Total Users</p>
                                <h2 class="mb-0 number-font">{{$users->count()}}</h2>
                            </div>
                        </div>
                        <div class="progress progress-md h-2">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" style="width: {{$users}}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-4"> <span class="avatar align-self-center avatar-lg br-3 cover-image bg-success-transparent" style="display: flex; align-content: center; justify-content: center; align-items: center;"> <i class="fe fe-compass text-success"></i> </span>
                            <div class="svg-icons text-right ml-auto">
                                <p class="text-muted">Total Service Requested</p>
                                <h2 class="mb-0 number-font">{{$userRequestServices}}</h2>
                            </div>
                        </div>
                        <div class="progress progress-md h-2">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: {{$userRequestServices}}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex mb-4"> 
                            <span class="avatar align-self-center avatar-lg br-3 cover-image bg-warning-transparent" style="display: flex; align-content: center; justify-content: center; align-items: center;"> <i class="fa fa-money text-warning"></i> </span>
                            <div class="svg-icons text-right ml-auto">
                                <p class="text-muted">Total Transactions</p>
                                <h2 class="mb-0 number-font">{{$transactions}}</h2>
                            </div>
                        </div>
                        <div class="progress progress-md h-2">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: {{$transactions}}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-3"> 
                <div class="card"> 
                    <div class="card-header"> 
                        <div class="d-flex"> 
                            <h3 class="card-title mt-1">Hire A Vehicle</h3> 
                        </div> 
                    </div> 
                    <div class="card-body"> 
                        <div>
                            <h2 class="mb-2 number-font">{{$hireService}}</h2>
                            <div class="progress progress-md h-1 mb-1"> 
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: {{$hireService}};"></div> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-3"> 
                <div class="card"> 
                    <div class="card-header"> 
                        <div class="d-flex"> 
                            <h3 class="card-title mt-1">Charter A Vehicle</h3> 
                        </div> 
                    </div> 
                    <div class="card-body"> 
                        <div> 
                            <h2 class="mb-2 number-font">{{$charterService}}</h2> 
                            <div class="progress progress-md h-1 mb-1"> 
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary" style="width: {{$charterService}};"></div> 
                            </div>  
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-3"> 
                <div class="card"> 
                    <div class="card-header"> 
                        <div class="d-flex"> 
                            <h3 class="card-title mt-1">Lease A Vehicle</h3> 
                        </div> 
                    </div> 
                    <div class="card-body"> 
                        <div> 
                            <h2 class="mb-2 number-font">{{$leaseService}}</h2> 
                            <div class="progress progress-md h-1 mb-1"> 
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: {{$leaseService}};"></div> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="col-sm-6 col-md-12 col-lg-6 col-xl-3"> 
                <div class="card"> 
                    <div class="card-header"> 
                        <div class="d-flex"> 
                            <h3 class="card-title mt-1">Partner Fleet Management</h3> 
                        </div> 
                    </div> 
                    <div class="card-body"> 
                        <div> 
                            <h2 class="mb-2 number-font">{{$partnerFleetManagement}}</h2> 
                            <div class="progress progress-md h-1 mb-1"> 
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: {{$partnerFleetManagement}}"></div> 
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Recent Users</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter border mb-0 text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>Gender</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Date Joined</th>
                                    </tr>
                                </thead>
                                @foreach($recentUsers as $recentUser)
                                <tbody>
                                    <tr>
                                        <td>{{$recentUser->name}}</td>
                                        <td>{{$recentUser->email}}</td>
                                        <td><b>{{$recentUser->sex}}</b></td>
                                        <td>{{$recentUser->phone_number}}</td>
                                        <td>
                                            @if($recentUser->status == 'Active')
                                            <span class="badge badge-success">{{$recentUser->status}}</span>
                                            @else
                                            <span class="badge badge-warning">{{$recentUser->status}}</span>
                                            @endif
                                        </td>
                                        <td>{{$recentUser->created_at->toDayDateTimeString()}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Right-sidebar-->
</div>
@endsection