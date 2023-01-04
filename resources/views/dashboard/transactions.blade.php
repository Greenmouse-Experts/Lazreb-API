@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Transactions</h1>
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
            <div class="col-md-12 col-lg-4">
            </div>
            <div class="col-md-12 col-lg-2">
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card text-white bg-gradient-primary">
                    <div class="card-body">
                        <h4 class="card-title">Lazreb Leasing and Logistics Ltd</h4>
                        <p class="card-text">Fidelity Bank Plc <br> Account No.5600701459</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">My Transactions</h3>
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
                                                    <th class="wd-15p sorting">Slip</th>
                                                    <th class="wd-20p sorting">Description</th>
                                                    <th class="wd-15p sorting">submitted At</th>
                                                </tr>
                                            </thead>
                                            @if($transactions->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="4">No Transaction.</td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                @foreach($transactions as $transaction)
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$loop->iteration}}</td>
                                                        <td>
                                                            <div class="userpic brround" style="display: flex; align-items: center; justify-content: center;"> 
                                                                <img class="userpicimg" src="{{$transaction->slip}}" width="100">
                                                            </div>
                                                        </td>
                                                        <td>{{$transaction->description}}</td>
                                                        <td>{{$transaction->created_at->toDayDateTimeString()}}</td>
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