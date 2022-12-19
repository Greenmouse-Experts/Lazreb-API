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
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
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