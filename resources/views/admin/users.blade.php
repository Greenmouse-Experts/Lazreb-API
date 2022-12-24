@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Manage Users</h1>
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
                                                    <th class="wd-20p sorting">Status</th>
                                                    <th class="wd-15p sorting">Created At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @if($users->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="8">No User.</td>
                                                    </tr>
                                                </tbody>
                                            @else
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
                                                        <td>
                                                            @if($user->status == 'Active')
                                                            <span class="badge badge-success mr-1 mb-1 mt-1">{{$user->status}}</span>
                                                            @else
                                                            <span class="badge badge-warning mr-1 mb-1 mt-1">{{$user->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$user->created_at->toDayDateTimeString()}}</td>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary badge" href="{{route('admin.edit.user', Crypt::encrypt($user->id))}}">Edit</a>
                                                            <button class="btn btn-sm btn-primary badge" data-target="#user-send-message-{{$user->id}}" data-toggle="modal" type="button">Send Message</button>
                                                            <div class="modal fade" id="user-send-message-{{$user->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="POST" action="{{ route('admin.send.message.user', Crypt::encrypt($user->id))}}">
                                                                        @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="example-Modal3">New message</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group"> 
                                                                                    <label for="name" class="form-control-label">User:</label> 
                                                                                    <input type="text" class="form-control" id="name" value="{{$user->name}}" disabled> 
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label for="subject" class="form-control-label">Subject:</label> 
                                                                                    <input type="text" class="form-control" id="subject" name="subject" required> 
                                                                                </div>
                                                                                <div class="form-group"> 
                                                                                    <label for="message-text" class="form-control-label">Message:</label> 
                                                                                    <textarea class="form-control" id="message-text" name="message" required></textarea> 
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer"> 
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                                                                <button type="submit" class="form-btn btn btn-primary">Send message</button> 
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($user->status == 'Active')
                                                            <a class="btn btn-sm btn-primary badge" href="{{route('admin.deactivate.user', Crypt::encrypt($user->id))}}">Deactivate</a>
                                                            @else
                                                            <a class="btn btn-sm btn-primary badge" href="{{route('admin.activate.user', Crypt::encrypt($user->id))}}">Activate</a>
                                                            @endif
                                                            <a class="btn btn-sm  btn-primary badge" href="{{route('admin.user.referral', Crypt::encrypt($user->id))}}"> <span style="color: #fff !important;">Referrals</span> <span class="badge badge-white">{{\App\Models\Referee::where('referrer_id', $user->id)->get()->count()}}</span> </a>
                                                            <button class="btn btn-sm btn-primary badge" data-target="#user-delete-{{$user->id}}" data-toggle="modal" type="button">Delete Account</button>
                                                            <div class="modal fade" id="user-delete-{{$user->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form method="POST" action="{{ route('admin.delete.user', Crypt::encrypt($user->id))}}">
                                                                        @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="example-Modal3">Delete {{$user->name}}</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="avatar-sm mb-4 mx-auto">
                                                                                    <div class="font-size-20 rounded-3">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <p class="font-size-16 mb-4" style="word-wrap: break-word;">Are you sure you want to permanently erase this user.</p>

                                                                            </div>
                                                                            <div class="modal-footer"> 
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                                                                <button type="submit" class="form-btn btn" style="background: red; color: #fff;">Delete Now</button> 
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
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
    </div> <!-- Right-sidebar-->
</div>
@endsection