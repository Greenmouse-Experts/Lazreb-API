@extends('layouts.admin-frontend')

@section('page-content')
<!-- app-content-->
@if($service->name == 'Hire A Vehicle')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}} Requests</h1>
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
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">All Requests</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example" class="table table-striped table-bordered text-nowrap w-100 dataTable no-footer" role="grid" aria-describedby="example_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="wd-15p sorting_asc">S/N</th>
                                                    <th class="wd-15p sorting_asc">User</th>
                                                    <th class="wd-15p sorting_asc">Pick Up Address</th>
                                                    <th class="wd-15p sorting">Drop Off Address</th>
                                                    <th class="wd-15p sorting">Start Date/Time</th>
                                                    <th class="wd-20p sorting">Return Date/Time</th>
                                                    <th class="wd-15p sorting">Vehicle Type</th>
                                                    <th class="wd-15p sorting">Price</th>
                                                    <th class="wd-20p sorting">Purpose of Use</th>
                                                    <th class="wd-20p sorting">Comment</th>
                                                    <th class="wd-20p sorting">Paid Status</th>
                                                    <th class="wd-20p sorting">Status</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @if(\App\Models\HireVehicle::where('service_id', $service->id)->get()->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="15">No Request.</td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                @foreach(\App\Models\HireVehicle::latest()->where('service_id', $service->id)->get() as $hireVehicle)
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$loop->iteration}}</td>
                                                        <td>
                                                            {{\App\Models\User::where('id', $hireVehicle->user_id)->first()->name}}<br>
                                                            <code>{{\App\Models\User::where('id', $hireVehicle->user_id)->first()->email}}</code>
                                                        </td>
                                                        <td>{{$hireVehicle->pick_up_address}}</td>
                                                        <td>{{$hireVehicle->drop_off_address}}</td>
                                                        <td>{{$hireVehicle->start_date}} - {{$hireVehicle->start_time}}</td>
                                                        <td>{{$hireVehicle->return_date}} - {{$hireVehicle->return_time}}</td>
                                                        <td>{{$hireVehicle->vehicle_type}}</td>
                                                        <td>{{$hireVehicle->price}}</td>
                                                        <td>{{$hireVehicle->purpose_of_use}}</td>
                                                        <td>{{$hireVehicle->comment}}</td>
                                                        <td>
                                                            <span class="badge badge-success  mr-1 mb-1 mt-1">{{$hireVehicle->paid_status}}</span>
                                                        </td>
                                                        <td>
                                                            @if($hireVehicle->status == 'Pending')
                                                            <span class="badge badge-info  mr-1 mb-1 mt-1">{{$hireVehicle->status}}</span>
                                                            @elseif($hireVehicle->status == 'Declined')
                                                            <span class="badge badge-danger  mr-1 mb-1 mt-1">{{$hireVehicle->status}}</span>
                                                            @else
                                                            <span class="badge badge-success  mr-1 mb-1 mt-1">{{$hireVehicle->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$hireVehicle->created_at->toDayDateTimeString()}}</td>
                                                        <td>
                                                            @if($hireVehicle->status == 'Approved')
                                                            <a data-toggle="modal" class="btn btn-app btn-success mr-2 mb-1">
                                                                <i class="fa fa-check-square-o"></i> {{$hireVehicle->status}}
                                                            </a>
                                                            <a href="#HireVehicleEdit-{{$hireVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            @elseif($hireVehicle->status == 'Paid')
                                                            <a href="#HireVehicleEdit-{{$hireVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            @else
                                                            <a href="#HireVehicleEdit-{{$hireVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            <a href="#HireVehicleDelete-{{$hireVehicle->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                            @endif
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="HireVehicleEdit-{{$hireVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form method="post" action="{{ route('admin.process.hire.vehicle', Crypt::encrypt($hireVehicle->id))}}" style="width: -webkit-fill-available;">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Process Request</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button> 
                                                                            </div>
                                                                            <div class="modal-body px-4 py-5 text-left">
                                                                                <div class="form-group"> 
                                                                                    <label>Pick Up Address</label>
                                                                                    <textarea type="text" class="form-control" value="{{$hireVehicle->pick_up_address}}" disabled>{{$hireVehicle->pick_up_address}}</textarea>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Drop Off Address</label>
                                                                                    <textarea type="text" class="form-control" value="{{$hireVehicle->drop_off_address}}" disabled>{{$hireVehicle->drop_off_address}}</textarea>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Start Date</label>
                                                                                    <input type="date" class="form-control" value="{{$hireVehicle->start_date}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Return Date</label>
                                                                                    <input type="date" class="form-control" value="{{$hireVehicle->return_date}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Start Time</label>
                                                                                    <input type="time" class="form-control" value="{{$hireVehicle->start_time}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Return Time</label>
                                                                                    <input type="time" class="form-control" value="{{$hireVehicle->return_time}}" disabled>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="vehicle_type">Vehicle Type</label>
                                                                                    <input type="text" class="form-control" value="{{$hireVehicle->vehicle_type}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Price</label>
                                                                                    <input type="text" class="form-control" name="price" id="price" value="{{$hireVehicle->price}}" readonly required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="purpose_of_use">Purpose of Use</label>
                                                                                    <input type="text" class="form-control" value="{{$hireVehicle->purpose_of_use}}" disabled>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="comment">Comment</label>
                                                                                    <textarea type="text" class="form-control" name="comment" value="{{$hireVehicle->comment}}">{{$hireVehicle->comment}}</textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="status">Status</label>
                                                                                    <select name="status" class="form-control" required>
                                                                                        <option value="{{$hireVehicle->status}}">{{$hireVehicle->status}}</option>
                                                                                        <option value="">-- Select --</option>
                                                                                        <option value="Pending">Pending</option>
                                                                                        <option value="Declined">Declined</option>
                                                                                        <option value="Approved">Approved</option>
                                                                                        <option value="Paid">Paid</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-primary">Submit</button>
                                                                                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="HireVehicleDelete-{{$hireVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                                    <form method="post" action="{{ route('admin.delete.hire.vehicle', Crypt::encrypt($hireVehicle->id))}}">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Request</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button> 
                                                                            </div>
                                                                            <div class="modal-body px-4 py-5 text-center">
                                                                                <div class="avatar-sm mb-4 mx-auto">
                                                                                    <div class="font-size-20 rounded-3">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <p class="font-size-16 mb-4" style="word-wrap: break-word;">Are you sure you want to permanently erase this request.</p>

                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-danger">Delete Now</button>
                                                                                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End side app-->
