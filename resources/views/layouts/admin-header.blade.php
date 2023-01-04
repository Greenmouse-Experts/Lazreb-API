<!--app-header-->
<div class="app-header header d-flex navbar-collapse">
    <div class="container-fluid">
        <div class="d-flex"> 
            <a class="header-brand" href=""> 
                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671441634/lazreb/lab_1_r017da.jpg" class="header-brand-img main-logo" alt="{{config('app.name')}}"> 
                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1671441634/lazreb/lab_1_r017da.jpg" class="header-brand-img icon-logo" alt="{{config('app.name')}}"> 
            </a><!-- logo-->
            <div class="app-sidebar__toggle" data-toggle="sidebar"> <a class="open-toggle" href="#"><i class="fe fe-align-left"></i></a> <a class="close-toggle" href="#"><i class="fe fe-x"></i></a> </div>

            <div class="d-none dropdown d-md-flex header-settings"> 
                <a class="nav-link icon" data-toggle="dropdown"> 
                    <i class="fe fe-user mr-2"></i>
                    <span class="lay-outstyle mt-1">Admin Dashboard</span> 
                    <span class="pulse2 bg-warning" aria-hidden="true"></span> 
                </a> 
             </div>
            <div class="d-flex order-lg-2 ml-auto header-right">
                <div class="dropdown d-md-flex header-message"> <a class="nav-link icon" data-toggle="dropdown"> <i class="fe fe-bell"></i> <span class="nav-unread badge badge-danger badge-pill">{{$countUnreadNotifications}}</span> </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> 
                        <a class="dropdown-item text-center" href="#">Notifications</a>
                        <div class="dropdown-divider"></div> 
                        @foreach($unreadNotifications as $unreadNotification)
                        <a class="dropdown-item d-flex pb-4" href="#"> 
                            <div> 
                                <span class="font-weight-bold">{{\App\Models\User::where('id', $unreadNotification->from)->first()->name}} - {{$unreadNotification->subject}}</span>
                                <div class="small text-muted d-flex"> {{$unreadNotification->created_at->diffForHumans()}} </div>
                            </div>
                        </a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        <div class="text-center dropdown-btn pb-3">
                            <div class="btn-list"><a href="{{route('admin.users.notifications')}}" class=" btn btn-secondary btn-sm"><i class="fe fe-eye mr-1"></i>View All</a> </div>
                        </div>
                    </div>
                </div>
                <!--Navbar -->
                <div class="dropdown header-profile"> 
                    <a class="nav-link pr-0 leading-none d-flex pt-1" data-toggle="dropdown" href="#"> 
                        @if(Auth::user()->photo)
                            <img class="avatar avatar-md brround cover-image" src="{{Auth::user()->photo}}" alt="{{Auth::user()->name}}">
                        @else
                            <span class="avatar avatar-md brround cover-image" style="background: #052a56;">
                                {{ ucfirst(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                <h5 class="text-dark mb-1">{{ucfirst(Auth::user()->name)}}</h5> <small class="text-muted">{{Auth::user()->account_type}}</small>
                            </div>
                        </div>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item" href="{{route('admin.settings')}}"><i class="dropdown-icon fe fe-user"></i>Settings</a>
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="dropdown-icon fe fe-power"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--app-header end-->