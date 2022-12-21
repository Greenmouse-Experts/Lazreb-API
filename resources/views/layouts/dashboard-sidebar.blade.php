<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar toggle-sidebar ps ps--active-y">
    <ul class="side-menu toggle-menu">
        <li>
            <h3>Main</h3>
        </li>
        <li class="slide"> <a class="side-menu__item active" href="{{route('user.dashboard')}}"><i class="side-menu__icon fe fe-airplay"></i><span class="side-menu__label">Dashboard</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('user.request.services')}}"><i class="side-menu__icon fa fa-flickr"></i><span class="side-menu__label">Request Services</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('user.my.requests')}}"><i class="side-menu__icon fa fa-share-square"></i><span class="side-menu__label">My Requests</span></a></li>
        <li class="slide"> 
            <a class="side-menu__item" data-toggle="slide" href="#">
            <i class="side-menu__icon fa fa-flickr"></i>
            <span class="side-menu__label">Become A Partner</span>
            <i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu"> 
                <li><a href="{{route('user.become.a.partner')}}" class="slide-item">Add</a></li>
                <li><a href="{{route('user.manage.become.a.partner')}}" class="slide-item">Manage</a></li> 
            </ul> 
        </li>
        <li class="slide"> <a class="side-menu__item" href="{{route('user.notifications')}}"><i class="side-menu__icon fa fa-bell"></i><span class="side-menu__label">Notifications</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('user.transactions')}}"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">Transactions</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('user.help.support')}}"><i class="side-menu__icon fa fa-question-circle"></i><span class="side-menu__label">Help/Support</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('user.referrals')}}"><i class="side-menu__icon fe fe-codepen"></i><span class="side-menu__label">Referrals</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('user.settings')}}"><i class="side-menu__icon fa fa-cog"></i><span class="side-menu__label">Settings</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('logout')}}"><i class="side-menu__icon fa fa-sign-out"></i><span class="side-menu__label">Logout</span></a></li>
    </ul>
    <div class="ps__rail-x" style="left: 0px; bottom: -19px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 19px; height: 674px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 17px; height: 611px;"></div>
    </div>
</aside>
<!--sidemenu end-->