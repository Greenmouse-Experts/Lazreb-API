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
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('user.post.request.service', Crypt::encrypt($service->id))}}">
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
                                                <input type="date" class="form-control" name="start_date" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Return Date</label>
                                                <input type="date" class="form-control" name="return_date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Start Time</label>
                                                <input type="time" class="form-control" name="start_time" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Return Time</label>
                                                <input type="time" class="form-control" name="return_time" required>
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
                                        <label for="purpose_of_use">Purpose of Use</label>
                                        <select name="purpose_of_use" class="form-control" required>
                                            <option value="">-- Choose Purpose of use --</option>
                                            <option value="Executive Transport Service">Executive Transport Service</option>
                                            <option value="Travel & Tours">Travel & Tours</option>
                                            <option value="Staff Bus Services">Staff Bus Services</option>
                                            <option value="Business Meetings">Business Meetings</option>
                                            <option value="Party Buses">Party Buses</option>
                                            <option value="Campaign">Campaign</option>
                                            <option value="Concerts">Concerts</option>
                                            <option value="Rental/Hire">Rental/Hire</option>
                                        </select>
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
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('user.post.request.service', Crypt::encrypt($service->id))}}">
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
                                                <label>Departure Date</label>
                                                <input type="date" class="form-control" name="start_date" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Return Date</label>
                                                <input type="date" class="form-control" name="return_date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Departure Time</label>
                                                <input type="time" class="form-control" name="start_time" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Return Time</label>
                                                <input type="time" class="form-control" name="return_time" required>
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
                                            <label for="charter_type">Charter Type</label>
                                            <select name="charter_type" class="form-control" required>
                                                <option value="">-- Choose a Charter Type --</option>
                                                <option value="Drop Off">Drop Off</option>
                                                <option value="Drop Off and Wait">Drop Off and Wait</option>
                                                <option value="Drop Off and Return">Drop Off and Return</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Purpose of Use</label>
                                        <textarea type="text" class="form-control" name="purpose_of_use" placeholder="Enter purpose of use" required> </textarea>
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
@elseif($service->name == 'Lease A Vehicle')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}}</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="{{ route('user.post.request.service', Crypt::encrypt($service->id))}}">
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
                                    <div class="form-group"> 
                                        <label>Company/Individual Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Company/Individual Name" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vehicle_type">Vehicle Type</label>
                                                <select name="vehicle_type" class="form-control" required>
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
                                        <div class="col-6">
                                            <div class="form-group"> 
                                                <label>Lease Duration</label>
                                                <input type="date" class="form-control" name="lease_duration" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="purpose_of_use">Purpose of Use</label>
                                        <select name="purpose_of_use" class="form-control" required>
                                            <option value="">-- Choose Purpose of use --</option>
                                            <option value="Executive Transport Service">Executive Transport Service</option>
                                            <option value="Travel & Tours">Travel & Tours</option>
                                            <option value="Staff Bus Services">Staff Bus Services</option>
                                            <option value="Business Meetings">Business Meetings</option>
                                            <option value="Party Buses">Party Buses</option>
                                            <option value="Campaign">Campaign</option>
                                            <option value="Concerts">Concerts</option>
                                            <option value="Rental/Hire">Rental/Hire</option>
                                        </select>
                                    </div>
                                    <div class="form-group"> 
                                        <label>Location of Use</label>
                                        <textarea type="text" class="form-control" name="location_of_use" placeholder="Enter location of use" required> </textarea>
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
@elseif($service->name == 'Partner Fleet Management')
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">{{$service->name}}</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="{{route('user.request.services')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="{{route('user.become.a.partner')}}" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="{{route('user.help.support')}}" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
                </div>
            </div>
        </div> <!-- End page-header -->

        <div class="row">
            <div class="col-12">
                <div class="card myTab2">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item "> 
                                <a class="nav-link active show" id="individual-tab2" data-toggle="tab" href="#individual2" role="tab" aria-controls="home" aria-selected="false">Individual</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" id="corporate-tab2" data-toggle="tab" href="#corporate2" role="tab" aria-controls="profile" aria-selected="false">Corporate</a> 
                            </li>
                        </ul>
                        <div class="tab-content tab-bordered" id="myTab2Content">
                            <div class="tab-pane fade active show" id="individual2" role="tabpanel" aria-labelledby="individual-tab2">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="POST" action="{{ route('user.post.request.service', Crypt::encrypt($service->id))}}">
                                                @csrf
                                                <div class="card-header">
                                                    <div>
                                                        <h3 class="card-title">Please complete the fields below</h3>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Partnership Type</label>
                                                                <input class="form-control" name="partnership_type" value="Individual" readonly required>
                                                            </div>
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
                                                                    <option value="">Other</option>
                                                                </select>
                                                                <input type="text" id="otherValue" name="vehicle_types" placeholder="Enter Vehicle Type" class="form-control mt-2">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>No of Vehicles</label>
                                                                <input type="number" class="form-control" name="no_of_vehicles" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>NIN</label>
                                                                <input type="text" class="form-control" name="nin" required>
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
                            <div class="tab-pane fade" id="corporate2" role="tabpanel" aria-labelledby="corporate-tab2">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="POST" action="{{ route('user.post.request.service', Crypt::encrypt($service->id))}}">
                                                @csrf
                                                <div class="card-header">
                                                    <div>
                                                        <h3 class="card-title">Please complete the fields below</h3>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Partnership Type</label>
                                                                <input class="form-control" name="partnership_type" value="Corporate" readonly required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="vehicle_type">Vehicle Type</label>
                                                                <select name="vehicle_type" class="form-control" id="vehicle_types" required>
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
                                                                    <option value="">Other</option>
                                                                </select>
                                                                <input type="text" id="otherVehicleValue" name="vehicle_types" placeholder="Enter Vehicle Type" class="form-control mt-2">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>No of Vehicles</label>
                                                                <input type="number" class="form-control" name="no_of_vehicles" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Company Name</label>
                                                                <input type="text" class="form-control" name="company_name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Company Address</label>
                                                                <input type="text" class="form-control" name="company_address" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>CAC Number</label>
                                                                <input type="text" class="form-control" name="cac_number" required>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
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
            price.value = '₦60,000 - ₦70,000 Per Day';
        } else if (vehicleType.value === "New Coaster") {
            price.value = '₦150,000 - ₦160,000 Per Day';
        } else if (vehicleType.value === "Toyota Hiace") {
            price.value = '₦50,000 - ₦60,000 Per Day';
        } else if (vehicleType.value === "Sienna/Routan"){
            price.value = '₦40,000 - ₦50,000 Per Day';
        } else if (vehicleType.value === "Toyota Hilux") {
            price.value = '₦40,000 - ₦50,000 Per Day';
        } else if (vehicleType.value === "Toyota Venza") {
            price.value = '₦40,000 - ₦50,000 Per Day';
        } else if (vehicleType.value === "Honda Accord") {
            price.value = '₦30,000 - ₦40,000 Per Day';
        } else if (vehicleType.value === "Camry Musle"){
            price.value = '₦25,000 - ₦35,000 Per Day';
        } else if (vehicleType.value === "Toyota Corrola") {
            price.value = '₦25,000 - ₦35,000 Per Day';
        } else if (vehicleType.value === "SUV Prado") {
            price.value = '₦80,000 - ₦90,000 Per Day';
        } else if (vehicleType.value === "Toyota Landcruiser") {
            price.value = '₦100,000 - ₦120,000 Per Day';
        } else if (vehicleType.value === "Lexus Landcruiser LX") {
            price.value = '₦100,000 - ₦120,000 Per Day';
        }
    });

    const other = document.getElementById("vehicle_type");
    const others = document.getElementById("vehicle_types");
    const otherText = document.querySelector('#otherValue');
    const otherVehicleValue = document.querySelector('#otherVehicleValue');
    otherText.style.visibility = 'hidden';
    otherVehicleValue.style.visibility = 'hidden';

    other.addEventListener('change', () => {
        if (other.value === "") {
            otherText.style.visibility = 'visible';
            otherText.value = '';
        } else {
            otherText.style.visibility = 'hidden';
            otherText.value = '';
        }
    });

    others.addEventListener('change', () => {
        if (others.value === "") {
            otherVehicleValue.style.visibility = 'visible';
            otherVehicleValue.value = '';
        } else {
            otherVehicleValue.style.visibility = 'hidden';
            otherVehicleValue.value = '';
        }
    });
</script>
@endsection