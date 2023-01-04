@extends('layouts.admin-frontend')

@section('page-content')
<!-- app-content-->
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Add Promo/Annoucements</h1>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('admin.post.annoucement')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Please complete the fields below</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group"> 
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Name"> 
                                    </div>
                                    <div class="form-group"> 
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" name="description" placeholder="Enter Description"> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right"> 
                            <button type="submit" class="btn btn-primary mt-1 form-btn">Publish</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">All Promo/Annoucements</h3>
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
                                                    <th class="wd-15p sorting_asc">Title</th>
                                                    <th class="wd-20p sorting">Description</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @foreach($annoucements as $annoucement)
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$loop->iteration}}</td>
                                                    <td>{{$annoucement->title}}</td>
                                                    <td>{{$annoucement->description}}</td>
                                                    <td>{{$annoucement->created_at->toDayDateTimeString()}}</td>
                                                    <td>
                                                        <a href="#btn-update-annoucement-{{$annoucement->id}}" data-toggle="modal" class="btn btn-app btn-primary mr-2 mt-1 mb-1">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a href="#btn-delete-annoucement-{{$annoucement->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mt-1 mb-1">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>

                                                        <!-- Update MODAL -->
                                                        <div class="modal fade" id="btn-update-annoucement-{{$annoucement->id}}" tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header py-3 px-4 border-bottom-0">
                                                                        <h5 class="modal-title" id="modal-title">Update {{$annoucement->title}}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                                                    </div>
                                                                    <div class="modal-body p-4">
                                                                        <form class="needs-validation" method="POST" action="{{ route('admin.update.annoucement', Crypt::encrypt($annoucement->id))}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label>Title</label>
                                                                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{$annoucement->title}}">
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Description</label>
                                                                                        <textarea type="text" class="form-control" name="description" placeholder="Enter Description" value="{{$annoucement->description}}">{{$annoucement->description}}</textarea>
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
                                                        <div class="modal fade" id="btn-delete-annoucement-{{$annoucement->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                                                <form method="post" action="{{ route('admin.delete.annoucement', Crypt::encrypt($annoucement->id))}}">
                                                                    @csrf
                                                                    <div class="modal-content">
                                                                        <div class="modal-header"> 
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Annoucement</h5> 
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
    </div>
    <!--End side app-->
</div>
<!-- End app-content-->
@endsection