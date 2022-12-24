@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Manage {{$user->name}}</h1>
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
            <div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$user->name}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="userprofile ">
                                @if($user->photo)
                                <div class="userpic brround" style="display: flex; align-items: center;"> 
                                    <img class="userpicimg" src="{{$user->photo}}" alt="{{$user->name}}">
                                </div>
                                @else
                                <div class="userpic brround" style="display: flex; align-items: center;"> 
                                    <span class="userpicimg" style="font-size: 3rem;">
                                        {{ ucfirst(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                                @endif 
                                <h3 class="username mb-2">{{$user->name}}</h3>
                                <form method="POST" action="{{ route('admin.upload.profile.picture.user', Crypt::encrypt($user->id))}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="text-center">
                                        <div class="form-group"> 
                                            <input type="file" class="form-control" name="avatar"accept="image/png, image/jpg, image/jpeg"  required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-1 form-btn"><i class="fe fe-camera  mr-1"></i>Change Photo</button> 
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <form method="POST" action="{{ route('admin.update.password.user', Crypt::encrypt($user->id))}}">
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
                <form method="POST" action="{{ route('admin.update.profile.user', Crypt::encrypt($user->id))}}">
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
                                <input type="text" class="form-control" name="name" id="exampleInputname" value="{{$user->name}}" required> 
                            </div>
                            <div class="form-group"> 
                                <label for="exampleInputname1">Email</label> 
                                <input type="email" class="form-control" name="email" id="exampleInputname1" value="{{$user->email}}" required> 
                            </div>
                            <div class="form-group"> 
                                <label for="sex">Sex</label> 
                                <select name="sex" class="form-control" id="sex" required>
                                    <option value="{{$user->sex}}">{{$user->sex}}</option>
                                    <option value="">-- Select Gender --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group"> 
                                <label for="exampleInputnumber">Phone Number</label> 
                                <input type="tel" class="form-control" id="exampleInputnumber" name="phone_number" value="{{$user->phone_number}}" required> 
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