@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Manage Users</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
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
                            <h3 class="card-title">All Users</h3>
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
                                                    <th class="wd-15p sorting_asc">Photo</th>
                                                    <th class="wd-15p sorting_asc">Name</th>
                                                    <th class="wd-20p sorting">Sex</th>
                                                    <th class="wd-20p sorting">Phone Number</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @foreach($users as $user)
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$loop->iteration}}</td>
                                                    <td>
                                                        @if($user->photo)
                                                        <img class="avatar avatar-md rounded-circle" src="{{$user->photo}}" alt="{{$user->name}}">
                                                        @else
                                                        <div class="userpic brround" style="display: flex; align-items: center; justify-content: center; background: #052a56; width: 43px;"> 
                                                            <span class="avatar avatar-md rounded-circle" style="font-size: 1.5rem;">
                                                                {{ ucfirst(substr($user->name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                        @endif 
                                                    </td>
                                                    <td>{{$user->name}} <br>
                                                        <code>{{$user->email}}</code>
                                                    </td>
                                                    <td>{{$user->sex}}</td>
                                                    <td>{{$user->phone_number}}</td>
                                                    <td>{{$user->created_at->toDayDateTimeString()}}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-primary badge" href="{{route('admin.edit.user', Crypt::encrypt($user->id))}}">Edit</a>
                                                        <button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Send Message</button>
                                                        <button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="button">Activate</button>
                                                        <button class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-toggle="modal" type="Deactivate">Deactivate</button>
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