</div>
@elseif($service->name == 'Charter A Vehicle')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}} Requests</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

        <!-- Row -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">All Requests</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example" class="table table-striped table-bordered text-nowrap w-100 dataTable no-footer" role="grid" aria-describedby="example_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="wd-15p sorting_asc">S/N</th>
                                                    <th class="wd-15p sorting_asc">User</th>
                                                    <th class="wd-15p sorting_asc">Pick Up Address</th>
                                                    <th class="wd-15p sorting">Drop Off Address</th>
                                                    <th class="wd-15p sorting">Start Date/Time</th>
                                                    <th class="wd-20p sorting">Return Date/Time</th>
                                                    <th class="wd-15p sorting">Vehicle Type</th>
                                                    <th class="wd-15p sorting">Charter Type</th>
                                                    <th class="wd-20p sorting">Purpose of Use</th>
                                                    <th class="wd-20p sorting">Comment</th>
                                                    <th class="wd-20p sorting">Paid Status</th>
                                                    <th class="wd-20p sorting">Status</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @if(\App\Models\CharterVehicle::where('service_id', $service->id)->get()->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="15">No Request.</td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                @foreach(\App\Models\CharterVehicle::latest()->where('service_id', $service->id)->get() as $charterVehicle)
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$loop->iteration}}</td>
                                                        <td>
                                                            {{\App\Models\User::where('id', $charterVehicle->user_id)->first()->name}}<br>
                                                            <code>{{\App\Models\User::where('id', $charterVehicle->user_id)->first()->email}}</code>
                                                        </td>
                                                        <td>{{$charterVehicle->pick_up_address}}</td>
                                                        <td>{{$charterVehicle->drop_off_address}}</td>
                                                        <td>{{$charterVehicle->start_date}} - {{$charterVehicle->start_time}}</td>
                                                        <td>{{$charterVehicle->return_date}} - {{$charterVehicle->return_time}}</td>
                                                        <td>{{$charterVehicle->vehicle_type}}</td>
                                                        <td>{{$charterVehicle->charter_type}}</td>
                                                        <td>{{$charterVehicle->purpose_of_use}}</td>
                                                        <td>{{$charterVehicle->comment}}</td>
                                                        <td>
                                                            <span class="badge badge-success  mr-1 mb-1 mt-1">{{$charterVehicle->paid_status}}</span>
                                                        </td>
                                                        <td>
                                                            @if($charterVehicle->status == 'Pending')
                                                            <span class="badge badge-info  mr-1 mb-1 mt-1">{{$charterVehicle->status}}</span>
                                                            @elseif($charterVehicle->status == 'Declined')
                                                            <span class="badge badge-danger  mr-1 mb-1 mt-1">{{$charterVehicle->status}}</span>
                                                            @else
                                                            <span class="badge badge-success  mr-1 mb-1 mt-1">{{$charterVehicle->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$charterVehicle->created_at->toDayDateTimeString()}}</td>
                                                        <td>
                                                            @if($charterVehicle->status == 'Approved')
                                                            <a href="#CharterVehicleEdit-{{$charterVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            @elseif($charterVehicle->status == 'Paid')
                                                            <a href="#CharterVehicleEdit-{{$charterVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            @else
                                                            <a href="#CharterVehicleEdit-{{$charterVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            <a href="#CharterVehicleDelete-{{$charterVehicle->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                            @endif
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="CharterVehicleEdit-{{$charterVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <form method="post" action="{{ route('admin.process.charter.vehicle', Crypt::encrypt($charterVehicle->id))}}" style="width: -webkit-fill-available;">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Process Request</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button> 
                                                                            </div>
                                                                            <div class="modal-body px-4 py-5 text-left">
                                                                                <div class="form-group"> 
                                                                                    <label>Pick Up Address</label>
                                                                                    <textarea type="text" class="form-control" placeholder="Enter Pick Up Address" value="{{$charterVehicle->pick_up_address}}" disabled>{{$charterVehicle->pick_up_address}}</textarea>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Drop Off Address</label>
                                                                                    <textarea type="text" class="form-control" placeholder="Enter Drop Off Address" value="{{$charterVehicle->pick_up_address}}" disabled>{{$charterVehicle->pick_up_address}}</textarea>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Start Date</label>
                                                                                    <input type="date" class="form-control" value="{{$charterVehicle->start_date}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Return Date</label>
                                                                                    <input type="date" class="form-control" value="{{$charterVehicle->return_date}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Start Time</label>
                                                                                    <input type="time" class="form-control" value="{{$charterVehicle->start_time}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Return Time</label>
                                                                                    <input type="time" class="form-control" value="{{$charterVehicle->return_time}}" disabled>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="vehicle_type">Vehicle Type</label>
                                                                                    <input type="text" class="form-control" value="{{$charterVehicle->vehicle_type}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Charter Type</label>
                                                                                    <input type="text" class="form-control" value="{{$charterVehicle->charter_type}}" disabled>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="purpose_of_use">Purpose of Use</label>
                                                                                    <textarea type="text" class="form-control" value="{{$charterVehicle->purpose_of_use}}" disabled>{{$charterVehicle->purpose_of_use}}</textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="comment">Comment</label>
                                                                                    <textarea type="text" class="form-control" name="comment" value="{{$charterVehicle->comment}}">{{$charterVehicle->comment}}</textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="status">Status</label>
                                                                                    <select name="status" class="form-control" required>
                                                                                        <option value="{{$charterVehicle->status}}">{{$charterVehicle->status}}</option>
                                                                                        <option value="">-- Select --</option>
                                                                                        <option value="Pending">Pending</option>
                                                                                        <option value="Declined">Declined</option>
                                                                                        <option value="Approved">Approved</option>
                                                                                        <option value="Paid">Paid</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-primary">Submit</button>
                                                                                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="CharterVehicleDelete-{{$charterVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form method="post" action="{{ route('admin.delete.charter.vehicle', Crypt::encrypt($charterVehicle->id))}}">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Request</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button> 
                                                                            </div>
                                                                            <div class="modal-body px-4 py-5 text-center">
                                                                                <div class="avatar-sm mb-4 mx-auto">
                                                                                    <div class="font-size-20 rounded-3">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <p class="font-size-16 mb-4" style="word-wrap: break-word;">Are you sure you want to permanently erase this request.</p>

                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-danger">Delete Now</button>
                                                                                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--End side app-->
