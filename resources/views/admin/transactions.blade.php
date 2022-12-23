@extends('layouts.admin-frontend')

@section('page-content')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Transactions</h1>
            <div class="ml-auto">
                <div class="input-group"> 
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a> 
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a> 
                    <a href="" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a> 
                </div>
            </div>
        </div> <!-- End page-header -->

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">All Transactions</h3>
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
                                                    <th class="wd-15p sorting">User</th>
                                                    <th class="wd-15p sorting">Slip</th>
                                                    <th class="wd-20p sorting">Description</th>
                                                    <th class="wd-15p sorting">submitted At</th>
                                                    <th class="wd-15p sorting">Action</th>
                                                </tr>
                                            </thead>
                                            @if($transactions->isEmpty())
                                                <tbody>
                                                    <tr>
                                                        <td class="align-enter text-dark font-13" colspan="6">No Transaction.</td>
                                                    </tr>
                                                </tbody>
                                            @else
                                                @foreach($transactions as $transaction)
                                                <tbody>
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">{{$loop->iteration}}</td>
                                                        <td>
                                                            {{\App\Models\User::where('id', $transaction->user_id)->first()->name}}<br>
                                                            <code>{{\App\Models\User::where('id', $transaction->user_id)->first()->email}}</code>
                                                        </td>
                                                        <td>
                                                            <div class="userpic brround" style="display: flex; align-items: center; justify-content: center;"> 
                                                                <img class="userpicimg" src="{{$transaction->slip}}" width="100">
                                                            </div>
                                                        </td>
                                                        <td>{{$transaction->description}}</td>
                                                        <td>{{$transaction->created_at->toDayDateTimeString()}}</td>
                                                        <td>
                                                            <a href="{{route('admin.users.download.transaction', Crypt::encrypt($transaction->id))}}" class="btn btn-app btn-primary mr-2 mb-1">
                                                                <i class="fa fa-upload"></i> Download Slip
                                                            </a>
                                                            <a href="#delete-{{$transaction->id}}" data-toggle="modal" class="btn btn-app btn-danger mr-2 mb-1">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </a>

                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete-{{$transaction->id}}" tabindex="-1" aria-labelledby="categoryDeleteLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form method="post" action="{{ route('admin.users.delete.transaction', Crypt::encrypt($transaction->id))}}">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"> 
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Transaction</h5> 
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                                                                                    <span aria-hidden="true">×</span> 
                                                                                </button> 
                                                                            </div>
                                                                            <div class="modal-body px-4 py-5 text-center">
                                                                                <div class="avatar-sm mb-4 mx-auto">
                                                                                    <div class="font-size-20 rounded-3">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <p class="font-size-16 mb-4" style="word-wrap: break-word;">Are you sure you want to permanently erase this transaction.</p>

                                                                                <div class="hstack gap-2 justify-content-center mb-0">
                                                                                    <button type="submit" class="form-btn btn btn-danger">Delete Now</button>
                                                                                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
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