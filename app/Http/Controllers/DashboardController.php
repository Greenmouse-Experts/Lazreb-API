<?php

namespace App\Http\Controllers;

use App\Models\BecomePartner;
use App\Models\CharterVehicle;
use App\Models\HireVehicle;
use App\Models\LeaseVehicle;
use App\Models\Notification;
use App\Models\Referee;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

        $transactions = Transaction::latest()->where('user_id', Auth::user()->id)->take(3)->get();
        $notifications = Notification::latest()->where('to', Auth::user()->id)->take(5)->get();

        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.dashboard', [
            'services' => $services,
            'userRequestServices' => $userRequestServices,
            'referrals' => $referrals,
            'partnerFleetManagement' => $partnerFleetManagement,
            'transactions' => $transactions,
            'notifications' => $notifications,
            'countUnreadNotifications' => $countUnreadNotifications,
            'unreadNotifications' => $unreadNotifications
        ]);
    }
    
    public function request_services()
    {
        $services = Service::latest()->get();
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();


        return view('dashboard.request-services', [
            'services' => $services,
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
    }

    public function get_service($id)
    {
        $finder = Crypt::decrypt($id);

        $service = Service::findorfail($finder);
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.get-service', [
            'service' => $service,
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
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
                'start_date' => ['required', 'date', 'after:tomorrow'],
                'return_date' => ['required', 'date', 'after:start_date'],
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
                'start_date' => ['required', 'date', 'after:tomorrow'],
                'return_date' => ['required', 'date', 'after:start_date'],
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
            $request->validate([
                'name' => 'required|string|max:244|min:1',
                'vehicle_type' => 'required|string|max:244|min:1',
                'lease_duration' => 'required|string|max:244|min:1',
                'purpose_of_use' => 'required|string|max:244|min:1',
                'location_of_use' => 'required|string|max:244|min:1',
                'agreement' => 'required|string|max:244|min:1',
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
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.my-requests', [
            'services' => $services,
            'partnerFleetManagement' => $partnerFleetManagement,
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
    }

    public function view_my_requests($id)
    {
        $finder = Crypt::decrypt($id);

        $service = Service::findorfail($finder);
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.view-my-requests', [
            'service' => $service,
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
    }

    public function update_hire_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $hirevehicle = HireVehicle::findorfail($finder);

        $this->validate($request, [
            'pick_up_address' => ['required', 'string', 'max:255'],
            'drop_off_address' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'after:tomorrow'],
            'return_date' => ['required', 'date', 'after:start_date'],
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

    public function hire_vehicle_upload_transaction_slip($id, Request $request)
    {
        $this->validate($request, [
            'slip' => 'required|mimes:jpeg,png,jpg',
            'description' => ['required', 'string', 'max:255'],
        ]);

        $finder = Crypt::decrypt($id);

        $service = HireVehicle::findorfail($finder);

        $filename = request()->slip->getClientOriginalName();

        request()->slip->storeAs('users_transaction_slip', $filename, 'public');

        Transaction::create([
            'user_id' => Auth::user()->id,
            'slip' => '/storage/users_transaction_slip/'.$filename,
            'description' => $request->description
        ]);

        $service->update([
            'paid_status' => 'Uploaded Payment Slip'
        ]);

        $admin = User::where('account_type', 'Administrator')->first();

        $message = new Notification();
        $message->from = Auth::user()->id;
        $message->to = $admin->id;
        $message->subject = 'Payment on Hire A Vehicle Request';
        $message->message = Auth::user()->name.', made a payment and uploaded the payment slip.';
        $message->save();

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $admin->name,
            'email' => $admin->email
        );
        
        /** Send message to the user */
        Mail::send('emails.notification', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });

        return back()->with([
            'type' => 'success',
            'message' => 'Transaction slip uploaded successfully.'
        ]); 
    }

    public function update_charter_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $chartervehicle = CharterVehicle::findorfail($finder);

        $this->validate($request, [
            'pick_up_address' => ['required', 'string', 'max:255'],
            'drop_off_address' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'after:tomorrow'],
            'return_date' => ['required', 'date', 'after:start_date'],
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

    public function charter_vehicle_upload_transaction_slip($id, Request $request)
    {
        $this->validate($request, [
            'slip' => 'required|mimes:jpeg,png,jpg',
            'description' => ['required', 'string', 'max:255'],
        ]);

        $finder = Crypt::decrypt($id);

        $service = CharterVehicle::findorfail($finder);

        $filename = request()->slip->getClientOriginalName();

        request()->slip->storeAs('users_transaction_slip', $filename, 'public');

        Transaction::create([
            'user_id' => Auth::user()->id,
            'slip' => '/storage/users_transaction_slip/'.$filename,
            'description' => $request->description
        ]);

        $service->update([
            'paid_status' => 'Uploaded Payment Slip'
        ]);

        $admin = User::where('account_type', 'Administrator')->first();

        $message = new Notification();
        $message->from = Auth::user()->id;
        $message->to = $admin->id;
        $message->subject = 'Payment on Charter A Vehicle Request';
        $message->message = Auth::user()->name.', made a payment and uploaded the payment slip.';
        $message->save();

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $admin->name,
            'email' => $admin->email
        );
        
        /** Send message to the user */
        Mail::send('emails.notification', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });
        
        return back()->with([
            'type' => 'success',
            'message' => 'Transaction slip uploaded successfully.'
        ]); 
    }

    public function update_lease_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $leaseVehicle = LeaseVehicle::findorfail($finder);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'vehicle_type' => ['required', 'string', 'max:255'],
            'lease_duration' => ['required', 'string', 'max'],
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

    public function lease_vehicle_upload_transaction_slip($id, Request $request)
    {
        $this->validate($request, [
            'slip' => 'required|mimes:jpeg,png,jpg',
            'description' => ['required', 'string', 'max:255'],
        ]);

        $finder = Crypt::decrypt($id);

        $service = LeaseVehicle::findorfail($finder);

        $filename = request()->slip->getClientOriginalName();

        request()->slip->storeAs('users_transaction_slip', $filename, 'public');

        Transaction::create([
            'user_id' => Auth::user()->id,
            'slip' => '/storage/users_transaction_slip/'.$filename,
            'description' => $request->description
        ]);

        $service->update([
            'paid_status' => 'Uploaded Payment Slip'
        ]);

        $admin = User::where('account_type', 'Administrator')->first();

        $message = new Notification();
        $message->from = Auth::user()->id;
        $message->to = $admin->id;
        $message->subject = 'Payment on Lease A Vehicle Request';
        $message->message = Auth::user()->name.', made a payment and uploaded the payment slip.';
        $message->save();

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $admin->name,
            'email' => $admin->email
        );
        
        /** Send message to the user */
        Mail::send('emails.notification', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });
        
        return back()->with([
            'type' => 'success',
            'message' => 'Transaction slip uploaded successfully.'
        ]); 
    }

    public function become_a_partner()
    {
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.become-a-partner', [
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
    }

    public function post_become_partner(Request $request)
    {
        $allBecomePartner = BecomePartner::where('user_id', Auth::user()->id)->where('status', 'Approved')
                                ->orwhere('status', 'Pending')->get();

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
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.manage-become-a-partner', [
            'becomePartners' => $becomePartners,
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
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
        $allNotifications = Notification::latest()->where('to', Auth::user()->id)->get();
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.notifications', [
            'allNotifications' => $allNotifications,
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
    }

    public function read_notification($id)
    {   
        $finder = Crypt::decrypt($id);

        $notification = Notification::findorfail($finder);

        $notification->status = 'Read';
        $notification->save();

        return back();
    }

    public function transactions()
    {
        $transactions = Transaction::latest()->where('user_id', Auth::user()->id)->get();
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.transactions', [
            'transactions' => $transactions,
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
    }

    public function help_support()
    {
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.help-support', [
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
    }

    public function referrals()
    {
        $referrals = Referee::latest()->where('referrer_id', Auth::user()->id)->get();
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.referrals',[
            'referrals' => $referrals,
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
    }

    public function settings()
    {
        $unreadNotifications =  Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->take(5)->get();
        $countUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return view('dashboard.settings', [
            'unreadNotifications' => $unreadNotifications,
            'countUnreadNotifications' => $countUnreadNotifications
        ]);
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