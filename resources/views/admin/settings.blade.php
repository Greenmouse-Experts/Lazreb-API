@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Profile</h1>
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
            <div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">My Profile</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="userprofile ">
                                @if(Auth::user()->photo)
                                <div class="userpic brround" style="display: flex; align-items: center;"> 
                                    <img class="userpicimg" src="{{Auth::user()->photo}}" alt="{{Auth::user()->name}}">
                                </div>
                                @else
                                <div class="userpic brround" style="display: flex; align-items: center;"> 
                                    <span class="userpicimg" style="font-size: 3rem;">
                                        {{ ucfirst(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                </div>
                                @endif 
                                <h3 class="username mb-2">{{Auth::user()->name}}</h3>
                                <form method="POST" action="{{ route('admin.upload.profile.picture')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="text-center">
                                        <div class="form-group"> 
                                            <input type="file" class="form-control" name="avatar" accept="image/png, image/jpg, image/jpeg" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-1 form-btn"><i class="fe fe-camera  mr-1"></i>Change Photo</button> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <form method="POST" action="{{ route('admin.update.password')}}">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Update Password</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-0 mt-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group"> 
                                            <label>New Password</label> 
                                            <input type="password" class="form-control" name="new_password" required> 
                                        </div>
                                        <div class="form-group mb-0"> 
                                            <label>Confirm Password</label> 
                                            <input type="password" class="form-control" name="new_password_confirmation" required> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right"> 
                            <button type="submit" class="btn btn-primary mt-1 form-btn">Change Password</button> 
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
                <form method="POST" action="{{ route('admin.update.profile')}}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Edit Profile</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group"> 
                                <label for="exampleInputname">Name</label> 
                                <input type="text" class="form-control" name="name" id="exampleInputname" value="{{Auth::user()->name}}" required> 
                            </div>
                            <div class="form-group"> 
                                <label for="exampleInputname1">Email</label> 
                                <input type="email" class="form-control" name="email" id="exampleInputname1" value="{{Auth::user()->email}}" required> 
                            </div>
                        </div>
                        <div class="card-footer text-right"> 
                            <button type="submit" class="btn btn-primary mt-1 form-btn">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> <!-- End Row -->

    </div> <!-- Right-sidebar-->
</div>
@endsection