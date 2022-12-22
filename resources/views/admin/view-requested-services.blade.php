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
                                                    <th class="wd-15p sorting_asc">Pick Up Address</th>
                                                    <th class="wd-15p sorting">Drop Off Address</th>
                                                    <th class="wd-15p sorting">Start Date</th>
                                                    <th class="wd-20p sorting">Return Date</th>
                                                    <th class="wd-15p sorting">Start Time</th>
                                                    <th class="wd-20p sorting">Return Time</th>
                                                    <th class="wd-15p sorting">Vehicle Type</th>
                                                    <th class="wd-15p sorting">Price</th>
                                                    <th class="wd-20p sorting">Purpose of Use</th>
                                                    <th class="wd-20p sorting">Comment</th>
                                                    <th class="wd-20p sorting">Status</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @if(\App\Models\HireVehicle::where('service_id', $service->id)->get()->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="14">No Request.</td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                @foreach(\App\Models\HireVehicle::where('service_id', $service->id)->get() as $hireVehicle)
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$loop->iteration}}</td>
                                                        <td>{{$hireVehicle->pick_up_address}}</td>
                                                        <td>{{$hireVehicle->drop_off_address}}</td>
                                                        <td>{{$hireVehicle->start_date}}</td>
                                                        <td>{{$hireVehicle->return_date}}</td>
                                                        <td>{{$hireVehicle->start_time}}</td>
                                                        <td>{{$hireVehicle->return_time}}</td>
                                                        <td>{{$hireVehicle->vehicle_type}}</td>
                                                        <td>{{$hireVehicle->price}}</td>
                                                        <td>{{$hireVehicle->purpose_of_use}}</td>
                                                        <td>{{$hireVehicle->comment}}</td>
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
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            @else
                                                            <a href="#HireVehicleEdit-{{$hireVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            <a href="#HireVehicleDelete-{{$hireVehicle->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="HireVehicleEdit-{{$hireVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                                    <form method="post" action="{{ route('user.update.hire.vehicle', Crypt::encrypt($hireVehicle->id))}}" style="width: -webkit-fill-available;">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button> 
                                                                            </div>
                                                                            <div class="modal-body px-4 py-5 text-left">
                                                                                <div class="form-group"> 
                                                                                    <label>Pick Up Address</label>
                                                                                    <textarea type="text" class="form-control" placeholder="Enter Pick Up Address" value="{{$hireVehicle->pick_up_address}}" required>{{$hireVehicle->start_time}}</textarea>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Drop Off Address</label>
                                                                                    <textarea type="text" class="form-control" placeholder="Enter Drop Off Address" value="{{$hireVehicle->pick_up_address}}" required>{{$hireVehicle->start_time}}</textarea>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Start Date</label>
                                                                                    <input type="date" class="form-control" name="start_date" value="{{$hireVehicle->start_date}}" required>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Return Date</label>
                                                                                    <input type="date" class="form-control" name="return_date" value="{{$hireVehicle->return_date}}" required>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Start Time</label>
                                                                                    <input type="time" class="form-control" name="start_time" value="{{$hireVehicle->start_time}}" required>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Return Time</label>
                                                                                    <input type="time" class="form-control" name="return_time" value="{{$hireVehicle->return_time}}" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="vehicle_type">Vehicle Type</label>
                                                                                    <select name="vehicle_type" class="form-control" id="vehicle_type" required>
                                                                                        <option value="{{$hireVehicle->vehicle_type}}">{{$hireVehicle->vehicle_type}}</option>
                                                                                        <option value="">-- Choose a Vehicle --</option>
                                                                                        <option value="Coaster">Coaster</option>
                                                                                        <option value="New Coaster">New Coaster</option>
                                                                                        <option value="Toyota Hiace">Toyota Hiace</option>
                                                                                        <option value="Sienna/Routan">Sienna/Routan</option>
                                                                                        <option value="Toyota Hilux">Toyota Hilux</option>
                                                                                        <option value="Toyota Venza">Toyota Venza</option>
                                                                                        <option value="Honda Accord">Honda Accord</option>
                                                                                        <option value="Camry Musle">Camry Musle</option>
                                                                                        <option value="Toyota Corrola">Toyota Corrola</option>
                                                                                        <option value="SUV Prado">SUV Prado</option>
                                                                                        <option value="Toyota Landcruiser">Toyota Landcruiser</option>
                                                                                        <option value="Lexus Landcruiser LX">Lexus Landcruiser LX</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Price</label>
                                                                                    <input type="text" class="form-control" name="price" id="price" value="{{$hireVehicle->price}}" readonly required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="purpose_of_use">Purpose of Use</label>
                                                                                    <select name="purpose_of_use" class="form-control" required>
                                                                                        <option value="{{$hireVehicle->purpose_of_use}}">{{$hireVehicle->purpose_of_use}}</option>
                                                                                        <option value="">-- Choose Purpose of use --</option>
                                                                                        <option value="Executive Transport Service">Executive Transport Service</option>
                                                                                        <option value="Travel & Tours">Travel & Tours</option>
                                                                                        <option value="Staff Bus Services">Staff Bus Services</option>
                                                                                        <option value="Business Meetings">Business Meetings</option>
                                                                                        <option value="Party Buses">Party Buses</option>
                                                                                        <option value="Campaign">Campaign</option>
                                                                                        <option value="Concerts">Concerts</option>
                                                                                        <option value="Rental/Hire">Rental/Hire</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-primary">Update</button>
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
                                                                    <form method="post" action="{{ route('user.delete.hire.vehicle', Crypt::encrypt($hireVehicle->id))}}">
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
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            @endif
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
                                                    <th class="wd-20p sorting">Status</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @if(\App\Models\CharterVehicle::where('service_id', $service->id)->get()->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="14">No Request.</td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                @foreach(\App\Models\CharterVehicle::where('service_id', $service->id)->get() as $charterVehicle)
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
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            @else
                                                            <a href="#CharterVehicleEdit-{{$charterVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            <a href="#CharterVehicleDelete-{{$charterVehicle->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="CharterVehicleEdit-{{$charterVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <form method="post" action="{{ route('admin.update.charter.vehicle', Crypt::encrypt($charterVehicle->id))}}" style="width: -webkit-fill-available;">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5> 
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
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            @endif
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
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
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
                                                    <th class="wd-15p sorting_asc">Company/Individual Name</th>
                                                    <th class="wd-15p sorting">Vehicle Type</th>
                                                    <th class="wd-15p sorting">Lease Duration</th>
                                                    <th class="wd-20p sorting">Purpose of Use</th>
                                                    <th class="wd-15p sorting">Location of Use</th>
                                                    <th class="wd-20p sorting">Comment</th>
                                                    <th class="wd-20p sorting">Status</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @if(\App\Models\LeaseVehicle::where('service_id', $service->id)->get()->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="14">No Request.</td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                @foreach(\App\Models\LeaseVehicle::where('service_id', $service->id)->get() as $leaseVehicle)
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$loop->iteration}}</td>
                                                        <td>{{$leaseVehicle->name}}</td>
                                                        <td>{{$leaseVehicle->vehicle_type}}</td>
                                                        <td>{{$leaseVehicle->lease_duration}}</td>
                                                        <td>{{$leaseVehicle->purpose_of_use}}</td>
                                                        <td>{{$leaseVehicle->location_of_use}}</td>
                                                        <td>{{$leaseVehicle->comment}}</td>
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
                                                            @elseif($leaseVehicle->status == 'Declined')
                                                            <a data-toggle="modal" class="btn btn-app mr-2 mb-1" style="background: red;">
                                                                <i class="fa fa-times-cycle-o"></i> {{$leaseVehicle->status}}
                                                            </a>
                                                            @else
                                                            <a href="#LeaseVehicleEdit-{{$leaseVehicle->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            <a href="#LeaseVehicleDelete-{{$leaseVehicle->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>
                                                            <!-- Edit Modal -->
                                                            <div class="modal fade" id="LeaseVehicleEdit-{{$leaseVehicle->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form method="post" action="{{ route('user.update.lease.vehicle', Crypt::encrypt($leaseVehicle->id))}}" style="width: -webkit-fill-available;">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5> 
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
                                                                                    <select name="vehicle_type" class="form-control" required>
                                                                                        <option value="{{$leaseVehicle->vehicle_type}}">{{$leaseVehicle->vehicle_type}}</option>
                                                                                        <option value="">-- Choose a Vehicle --</option>
                                                                                        <option value="Coaster">Coaster</option>
                                                                                        <option value="New Coaster">New Coaster</option>
                                                                                        <option value="Toyota Hiace">Toyota Hiace</option>
                                                                                        <option value="Sienna/Routan">Sienna/Routan</option>
                                                                                        <option value="Toyota Hilux">Toyota Hilux</option>
                                                                                        <option value="Toyota Venza">Toyota Venza</option>
                                                                                        <option value="Honda Accord">Honda Accord</option>
                                                                                        <option value="Camry Musle">Camry Musle</option>
                                                                                        <option value="Toyota Corrola">Toyota Corrola</option>
                                                                                        <option value="SUV Prado">SUV Prado</option>
                                                                                        <option value="Toyota Landcruiser">Toyota Landcruiser</option>
                                                                                        <option value="Lexus Landcruiser LX">Lexus Landcruiser LX</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Lease Duration</label>
                                                                                    <input type="date" class="form-control" name="lease_duration" value="{{$leaseVehicle->lease_duration}}" required>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="purpose_of_use">Purpose of Use</label>
                                                                                    <select name="purpose_of_use" class="form-control" required>
                                                                                        <option value="{{$leaseVehicle->purpose_of_use}}">{{$leaseVehicle->purpose_of_use}}</option>
                                                                                        <option value="">-- Choose Purpose of use --</option>
                                                                                        <option value="Executive Transport Service">Executive Transport Service</option>
                                                                                        <option value="Travel & Tours">Travel & Tours</option>
                                                                                        <option value="Staff Bus Services">Staff Bus Services</option>
                                                                                        <option value="Business Meetings">Business Meetings</option>
                                                                                        <option value="Party Buses">Party Buses</option>
                                                                                        <option value="Campaign">Campaign</option>
                                                                                        <option value="Concerts">Concerts</option>
                                                                                        <option value="Rental/Hire">Rental/Hire</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label>Location of Use</label>
                                                                                    <textarea type="text" class="form-control" name="location_of_use" placeholder="Enter location of use" value="{{$leaseVehicle->location_of_use}}" required>{{$leaseVehicle->location_of_use}}</textarea>
                                                                                </div>
                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-primary">Update</button>
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
                                                                    <form method="post" action="{{ route('user.delete.lease.vehicle', Crypt::encrypt($leaseVehicle->id))}}">
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
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            @endif
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