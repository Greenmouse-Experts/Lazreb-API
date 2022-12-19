@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- app-content-->
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title"><span class="subpage-title">Welcome To</span> User Dashboard</h1>
            <div class="ml-auto">
                <div class="input-group"> 
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a> 
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-success btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a> 
                    <a href="{{route('user.help.support')}}" class="btn btn-danger btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a> 
                </div>
            </div>
        </div> <!-- End page-header -->
        <!-- Row -->
        <div class="row">
            <div class="col-sm-6 col-lg-6 col-xl-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-3">Total Revenue</h6>
                        <h2 class="mb-2 number-font"><i class="zmdi zmdi-compass text-primary mr-2"></i>$2,891</h2>
                        <p class="mb-0 text-muted"> <span class="text-danger"><i class="fa fa-chevron-circle-down text-danger ml-1"></i> -1.6%</span> last month </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 col-xl-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-3">Total Profit</h6>
                        <h2 class="mb-2 number-font"><i class="zmdi zmdi-chart text-secondary mr-2"></i>$2,892</h2>
                        <p class="mb-0 text-muted"> <span class="text-danger"><i class="fa fa-chevron-circle-down text-danger ml-1"></i> -0.6%</span> last month </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 col-xl-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-3">Total Cost</h6>
                        <h2 class="mb-2 number-font"><i class="mdi mdi-cash-multiple text-success mr-2"></i>$12,789</h2>
                        <p class="mb-0 text-muted"> <span class="text-success"><i class="fa fa-chevron-circle-up text-success ml-1"></i> +0.16%</span> last month </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 col-xl-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-3">Total Shipments</h6>
                        <h2 class="mb-2 number-font"><i class="mdi mdi-truck  text-warning mr-2"></i>679</h2>
                        <p class="mb-0 text-muted"> <span class="text-success"><i class="fa fa-chevron-circle-up text-success ml-1"></i> +0.2%</span> last month </p>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
        <!-- Row -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Services Details</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered  mb-0 text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Emily Poole</td>
                                        <td>PRO12345</td>
                                        <td>Online Payment</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                    </tr>
                                    <tr>
                                        <td>Sarah Alsop</td>
                                        <td>PRO23457</td>
                                        <td>Cash on delivered</td>
                                        <td><span class="badge badge-secondary">Delivering</span></td>
                                    </tr>
                                    <tr>
                                        <td>Ruth Hart</td>
                                        <td>PRO94567</td>
                                        <td>Online Payment</td>
                                        <td><span class="badge badge-danger">Shipped</span></td>
                                    </tr>
                                    <tr>
                                        <td>Peter Ince</td>
                                        <td>PRO56789</td>
                                        <td>Cash on delivered</td>
                                        <td><span class="badge badge-primary">Add Cart</span></td>
                                    </tr>
                                    <tr>
                                        <td>Sophie Ross</td>
                                        <td>PRO30978</td>
                                        <td>Online Payment</td>
                                        <td><span class="badge badge-danger">Shipped</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Activities</h3>
                        </div>
                        <div class="card-options"> <a href="" class="mr-4 text-default" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="fe fe-more-horizontal fs-20"></span> </a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li><a href="#"><i class="fe fe-eye mr-2"></i>View</a></li>
                                <li><a href="#"><i class="fe fe-plus-circle mr-2"></i>Add</a></li>
                                <li><a href="#"><i class="fe fe-trash-2 mr-2"></i>Remove</a></li>
                                <li><a href="#"><i class="fe fe-download-cloud mr-2"></i>Download</a></li>
                                <li><a href="#"><i class="fe fe-settings mr-2"></i>More</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group projects-list"> <a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 font-weight-sembold text-dark">Order Picking</h6>
                                    <h6 class="text-dark mb-0 font-weight-sembold text-dark">3,876</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between"> <span class="text-muted"><i class="fe fe-arrow-down text-success "></i> 03% last month</span> <span class="text-muted">5 days ago</span> </div>
                            </a> <a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-left-0 border-right-0 border-top">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 font-weight-sembold text-dark">Storage</h6>
                                    <h6 class="text-dark mb-0 font-weight-sembold text-dark">2,178</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between"> <span class="text-muted"><i class="fe fe-arrow-down text-danger "></i> 16% last month</span> <span class="text-muted">2 days ago</span> </div>
                            </a> <a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-left-0 border-right-0 border-top">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 font-weight-sembold text-dark">Shipping</h6>
                                    <h6 class="text-dark mb-0 font-weight-sembold text-dark">1,367</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between"> <span class="text-muted"><i class="fe fe-arrow-up text-success"></i> 06% last month</span> <span class="text-muted">1 days ago</span> </div>
                            </a> <a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-left-0 border-right-0 border-top">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 font-weight-sembold text-dark">Receiving</h6>
                                    <h6 class="text-dark mb-0 font-weight-sembold text-dark">678</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between"> <span class="text-muted"><i class="fe fe-arrow-down text-danger "></i> 25% last month</span> <span class="text-muted">10 days ago</span> </div>
                            </a> <a href="#" class="list-group-item list-group-item-action flex-column align-items-start border-bottom-0  border-left-0 border-right-0 border-top">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1 font-weight-sembold text-dark">Other</h6>
                                    <h6 class="text-dark mb-0 font-weight-sembold text-dark">5,678</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between"> <span class="text-muted"><i class="fe fe-arrow-up text-success "></i> 16% last month</span> <span class="text-muted">5 days ago</span> </div>
                            </a> </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
    </div>
    <!--End side app-->
</div> 
<!-- End app-content-->

@endsection