@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- app-content-->
<div class="app-content toggle-content">
    <div class="side-app">
        <!-- page-header -->
        <div class="page-header">
            <h1 class="page-title">Partner Fleet Management</h1>
            <div class="ml-auto">
                <div class="input-group">
                    <a href="" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-flickr"></i> </span> </a>
                    <a href="{{route('user.my.requests')}}" class="btn btn-secondary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Request Services"> <span> <i class="fa fa-share-square"></i> </span> </a>
                    <a href="" class="btn btn-primary btn-icon mr-2" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Become A Partner"> <span> <i class="fa fa-square"></i> </span> </a>
                    <a href="" class="btn btn-secondary btn-icon" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Help/Support"> <span> <i class="fe fe-help-circle"></i> </span> </a>
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
                                            <form method="POST" action="{{ route('user.post.become.partner')}}">
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
                                            <form method="POST" action="{{ route('user.post.become.partner')}}">
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
<!-- End app-content-->

<script>
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