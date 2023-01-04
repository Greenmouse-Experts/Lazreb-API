<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar toggle-sidebar ps ps--active-y">
    <ul class="side-menu toggle-menu">
        <li>
            <h3>Main</h3>
        </li>
        <li class="slide"> <a class="side-menu__item active" href="{{route('admin.dashboard')}}">
            <i class="side-menu__icon fe fe-airplay"></i>
            <span class="side-menu__label">Dashboard</span></a>
        </li>
        <li class="slide"> <a class="side-menu__item" href="{{route('admin.users')}}"><i class="side-menu__icon fa fa-user"></i><span class="side-menu__label">Users</span></a></li>
        <li class="slide"> 
            <a class="side-menu__item" href="{{route('admin.get.services')}}">
            <i class="side-menu__icon fa fa-flickr"></i>
            <span class="side-menu__label">Services</span>
            </a>
        </li>
        <li class="slide"> <a class="side-menu__item" href="{{route('admin.users.services.requests')}}"><i class="side-menu__icon fa fa-share-square"></i><span class="side-menu__label">Service Requests</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('admin.users.notifications')}}"><i class="side-menu__icon fa fa-bell"></i><span class="side-menu__label">Notifications</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('admin.users.transactions')}}"><i class="side-menu__icon fa fa-money"></i><span class="side-menu__label">Transactions</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('admin.get.annoucement')}}"><i class="side-menu__icon fa-solid fa fa-bullhorn"></i><span class="side-menu__label">Promo/Annoucement</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('admin.settings')}}"><i class="side-menu__icon fa fa-cog"></i><span class="side-menu__label">Settings</span></a></li>
        <li class="slide"> <a class="side-menu__item" href="{{route('logout')}}"><i class="side-menu__icon fa fa-sign-out"></i><span class="side-menu__label">Logout</span></a></li>
    </ul>
</aside>
<!--sidemenu end-->