</div>
@elseif($service->name == 'Lease A Vehicle')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}} Requests</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="#" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="#" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="#" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="#" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

        <!-- Row -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">All Requests</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example" class="table table-striped table-bordered text-nowrap w-100 dataTable no-footer" role="grid" aria-describedby="example_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="wd-15p sorting_asc">S/N</th>
                                                    <th class="wd-15p sorting_asc">User</th>
                                                    <th class="wd-15p sorting_asc">Company/Individual Name</th>
                                                    <th class="wd-15p sorting">Vehicle Type</th>
                                                    <th class="wd-15p sorting">Lease Duration</th>
                                                    <th class="wd-20p sorting">Purpose of Use</th>
                                                    <th class="wd-15p sorting">Location of Use</th>
                                                    <th class="wd-20p sorting">Comment</th>
                                                    <th class="wd-20p sorting">Paid Status</th>
                                                    <th class="wd-20p sorting">Status</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @if(\App\Models\LeaseVehicle::where('service_id', $service->id)->get()->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="11">No Request.</td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                @foreach(\App\Models\LeaseVehicle::latest()->where('service_id', $service->id)->get() as $leaseVehicle)
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$loop->iteration}}</td>
                                                        <td>
                                                            {{\App\Models\User::where('id', $leaseVehicle->user_id)->first()->name}}<br>
                                                            <code>{{\App\Models\User::where('id', $leaseVehicle->user_id)->first()->email}}</code>
                                                        </td>
                                                        <td>{{$leaseVehicle->name}}</td>
                                                        <td>{{$leaseVehicle->vehicle_type}}</td>
                                                        <td>{{$leaseVehicle->lease_duration}}</td>
                                                        <td>{{$leaseVehicle->purpose_of_use}}</td>
                                                        <td>{{$leaseVehicle->location_of_use}}</td>
                                                        <td>{{$leaseVehicle->comment}}</td>
                                                        <td>
                                                            <span class="badge badge-success  mr-1 mb-1 mt-1">{{$leaseVehicle->paid_status}}</span>
                                                        </td>
                                                        <td>
                                                            @if($leaseVehicle->status == 'Pending')
                                                            <span class="badge badge-info  mr-1 mb-1 mt-1">{{$leaseVehicle->status}}</span>
                                                            @elseif($leaseVehicle->status == 'Declined')
                                                            <span class="badge badge-danger  mr-1 mb-1 mt-1">{{$leaseVehicle->status}}</span>
                                                            @else
                                                            <span class="badge badge-success  mr-1 mb-1 mt-1">{{$leaseVehicle->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$leaseVehicle->created_at->toDayDateTimeString()}}</td>
                                                        <td>
                                                            @if($leaseVehicle->status == 'Approved')
                                                            <a data-toggle="modal" class="btn btn-app btn-success mr-2 mb-1">
                                                                <i class="fa fa-check-square-o"></i> {{$leaseVehicle->status}}
                                                            </a>
                                                            <a href="#LeaseVehicleEdit-{{$leaseVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            @elseif($leaseVehicle->status == 'Paid')
                                                            <a href="#LeaseVehicleEdit-{{$leaseVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            @else
                                                            <a href="#LeaseVehicleEdit-{{$leaseVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Process
                                                            </a>
                                                            <a href="#LeaseVehicleDelete-{{$leaseVehicle->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                            @endif
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="LeaseVehicleEdit-{{$leaseVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form method="post" action="{{ route('admin.process.lease.vehicle', Crypt::encrypt($leaseVehicle->id))}}" style="width: -webkit-fill-available;">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Process Request</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button> 
                                                                            </div>
                                                                            <div class="modal-body px-4 py-5 text-left">
                                                                                <div class="form-group"> 
                                                                                    <label>Company/Individual Name</label>
                                                                                    <input type="text" class="form-control" name="name" placeholder="Enter Company/Individual Name" value="{{$leaseVehicle->name}}" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="vehicle_type">Vehicle Type</label>
                                                                                    <input type="text" class="form-control" value="{{$leaseVehicle->vehicle_type}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Lease Duration</label>
                                                                                    <input type="text" class="form-control" value="{{$leaseVehicle->lease_duration}}" disabled>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="purpose_of_use">Purpose of Use</label>
                                                                                    <input type="text" class="form-control" value="{{$leaseVehicle->purpose_of_use}}" disabled>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Location of Use</label>
                                                                                    <textarea type="text" class="form-control" value="{{$leaseVehicle->location_of_use}}" disabled>{{$leaseVehicle->location_of_use}}</textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="comment">Comment</label>
                                                                                    <textarea type="text" class="form-control" name="comment" value="{{$leaseVehicle->comment}}">{{$leaseVehicle->comment}}</textarea>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="status">Status</label>
                                                                                    <select name="status" class="form-control" required>
                                                                                        <option value="{{$leaseVehicle->status}}">{{$leaseVehicle->status}}</option>
                                                                                        <option value="">-- Select --</option>
                                                                                        <option value="Pending">Pending</option>
                                                                                        <option value="Declined">Declined</option>
                                                                                        <option value="Approved">Approved</option>
                                                                                        <option value="Paid">Paid</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-primary">Submit</button>
                                                                                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="LeaseVehicleDelete-{{$leaseVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form method="post" action="{{ route('admin.delete.lease.vehicle', Crypt::encrypt($leaseVehicle->id))}}">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Request</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button> 
                                                                            </div>
                                                                            <div class="modal-body px-4 py-5 text-center">
                                                                                <div class="avatar-sm mb-4 mx-auto">
                                                                                    <div class="font-size-20 rounded-3">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <p class="font-size-16 mb-4" style="word-wrap: break-word;">Are you sure you want to permanently erase this request.</p>

                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-danger">Delete Now</button>
                                                                                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End side app-->
