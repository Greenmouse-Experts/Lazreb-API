@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Manage my request to become a partner</h1>
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
                            <h3 class="card-title">All Request Sent</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                         @if($becomePartners->isEmpty())
                                        <p>No Request</p>
                                        @else
                                            @foreach($becomePartners as $becomePartner)
                                                @if($becomePartner->partnership_type == 'Corporate')
                                                <table id="example" class="table table-striped table-bordered text-nowrap w-100 dataTable no-footer" role="grid" aria-describedby="example_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="wd-15p sorting_asc">S/N</th>
                                                            <th class="wd-15p sorting_asc">Partnership Type</th>
                                                            <th class="wd-15p sorting">Vehicle Type</th>
                                                            <th class="wd-20p sorting">No of Vehicles</th>
                                                            <th class="wd-15p sorting">Company Name</th>
                                                            <th class="wd-20p sorting">Company Address</th>
                                                            <th class="wd-15p sorting">CAC Number</th>
                                                            <th class="wd-20p sorting">Comment</th>
                                                            <th class="wd-20p sorting">Status</th>
                                                            <th class="wd-15p sorting">Created At</th>
                                                            <th class="wd-15p sorting">Action</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1">{{$loop->iteration}}</td>
                                                            <td>{{$becomePartner->partnership_type}}</td>
                                                            <td>{{$becomePartner->vehicle_type}}</td>
                                                            <td>{{$becomePartner->no_of_vehicles}}</td>
                                                            <td>{{$becomePartner->company_name}}</td>
                                                            <td>{{$becomePartner->company_address}}</td>
                                                            <td>{{$becomePartner->cac_number}}</td>
                                                            <td>{{$becomePartner->comment}}</td>
                                                            <td>
                                                                @if($becomePartner->status == 'Pending')
                                                                <span class="badge badge-info  mr-1 mb-1 mt-1">{{$becomePartner->status}}</span>
                                                                @elseif($becomePartner->status == 'Declined')
                                                                <span class="badge badge-danger  mr-1 mb-1 mt-1">{{$becomePartner->status}}</span>
                                                                @else
                                                                <span class="badge badge-success  mr-1 mb-1 mt-1">{{$becomePartner->status}}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{$becomePartner->created_at->toDayDateTimeString()}}</td>
                                                            <td>
                                                                @if($becomePartner->status == 'Approved')
                                                                <a data-toggle="modal" class="btn btn-app btn-success mr-2 mb-1">
                                                                    <i class="fa fa-check-square-o"></i> {{$becomePartner->status}}
                                                                </a>
                                                                @elseif($becomePartner->status == 'Declined')
                                                                <a data-toggle="modal" class="btn btn-app mr-2 mb-1" style="background: red;">
                                                                    <i class="fa fa-time-circle-o"></i> {{$becomePartner->status}}
                                                                </a>
                                                                @else
                                                                <a href="#BecomePartnerEdit-{{$becomePartner->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                    <i class="fa fa-edit"></i> Edit
                                                                </a>
                                                                <a href="#BecomePartnerDelete-{{$becomePartner->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </a>
                                                                <!-- Edit Modal -->
                                                                <div class="modal fade" id="BecomePartnerDelete-{{$becomePartner->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <form method="post" action="{{ route('user.update.partner.fleet.management', Crypt::encrypt($becomePartner->id))}}" style="width: -webkit-fill-available;">
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
                                                                                        <label for="vehicle_type">Vehicle Type</label>
                                                                                        <select name="vehicle_type" class="form-control" id="vehicle_types" required>
                                                                                            <option value="{{$becomePartner->vehicle_type}}">{{$becomePartner->vehicle_type}}</option>
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
                                                                                            <option value="">Other</option>
                                                                                        </select>
                                                                                        <input type="text" id="otherVehicleValue" name="vehicle_types" placeholder="Enter Vehicle Type" class="form-control mt-2" style="visibility: hidden">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>No of Vehicles</label>
                                                                                        <input type="number" class="form-control" name="no_of_vehicles" value="{{$becomePartner->no_of_vehicles}}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Company Name</label>
                                                                                        <input type="text" class="form-control" name="company_name" value="{{$becomePartner->company_name}}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Company Address</label>
                                                                                        <input type="text" class="form-control" name="company_address" value="{{$becomePartner->company_address}}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>CAC Number</label>
                                                                                        <input type="text" class="form-control" name="cac_number" value="{{$becomePartner->cac_number}}" required>
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
                                                                <div class="modal fade" id="BecomePartnerDelete-{{$becomePartner->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <form method="post" action="{{ route('user.delete.become.partner', Crypt::encrypt($becomePartner->id))}}">
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
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @else
                                                <table id="example" class="table table-striped table-bordered text-nowrap w-100 dataTable no-footer" role="grid" aria-describedby="example_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="wd-15p sorting_asc">S/N</th>
                                                            <th class="wd-15p sorting_asc">Partnership Type</th>
                                                            <th class="wd-15p sorting">Vehicle Type</th>
                                                            <th class="wd-20p sorting">No of Vehicles</th>
                                                            <th class="wd-15p sorting_asc">NIN</th>
                                                            <th class="wd-20p sorting">Comment</th>
                                                            <th class="wd-20p sorting">Status</th>
                                                            <th class="wd-15p sorting">Created At</th>
                                                            <th class="wd-15p sorting">Action</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                        <tr role="row" class="odd">
                                                            <td class="sorting_1">{{$loop->iteration}}</td>
                                                            <td>{{$becomePartner->partnership_type}}</td>
                                                            <td>{{$becomePartner->vehicle_type}}</td>
                                                            <td>{{$becomePartner->no_of_vehicles}}</td>
                                                            <td>{{$becomePartner->nin}}</td>
                                                            <td>{{$becomePartner->comment}}</td>
                                                            <td>
                                                                @if($becomePartner->status == 'Pending')
                                                                <span class="badge badge-info  mr-1 mb-1 mt-1">{{$becomePartner->status}}</span>
                                                                @elseif($becomePartner->status == 'Declined')
                                                                <span class="badge badge-danger  mr-1 mb-1 mt-1">{{$becomePartner->status}}</span>
                                                                @else
                                                                <span class="badge badge-success  mr-1 mb-1 mt-1">{{$becomePartner->status}}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{$becomePartner->created_at->toDayDateTimeString()}}</td>
                                                            <td>
                                                                @if($becomePartner->status == 'Approved')
                                                                <a data-toggle="modal" class="btn btn-app btn-success mr-2 mb-1">
                                                                    <i class="fa fa-check-square-o"></i> {{$becomePartner->status}}
                                                                </a>
                                                                @elseif($becomePartner->status == 'Declined')
                                                                <a data-toggle="modal" class="btn btn-app mr-2 mb-1" style="background: red;">
                                                                    <i class="fa fa-time-circle-o"></i> {{$becomePartner->status}}
                                                                </a>
                                                                @else
                                                                <a href="#BecomePartnerEdit-{{$becomePartner->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mb-1">
                                                                    <i class="fa fa-edit"></i> Edit
                                                                </a>
                                                                <a href="#BecomePartnerDelete-{{$becomePartner->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </a>
                                                                <div class="modal fade" id="BecomePartnerEdit-{{$becomePartner->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <form method="post" action="{{ route('user.update.partner.fleet.management', Crypt::encrypt($becomePartner->id))}}" style="width: -webkit-fill-available;">
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
                                                                                        <label for="vehicle_type">Vehicle Type</label>
                                                                                        <select name="vehicle_type" class="form-control" id="vehicle_type" required>
                                                                                            <option value="{{$becomePartner->vehicle_type}}">{{$becomePartner->vehicle_type}}</option>
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
                                                                                            <option value="">Other</option>
                                                                                        </select>
                                                                                        <input type="text" id="otherValue" name="vehicle_types" placeholder="Enter Vehicle Type" class="form-control mt-2">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>No of Vehicles</label>
                                                                                        <input type="number" class="form-control" name="no_of_vehicles" value="{{$becomePartner->no_of_vehicles}}" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>NIN</label>
                                                                                        <input type="text" class="form-control" name="nin" value="{{$becomePartner->nin}}" required>
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
                                                                <div class="modal fade" id="BecomePartnerDelete-{{$becomePartner->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <form method="post" action="{{ route('user.delete.become.partner', Crypt::encrypt($becomePartner->id))}}">
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
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Right-sidebar-->
</div>

<script>
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