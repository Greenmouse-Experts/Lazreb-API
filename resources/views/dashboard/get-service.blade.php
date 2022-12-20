@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- app-content-->
@if($service->name == 'Hire A Vehicle')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}}</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('admin.add.service')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card-header">
                            <div class="mt-4">
                                <h3 class="card-title">Please complete the fields below</h3>
                                <p class="mt-2 text-danger">{{$service->description}}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label>Pick Up Address</label>
                                                <textarea type="text" class="form-control" name="pick_up_address" placeholder="Enter Pick Up Address" required> </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label>Drop Off Address</label>
                                                <textarea type="text" class="form-control" name="drop_off_address" placeholder="Enter Drop Off Address" required> </textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Start Date</label>
                                                <input type="date" class="form-control" name="start_date" placeholder="Enter Name" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Return Date</label>
                                                <input type="date" class="form-control" name="return_date" placeholder="Enter Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vehicle_type">Vehicle Type</label>
                                                <select name="vehicle_type" class="form-control" id="vehicle_type" required>
                                                    <option value="">-- Choose a Vehicle --</option>
                                                    <option value="Coaster">Coaster</option>
                                                    <option value="New Coaster">New Coaster</option>
                                                    <option value="Toyota Hiace">Toyota Hiace</option>
                                                    <option value="Sienna/Routan">Sienna/Routan</option>
                                                    <option value="Toyota Hilux">Toyota Hilux</option>
                                                    <option value="Toyota Venza">Toyota Venza</option>
                                                    <option value="Honda Accord">Honda Accord</option>
                                                    <option value="Camry Musle">Camry Musle</option>
                                                    <option value="Toyota Corrola">Toyota Corrola</option>
                                                    <option value="SUV Prado">SUV Prado</option>
                                                    <option value="Toyota Landcruiser">Toyota Landcruiser</option>
                                                    <option value="Lexus Landcruiser LX">Lexus Landcruiser LX</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label>Price</label>
                                                <input type="text" class="form-control" name="price" id="price" readonly required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Purpose of Use</label>
                                        <textarea type="text" class="form-control" name="name" placeholder="Enter purpose of use" required> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <input class="move" type="checkbox" class="form-control" name="agreement" required>I agree to Terms and Conditions
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right"> 
                            <button type="submit" class="btn btn-primary mt-1 form-btn">Submit</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End side app-->
</div>
@elseif($service->name == 'Charter A Vehicle')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}}</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->


    </div>
    <!--End side app-->
</div>
@elseif($service->name == 'Lease A Vehicle')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}}</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

    </div>
    <!--End side app-->
</div>
@elseif($service->name == 'Partner Fleet Management')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}}</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->


    </div>
    <!--End side app-->
</div>
@else
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Unavailable</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->
    </div>
    <!--End side app-->
</div>
@endif
<!-- End app-content-->

<script>
    const vehicleType = document.getElementById("vehicle_type");
    const price = document.querySelector('#price');

    vehicleType.addEventListener('change', () => {
        if (vehicleType.value === "Coaster") {
            price.value = '₦60,000 - ₦70,000';
        } else if (vehicleType.value === "New Coaster") {
            price.value = '₦150,000 - ₦160,000';
        } else if (vehicleType.value === "Toyota Hiace") {
            price.value = '₦50,000 - ₦60,000';
        } else if (vehicleType.value === "Sienna/Routan"){
            price.value = '₦40,000 - ₦50,000';
        } else if (vehicleType.value === "Toyota Hilux") {
            price.value = '₦40,000 - ₦50,000';
        } else if (vehicleType.value === "Toyota Venza") {
            price.value = '₦40,000 - ₦50,000';
        } else if (vehicleType.value === "Honda Accord") {
            price.value = '₦30,000 - ₦40,000';
        } else if (vehicleType.value === "Camry Musle"){
            price.value = '₦25,000 - ₦35,000';
        } else if (vehicleType.value === "Toyota Corrola") {
            price.value = '₦25,000 - ₦35,000';
        } else if (vehicleType.value === "SUV Prado") {
            price.value = '₦80,000 - ₦90,000';
        } else if (vehicleType.value === "Toyota Landcruiser") {
            price.value = '₦100,000 - ₦120,000';
        } else if (vehicleType.value === "Lexus Landcruiser LX") {
            price.value = '₦100,000 - ₦120,000';
        }
    });
</script>
@endsection