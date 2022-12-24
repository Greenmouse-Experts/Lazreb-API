@extends('layouts.admin-frontend')

@section('page-content')
<!-- app-content-->
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Add Service</h1>
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
                    <form method="POST" action="{{ route('admin.add.service')}}" enctype="multipart/form-data">
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
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name"> 
                                    </div>
                                    <div class="form-group"> 
                                        <label>Thumbnail</label>
                                        <input type="file" class="form-control" name="thumbnail" placeholder="Enter Thumbnail"> 
                                    </div>
                                    <div class="form-group"> 
                                        <label>Description</label>
                                        <textarea type="text" class="form-control" name="description" placeholder="Enter Description"> </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right"> 
                            <button type="submit" class="btn btn-primary mt-1 form-btn">Save</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End side app-->
</div>
<!-- End app-content-->
@endsection