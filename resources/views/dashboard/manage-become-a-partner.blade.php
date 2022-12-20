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
                                                                @else
                                                                <a href="#BecomePartnerDelete-{{$becomePartner->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </a>
                                                                <!-- Delete Modal -->
                                                                <div class="modal fade" id="BecomePartnerDelete-{{$becomePartner->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-sm">
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
                                                                @else
                                                                <a href="#BecomePartnerDelete-{{$becomePartner->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                    <i class="fa fa-trash"></i> Delete
                                                                </a>
                                                                <!-- Delete Modal -->
                                                                <div class="modal fade" id="BecomePartnerDelete-{{$becomePartner->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-sm">
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
@endsection