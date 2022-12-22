<?php

namespace App\Http\Controllers;

use App\Models\BecomePartner;
use App\Models\CharterVehicle;
use App\Models\HireVehicle;
use App\Models\LeaseVehicle;
use App\Models\Referee;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function dashboard()
    { 
        $hireService = HireVehicle::where('user_id', Auth::user()->id)->get()->count();
        $leaseService =  LeaseVehicle::where('user_id', Auth::user()->id)->get()->count();
        $charterService = CharterVehicle::where('user_id', Auth::user()->id)->get()->count();
        $partnerFleetManagement = BecomePartner::where('user_id', Auth::user()->id)->get()->count();
        $userRequestServices = $hireService + $leaseService + $charterService + $partnerFleetManagement;

        $services = Service::get();

        $referrals = Referee::where('referrer_id', Auth::user()->id)->get()->count();

        return view('dashboard.dashboard', [
            'services' => $services,
            'userRequestServices' => $userRequestServices,
            'referrals' => $referrals,
            'partnerFleetManagement' => $partnerFleetManagement
        ]);
    }
    
    public function request_services()
    {
        $services = Service::latest()->get();

        return view('dashboard.request-services', [
            'services' => $services
        ]);
    }

    public function get_service($id)
    {
        $finder = Crypt::decrypt($id);

        $service = Service::findorfail($finder);

        return view('dashboard.get-service', [
            'service' => $service
        ]);
    }

    public function post_request_service($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $service = Service::findorfail($finder);

        if($service->name == 'Hire A Vehicle')
        {
            $this->validate($request, [
                'pick_up_address' => ['required', 'string', 'max:255'],
                'drop_off_address' => ['required', 'string', 'max:255'],
                'start_date' => ['required', 'date'],
                'return_date' => ['required', 'date'],
                'start_time' => ['required', 'date_format:H:i'],
                'return_time' => ['required', 'date_format:H:i'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'price' => ['required', 'string', 'max:255'],
                'purpose_of_use' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'string', 'max:255'],
            ]);
            
            HireVehicle::create([
                'user_id' => Auth::user()->id,
                'service_id' => $service->id,
                'pick_up_address' => $request->pick_up_address,
                'drop_off_address' => $request->drop_off_address,
                'start_date' => $request->start_date,
                'return_date' => $request->return_date,
                'start_time' => $request->start_time,
                'return_time' => $request->return_time,
                'vehicle_type' => $request->vehicle_type,
                'price' => $request->price,
                'purpose_of_use' => $request->purpose_of_use,
                'agreement' => $request->agreement,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Your request to hire a vehicle has been submitted successfully, kindly check back while the admin reviews your request. Thank you.'
            ]); 

        }

        if($service->name == 'Charter A Vehicle')
        {
            $this->validate($request, [
                'pick_up_address' => ['required', 'string', 'max:255'],
                'drop_off_address' => ['required', 'string', 'max:255'],
                'start_date' => ['required', 'date'],
                'return_date' => ['required', 'date'],
                'start_time' => ['required', 'date_format:H:i'],
                'return_time' => ['required', 'date_format:H:i'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'charter_type' => ['required', 'string', 'max:255'],
                'purpose_of_use' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'string', 'max:255'],
            ]);
            
            CharterVehicle::create([
                'user_id' => Auth::user()->id,
                'service_id' => $service->id,
                'pick_up_address' => $request->pick_up_address,
                'drop_off_address' => $request->drop_off_address,
                'start_date' => $request->start_date,
                'return_date' => $request->return_date,
                'start_time' => $request->start_time,
                'return_time' => $request->return_time,
                'vehicle_type' => $request->vehicle_type,
                'charter_type' => $request->charter_type,
                'purpose_of_use' => $request->purpose_of_use,
                'agreement' => $request->agreement,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Your request to charter a vehicle has been submitted successfully, kindly check back while the admin reviews your request. Thank you.'
            ]); 
        }

        if($service->name == 'Lease A Vehicle')
        {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'lease_duration' => ['required', 'date'],
                'purpose_of_use' => ['required', 'string', 'max:255'],
                'location_of_use' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'string', 'max:255'],
            ]);
            
            LeaseVehicle::create([
                'user_id' => Auth::user()->id,
                'service_id' => $service->id,
                'name' => $request->name,
                'vehicle_type' => $request->vehicle_type,
                'lease_duration' => $request->lease_duration,
                'purpose_of_use' => $request->purpose_of_use,
                'location_of_use' => $request->location_of_use,
                'agreement' => $request->agreement,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Your request to lease a vehicle has been submitted successfully, kindly check back while the admin reviews your request. Thank you.'
            ]); 
        }

        return back()->with([
            'type' => 'danger',
            'message' => 'Service Unavailable.'
        ]); 

    }

    public function my_requests()
    {
        $services = Service::latest()->get();
        $partnerFleetManagement = BecomePartner::where('user_id', Auth::user()->id)->get()->count();

        return view('dashboard.my-requests', [
            'services' => $services,
            'partnerFleetManagement' => $partnerFleetManagement
        ]);
    }

    public function view_my_requests($id)
    {
        $finder = Crypt::decrypt($id);

        $service = Service::findorfail($finder);

        return view('dashboard.view-my-requests', [
            'service' => $service
        ]);
    }

    public function update_hire_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $hirevehicle = HireVehicle::findorfail($finder);

        $this->validate($request, [
            'pick_up_address' => ['required', 'string', 'max:255'],
            'drop_off_address' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'return_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'return_time' => ['required', 'date_format:H:i'],
            'vehicle_type' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'purpose_of_use' => ['required', 'string', 'max:255'],
        ]);
        
        $hirevehicle->update([
            'pick_up_address' => $request->pick_up_address,
            'drop_off_address' => $request->drop_off_address,
            'start_date' => $request->start_date,
            'return_date' => $request->return_date,
            'start_time' => $request->start_time,
            'return_time' => $request->return_time,
            'vehicle_type' => $request->vehicle_type,
            'price' => $request->price,
            'purpose_of_use' => $request->purpose_of_use,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => "Request Updated Successfully!",
        ]);
    }

    public function delete_hire_vehicle($id)
    {
        $finder = Crypt::decrypt($id);

        HireVehicle::findorfail($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => "Request Deleted Successfully!",
        ]);
    }

    public function update_charter_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $chartervehicle = CharterVehicle::findorfail($finder);

        $this->validate($request, [
            'pick_up_address' => ['required', 'string', 'max:255'],
            'drop_off_address' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'return_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'return_time' => ['required', 'date_format:H:i'],
            'vehicle_type' => ['required', 'string', 'max:255'],
            'charter_type' => ['required', 'string', 'max:255'],
            'purpose_of_use' => ['required', 'string', 'max:255'],
        ]);
        
        $chartervehicle->update([
            'pick_up_address' => $request->pick_up_address,
            'drop_off_address' => $request->drop_off_address,
            'start_date' => $request->start_date,
            'return_date' => $request->return_date,
            'start_time' => $request->start_time,
            'return_time' => $request->return_time,
            'vehicle_type' => $request->vehicle_type,
            'charter_type' => $request->charter_type,
            'purpose_of_use' => $request->purpose_of_use,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => "Request Updated Successfully!",
        ]);
    }

    public function delete_charter_vehicle($id)
    {
        $finder = Crypt::decrypt($id);

        CharterVehicle::findorfail($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => "Request Deleted Successfully!",
        ]);
    }

    public function update_lease_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $leaseVehicle = LeaseVehicle::findorfail($finder);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'vehicle_type' => ['required', 'string', 'max:255'],
            'lease_duration' => ['required', 'date'],
            'purpose_of_use' => ['required', 'string', 'max:255'],
            'location_of_use' => ['required', 'string', 'max:255'],
        ]);
        
        $leaseVehicle->update([
            'name' => $request->name,
            'vehicle_type' => $request->vehicle_type,
            'lease_duration' => $request->lease_duration,
            'purpose_of_use' => $request->purpose_of_use,
            'location_of_use' => $request->location_of_use,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => "Request Updated Successfully!",
        ]);
    }

    public function delete_lease_vehicle($id)
    {
        $finder = Crypt::decrypt($id);

        LeaseVehicle::findorfail($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => "Request Deleted Successfully!",
        ]);
    }

    public function become_a_partner()
    {
        return view('dashboard.become-a-partner');
    }

    public function post_become_partner(Request $request)
    {
        $allBecomePartner = BecomePartner::where('user_id', Auth::user()->id)->get();

        if($allBecomePartner->isEmpty())
        {
            if($request->partnership_type == 'Individual')
            {
                if($request->vehicle_types == '')
                {
                    $this->validate($request, [
                        'vehicle_type' => ['required', 'string', 'max:255'],
                        'no_of_vehicles' => ['required', 'numeric'],
                        'nin' => ['required', 'string', 'max:255'],
                        'agreement' => ['required', 'string']
                    ]);
                    BecomePartner::create([
                        'user_id' => Auth::user()->id,
                        'partnership_type' => $request->partnership_type,
                        'vehicle_type' => $request->vehicle_type,
                        'no_of_vehicles' => $request->no_of_vehicles,
                        'nin' => $request->nin,
                        'agreement' => $request->agreement
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => 'Individual Partnership Request Sent Successfully.'
                    ]); 
                }  else {
                    $this->validate($request, [
                        'no_of_vehicles' => ['required', 'numeric'],
                        'nin' => ['required', 'string', 'max:255'],
                        'agreement' => ['required', 'string']
                    ]);
                    BecomePartner::create([
                        'user_id' => Auth::user()->id,
                        'partnership_type' => $request->partnership_type,
                        'vehicle_type' => $request->vehicle_types,
                        'no_of_vehicles' => $request->no_of_vehicles,
                        'nin' => $request->nin,
                        'agreement' => $request->agreement
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => 'Individual Partnership Request Sent Successfully.'
                    ]);
                };
            }

            if($request->partnership_type == 'Corporate')
            {
                if($request->vehicle_types == '')
                {
                    $this->validate($request, [
                        'vehicle_type' => ['required', 'string', 'max:255'],
                        'no_of_vehicles' => ['required', 'numeric'],
                        'company_name' => ['required', 'string', 'max:255'],
                        'company_address' => ['required', 'string', 'max:255'],
                        'cac_number' => ['required', 'string', 'max:255'],
                        'agreement' => ['required', 'string']
                    ]);

                    BecomePartner::create([
                        'user_id' => Auth::user()->id,
                        'partnership_type' => $request->partnership_type,
                        'vehicle_type' => $request->vehicle_type,
                        'no_of_vehicles' => $request->no_of_vehicles,
                        'company_name' => $request->company_name,
                        'company_address' => $request->company_address,
                        'cac_number' => $request->cac_number,
                        'agreement' => $request->agreement
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => 'Corporate Partnership Request Sent Successfully.'
                    ]); 
                } else {
                    $this->validate($request, [
                        'no_of_vehicles' => ['required', 'numeric'],
                        'company_name' => ['required', 'string', 'max:255'],
                        'company_address' => ['required', 'string', 'max:255'],
                        'cac_number' => ['required', 'string', 'max:255'],
                        'agreement' => ['required', 'string']
                    ]);

                    BecomePartner::create([
                        'user_id' => Auth::user()->id,
                        'partnership_type' => $request->partnership_type,
                        'vehicle_type' => $request->vehicle_types,
                        'no_of_vehicles' => $request->no_of_vehicles,
                        'company_name' => $request->company_name,
                        'company_address' => $request->company_address,
                        'cac_number' => $request->cac_number,
                        'agreement' => $request->agreement
                    ]);

                    return back()->with([
                        'type' => 'success',
                        'message' => 'Corporate Partnership Request Sent Successfully.'
                    ]); 
                }
            }

            return back()->with([
                'type' => 'danger',
                'message' => "Partnership Type entered doesn't exist. Please select from our list of Partnership Type."
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => "Request Sent Before, please wait while the admin reviews your request!"
            ]);
        }

    }

    public function manage_become_a_partner()
    {
        $becomePartners = BecomePartner::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.manage-become-a-partner', [
            'becomePartners' => $becomePartners
        ]);
    }

    public function update_partner_fleet_management($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $partnerFleetManagement = BecomePartner::findorfail($finder);

        if($partnerFleetManagement->partnership_type == 'Individual')
        {
            if($request->vehicle_types == '')
            {
                $this->validate($request, [
                    'vehicle_type' => ['required', 'string', 'max:255'],
                    'no_of_vehicles' => ['required', 'string', 'max:255'],
                    'nin' => ['required', 'string', 'max:255'],
                ]);

                $partnerFleetManagement->update([
                    'vehicle_type' => $request->vehicle_type,
                    'no_of_vehicles' => $request->no_of_vehicles,
                    'nin' => $request->nin,
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Updated Successfully!'
                ]); 
            }  else {
                $this->validate($request, [
                    'no_of_vehicles' => ['required', 'string', 'max:255'],
                    'nin' => ['required', 'string', 'max:255'],
                ]);

                $partnerFleetManagement->update([
                    'vehicle_type' => $request->vehicle_types,
                    'no_of_vehicles' => $request->no_of_vehicles,
                    'nin' => $request->nin,
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Updated Successfully!'
                ]); 
            };
        }

        if($partnerFleetManagement->partnership_type == 'Corporate')
        {
            if($request->vehicle_types == '')
            {
                $this->validate($request, [
                    'vehicle_type' => ['required', 'string', 'max:255'],
                    'no_of_vehicles' => ['required', 'string', 'max:255'],
                    'company_name' => ['required', 'string', 'max:255'],
                    'company_address' => ['required', 'string', 'max:255'],
                    'cac_number' => ['required', 'string', 'max:255']
                ]);

                $partnerFleetManagement->update([
                    'vehicle_type' => $request->vehicle_type,
                    'no_of_vehicles' => $request->no_of_vehicles,
                    'company_name' => $request->company_name,
                    'company_address' => $request->company_address,
                    'cac_number' => $request->cac_number,
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Updated Successfully!'
                ]); 
            } else {
                $this->validate($request, [
                    'no_of_vehicles' => ['required', 'string', 'max:255'],
                    'company_name' => ['required', 'string', 'max:255'],
                    'company_address' => ['required', 'string', 'max:255'],
                    'cac_number' => ['required', 'string', 'max:255']
                ]);

                $partnerFleetManagement->update([
                    'vehicle_type' => $request->vehicle_types,
                    'no_of_vehicles' => $request->no_of_vehicles,
                    'company_name' => $request->company_name,
                    'company_address' => $request->company_address,
                    'cac_number' => $request->cac_number,
                ]);

                return back()->with([
                    'type' => 'success',
                    'message' => 'Updated Successfully!'
                ]); 
            }
        }
    }
    
    public function delete_become_partner($id)
    {
        $finder = Crypt::decrypt($id);

        BecomePartner::findorfail($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => "Request Deleted Successfully!",
        ]);
    }

    public function notifications()
    {
        return view('dashboard.notifications');
    }

    public function transactions()
    {
        return view('dashboard.transactions');
    }

    public function help_support()
    {
        return view('dashboard.help-support');
    }

    public function referrals()
    {
        $referrals = Referee::latest()->where('referrer_id', Auth::user()->id)->get();

        return view('dashboard.referrals',[
            'referrals' => $referrals
        ]);
    }

    public function settings()
    {
        return view('dashboard.settings');
    }

    public function update_password( Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::findorfail(Auth::user()->id);
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Password Updated Successfully.'
        ]); 
    }

    public function update_profile(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
        ]);

        $user = User::findorfail(Auth::user()->id);

        if($user->email == $request->email)
        {
            $user->update([
                'name' => $request->name,
                'sex' => $request->sex,
                'phone_number' => $request->phone_number,
            ]); 
        } else {
            //Validate Request
            $this->validate($request, [
                'email' => ['string', 'email', 'max:255', 'unique:users'],
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'sex' => $request->sex
            ]); 
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function upload_profile_picture(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpeg,png,jpg',
        ]);

        $user = User::findorfail(Auth::user()->id);

        $filename = request()->avatar->getClientOriginalName();
        if($user->photo) {
            Storage::delete(str_replace("storage", "public", $user->photo));
        }
        request()->avatar->storeAs('users_avatar', $filename, 'public');
        $user->photo = '/storage/users_avatar/'.$filename;
        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Profile Picture Uploaded Successfully!'
        ]);
    }
}