@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Manage Services</h1>
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
                            <h3 class="card-title">All Services</h3>
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
                                                    <th class="wd-15p sorting_asc">Name</th>
                                                    <th class="wd-15p sorting">Thumbnail</th>
                                                    <th class="wd-20p sorting">Description</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @foreach($services as $service)
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$loop->iteration}}</td>
                                                    <td>{{$service->name}}</td>
                                                    <td><img class="userpicimg" src="{{$service->thumbnail}}" alt="{{$service->name}}" width="100"></td>
                                                    <td>{{$service->description}}</td>
                                                    <td>{{$service->created_at->toDayDateTimeString()}}</td>
                                                    <td>
                                                        <a href="#btn-update-service-{{$service->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mt-1 mb-1">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>

                                                        <!-- Update MODAL -->
                                                        <div class="modal fade" id="btn-update-service-{{$service->id}}" tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header py-3 px-4 border-bottom-0">
                                                                        <h5 class="modal-title" id="modal-title">Update {{$service->name}}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                                    </div>
                                                                    <div class="modal-body p-4">
                                                                        <form class="needs-validation" method="POST" action="{{ route('admin.update.service', Crypt::encrypt($service->id))}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label>Thumbnail</label>
                                                                                        <input type="file" class="form-control" name="thumbnail" placeholder="Enter Thumbnail">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Description</label>
                                                                                        <textarea type="text" class="form-control" name="description" placeholder="Enter Description" value="{{$service->description}}">{{$service->description}}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div class="col-12 text-end">
                                                                                    <button type="button" class="btn btn-light me-1" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                                                                    <button type="submit" class="form-btn btn btn-primary">Update</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div> <!-- end modal-content-->
                                                            </div> <!-- end modal dialog-->
                                                        </div>
                                                        <!-- end modal-->
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="serviceDelete-{{$service->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                                <form method="post" action="{{ route('admin.delete.service', Crypt::encrypt($service->id))}}">
                                                                    @csrf
                                                                    <div class="modal-content">
                                                                        <div class="modal-header"> 
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Service</h5> 
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
                                                                            
                                                                            <p class="font-size-16 mb-4" style="word-wrap: break-word;">Are you sure you want to permanently erase this service.</p>

                                                                            <div class="hstack gap-2 justify-content-center mb-0">
                                                                                <button type="submit" class="form-btn btn btn-danger">Delete Now</button>
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        </table>
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