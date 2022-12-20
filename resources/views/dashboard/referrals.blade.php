@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Referral</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->
        <!-- Row -->
        <div class="row">
            <div class="col-12 mb-30">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-8 pt-5 pb-5 text-center">
                                <h2 class="card-title pb-3"> REFER OTHERS </h4>
                                    <p class="pb-5"> Copy and paste this link to send to
                                        friends or use in your articles. When
                                        users sign up using this link or code, your
                                        account will be rewarded.</p>
                                    <h5 class="pb-3">Share your link:</h5>
                                    <form action="#">
                                        <input type="text" id="myInput" class="form-control referral_input text-center font-weight-bold" readonly value="{{ route('sign', ['ref' => Auth::user()->referral_code]) }}">
                                        <a href="javascript:void(0)" style="cursor: copy;" class="btn btn-primary mt-2 w-30" onclick="myCopy()">Copy</a>
                                    </form>

                                    <h5 class="mt-5 pb-3">Share your Code:</h5>
                                    <form action="#">
                                        <input type="text" id="myCode" class="form-control referral_input text-center font-weight-bold" readonly value="{{ Auth::user()->referral_code }}">
                                        <a href="javascript:void(0)" class="btn btn-primary mt-2 w-30" style="cursor: copy;" onclick="myCopyCode()">Copy</a>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">People You Referred</h3>
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
                                                    <th class="wd-15p sorting_asc">Name</th>
                                                    <th class="wd-15p sorting">Email</th>
                                                    <th class="wd-20p sorting">Phone Number</th>
                                                    <th class="wd-15p sorting">Referred Date</th>
                                                </tr>
                                            </thead>
                                            @foreach($referrals as $referral)
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$loop->iteration}}</td>
                                                    <td>{{\App\Models\User::findorfail($referral->referee_id)->name}}</td>
                                                    <td>{{\App\Models\User::findorfail($referral->referee_id)->email}}</td>
                                                    <td>{{\App\Models\User::findorfail($referral->referee_id)->phone_number}}</td>
                                                    <td>{{$referral->created_at->toDayDateTimeString()}}</td>
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