</div>
@endif
<!-- End app-content-->

<script>
    const vehicleType = document.getElementById("vehicle_type");
    const price = document.querySelector('#price');

    vehicleType.addEventListener('change', () => {
        if (vehicleType.value === "Coaster") {
            price.value = '₦60,000 - ₦70,000 Per Day';
        } else if (vehicleType.value === "New Coaster") {
            price.value = '₦150,000 - ₦160,000 Per Day';
        } else if (vehicleType.value === "Toyota Hiace") {
            price.value = '₦50,000 - ₦60,000 Per Day';
        } else if (vehicleType.value === "Sienna/Routan"){
            price.value = '₦40,000 - ₦50,000 Per Day';
        } else if (vehicleType.value === "Toyota Hilux") {
            price.value = '₦40,000 - ₦50,000 Per Day';
        } else if (vehicleType.value === "Toyota Venza") {
            price.value = '₦40,000 - ₦50,000 Per Day';
        } else if (vehicleType.value === "Honda Accord") {
            price.value = '₦30,000 - ₦40,000 Per Day';
        } else if (vehicleType.value === "Camry Musle"){
            price.value = '₦25,000 - ₦35,000 Per Day';
        } else if (vehicleType.value === "Toyota Corrola") {
            price.value = '₦25,000 - ₦35,000 Per Day';
        } else if (vehicleType.value === "SUV Prado") {
            price.value = '₦80,000 - ₦90,000 Per Day';
        } else if (vehicleType.value === "Toyota Landcruiser") {
            price.value = '₦100,000 - ₦120,000 Per Day';
        } else if (vehicleType.value === "Lexus Landcruiser LX") {
            price.value = '₦100,000 - ₦120,000 Per Day';
        }
    });

    const other = document.getElementById("vehicle_type");
    const others = document.getElementById("vehicle_types");
    const otherText = document.querySelector('#otherValue');
    const otherVehicleValue = document.querySelector('#otherVehicleValue');
    otherText.style.visibility = 'hidden';
    otherVehicleValue.style.visibility = 'hidden';

    other.addEventListener('change', () => {
        if (other.value === "") {
            otherText.style.visibility = 'visible';
            otherText.value = '';
        } else {
            otherText.style.visibility = 'hidden';
            otherText.value = '';
        }
    });

    others.addEventListener('change', () => {
        if (others.value === "") {
            otherVehicleValue.style.visibility = 'visible';
            otherVehicleValue.value = '';
        } else {
            otherVehicleValue.style.visibility = 'hidden';
            otherVehicleValue.value = '';
        }
    });
</script>
@endsection