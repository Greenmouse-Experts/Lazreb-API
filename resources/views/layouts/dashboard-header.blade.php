<!--app-header-->
<div class="app-header header d-flex navbar-collapse">
    <div class="container-fluid">
        <div class="d-flex"> <a class="header-brand" href=""> <img src="{{URL::asset('dash/assets/images/brand/logo.png')}}" class="header-brand-img main-logo" alt="IndoUi logo"> <img src="{{URL::asset('dash/assets/images/brand/logo-light.png')}}" class="header-brand-img dark-main-logo" alt="IndoUi logo"> <img src="{{URL::asset('dash/assets/images/brand/icon-light.png')}}" class="header-brand-img dark-icon-logo" alt="IndoUi logo"> <img src="{{URL::asset('dash/assets/images/brand/icon.png')}}" class="header-brand-img icon-logo" alt="IndoUi logo"> </a><!-- logo-->
            <div class="app-sidebar__toggle" data-toggle="sidebar"> <a class="open-toggle" href="#"><i class="fe fe-align-left"></i></a> <a class="close-toggle" href="#"><i class="fe fe-x"></i></a> </div>

            <div class="d-flex order-lg-2 ml-auto header-right">
                <div class="dropdown d-md-flex header-message"> <a class="nav-link icon" data-toggle="dropdown"> <i class="fe fe-bell"></i> <span class="nav-unread badge badge-danger badge-pill">3</span> </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> <a class="dropdown-item text-center" href="#">Notifications</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item d-flex pb-4" href="#"> <span class="avatar mr-3 br-3 align-self-center avatar-md cover-image bg-primary-transparent text-primary"><i class="fe fe-mail"></i></span>
                            <div> <span class="font-weight-bold"> Commented on your post </span>
                                <div class="small text-muted d-flex"> 3 hours ago </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <div class="text-center dropdown-btn pb-3">
                            <div class="btn-list"><a href="#" class=" btn btn-secondary btn-sm"><i class="fe fe-eye mr-1"></i>View All</a> </div>
                        </div>
                    </div>
                </div>
                <!--Navbar -->
                <div class="dropdown header-profile"> 
                    <a class="nav-link pr-0 leading-none d-flex pt-1" data-toggle="dropdown" href="#"> 
                        @if(Auth::user()->photo)
                            <img class="avatar avatar-md brround cover-image" src="{{Auth::user()->photo}}" alt="{{Auth::user()->name}}">
                        @else
                            <span class="avatar avatar-md brround cover-image" style="background: red;">
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
                        <a class="dropdown-item" href="{{route('user.settings')}}"><i class="dropdown-icon fe fe-user"></i>Settings</a>
                        <a class="dropdown-item" href="{{route('logout')}}"><i class="dropdown-icon fe fe-power"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--app-header end-->