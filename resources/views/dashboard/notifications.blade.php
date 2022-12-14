@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Notifications</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="My Requests"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="email-app">
                        <div class="inbox p-0">
                            <ul class="mail_list list-group list-unstyled">
                                @foreach($allNotifications as $Notification)
                                @if($Notification->status == 'Unread')
                                    <li class="list-group-item" style="background: #f0f1f775;">
                                        <div class="media">
                                            <div class="pull-left">
                                                <div class="controls">
                                                    <div class="custom-checkbox custom-control"> 
                                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1"> 
                                                        <label for="checkbox-1" class="custom-control-label"></label>
                                                     </div> 
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading"> 
                                                    <a href="{{route('user.read.notifications', Crypt::encrypt($Notification->id))}}" class="mr-2">{{\App\Models\User::where('id', $Notification->from)->first()->name}} - {{$Notification->subject}}</a> 
                                                    <small class="float-right text-muted">
                                                        <time class="hidden-sm-down" datetime="2017">{{$Notification->created_at->diffForHumans()}}</time>
                                                    </small>
                                                 </div>
                                                <p class="msg">{{$Notification->message}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @else
                                    <li class="list-group-item unread">
                                        <div class="media">
                                            <div class="pull-left">
                                                <div class="controls">
                                                    <div class="custom-checkbox custom-control"> 
                                                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4" checked disabled> 
                                                        <label for="checkbox-4" class="custom-control-label"></label> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading"> 
                                                    <a href="#" class="mr-2">{{\App\Models\User::where('id', $Notification->from)->first()->name}} - {{$Notification->subject}}</a> 
                                                    <span class="badge bg-primary text-white">{{$Notification->status}}</span> <small class="float-right text-muted"><time class="hidden-sm-down" datetime="2017">{{$Notification->created_at->diffForHumans()}}</time></small> </div>
                                                <p class="msg">{{$Notification->message}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Right-sidebar-->
</div>

@endsection