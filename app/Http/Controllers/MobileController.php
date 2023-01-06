<?php

namespace App\Http\Controllers;

use App\Models\Annoucement;
use App\Models\BecomePartner;
use App\Models\CharterVehicle;
use App\Models\HireVehicle;
use App\Models\LeaseVehicle;
use App\Models\Notification;
use App\Models\Referee;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class MobileController extends Controller
{
    /**
     * Logout user.
     *
     * @return json
     */
    public function logout()
    {
        $access_token = auth()->user()->token();

        // logout from only current device
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($access_token->id);

        // use this method to logout from all devices
        $refreshTokenRepository = app(RefreshTokenRepository::class);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($access_token->id);

        return response()->json([
            'success' => true,
            'message' => 'User logout successfully.'
        ], 200);
    }

    public function post_request_services($id, Request $request)
    {
        $service = Service::findorfail($id);

        if($service->name == 'Hire A Vehicle')
        {            
            $validator = Validator::make(request()->all(), [
                'pick_up_address' => ['required', 'string', 'max:255'],
                'drop_off_address' => ['required', 'string', 'max:255'],
                'start_date' => ['required', 'date', 'after:tomorrow'],
                // 'return_date' => ['required', 'date', 'after:start_date'],
                'start_time' => ['required', 'date_format:H:i'],
                // 'return_time' => ['required', 'date_format:H:i'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'price' => ['required', 'string', 'max:255'],
                'purpose_of_use' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'string', 'max:255'],
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }

            $hireVehicle = HireVehicle::create([
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

            return response()->json([
                'success' => true,
                'message' => 'Your request to hire a vehicle has been submitted successfully, kindly check back while the admin reviews your request. Thank you.',
                'data' => $hireVehicle
            ]);
        }

        if($service->name == 'Charter A Vehicle')
        {
            $validator = Validator::make(request()->all(), [
                'pick_up_address' => ['required', 'string', 'max:255'],
                'drop_off_address' => ['required', 'string', 'max:255'],
                'start_date' => ['required', 'date', 'after:tomorrow'],
                // 'return_date' => ['required', 'date', 'after:start_date'],
                'start_time' => ['required', 'date_format:H:i'],
                // 'return_time' => ['required', 'date_format:H:i'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'charter_type' => ['required', 'string', 'max:255'],
                'purpose_of_use' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'string', 'max:255'],
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }
            
            $charterVehicle = CharterVehicle::create([
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
            
            return response()->json([
                'success' => true,
                'message' => 'Your request to charter a vehicle has been submitted successfully, kindly check back while the admin reviews your request. Thank you.',
                'data' => $charterVehicle
            ]);
        }

        if($service->name == 'Lease A Vehicle')
        {
            $validator = Validator::make(request()->all(), [
                'name' => ['required', 'string', 'max:255'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'lease_duration' => ['required', 'string', 'max:255'],
                'purpose_of_use' => ['required', 'string', 'max:255'],
                'location_of_use' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'string', 'max:255'],
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }
            
            $leaseVehicle = LeaseVehicle::create([
                'user_id' => Auth::user()->id,
                'service_id' => $service->id,
                'name' => $request->name,
                'vehicle_type' => $request->vehicle_type,
                'lease_duration' => $request->lease_duration,
                'purpose_of_use' => $request->purpose_of_use,
                'location_of_use' => $request->location_of_use,
                'agreement' => $request->agreement,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your request to lease a vehicle has been submitted successfully, kindly check back while the admin reviews your request. Thank you.',
                'data' => $leaseVehicle
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Service Unavailable.',
        ]);

    }

    public function post_partner_fleet_management(Request $request)
    {
        $allBecomePartner = BecomePartner::where('user_id', Auth::user()->id)->where('status', 'Approved')
                                ->orwhere('status', 'Pending')->get();

        $validator = Validator::make(request()->all(), [
            'partnership_type' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        if($allBecomePartner->isEmpty())
        {
            if($request->partnership_type == 'Individual')
            {
                // if($request->vehicle_types == '')
                // {
                    $validator = Validator::make(request()->all(), [
                        'vehicle_type' => ['required', 'string', 'max:255'],
                        'no_of_vehicles' => ['required', 'numeric'],
                        // 'nin' => ['required', 'string', 'max:255'],
                        'agreement' => ['required', 'string']
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Please see errors parameter for all errors.',
                            'errors' => $validator->errors()
                        ]);
                    }

                    $partnerFleetManagement = BecomePartner::create([
                        'user_id' => Auth::user()->id,
                        'partnership_type' => $request->partnership_type,
                        'vehicle_type' => $request->vehicle_type,
                        'no_of_vehicles' => $request->no_of_vehicles,
                        'nin' => $request->nin,
                        'agreement' => $request->agreement
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Individual Partnership Request Sent Successfully.',
                        'data' => $partnerFleetManagement
                    ]);

                // }  else {
                //     $this->validate($request, [
                //         'no_of_vehicles' => ['required', 'string', 'max:255'],
                //         'nin' => ['required', 'string', 'max:255'],
                //         'agreement' => ['required', 'string']
                //     ]);
                //     BecomePartner::create([
                //         'user_id' => Auth::user()->id,
                //         'partnership_type' => $request->partnership_type,
                //         'vehicle_type' => $request->vehicle_types,
                //         'no_of_vehicles' => $request->no_of_vehicles,
                //         'nin' => $request->nin,
                //         'agreement' => $request->agreement
                //     ]);

                //     return back()->with([
                //         'type' => 'success',
                //         'message' => 'Individual Partnership Request Sent Successfully.'
                //     ]);
                // };
            }

            if($request->partnership_type == 'Corporate')
            {
                // if($request->vehicle_types == '')
                // {
                    $validator = Validator::make(request()->all(), [
                        'vehicle_type' => ['required', 'string', 'max:255'],
                        'no_of_vehicles' => ['required', 'numeric'],
                        // 'company_name' => ['required', 'string', 'max:255'],
                        'company_address' => ['required', 'string', 'max:255'],
                        // 'cac_number' => ['required', 'string', 'max:255'],
                        'agreement' => ['required', 'string']
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Please see errors parameter for all errors.',
                            'errors' => $validator->errors()
                        ]);
                    }

                    $partnerFleetManagement = BecomePartner::create([
                        'user_id' => Auth::user()->id,
                        'partnership_type' => $request->partnership_type,
                        'vehicle_type' => $request->vehicle_type,
                        'no_of_vehicles' => $request->no_of_vehicles,
                        'company_name' => $request->company_name,
                        'company_address' => $request->company_address,
                        'cac_number' => $request->cac_number,
                        'agreement' => $request->agreement
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Corporate Partnership Request Sent Successfully.',
                        'data' => $partnerFleetManagement
                    ]);
                // } else {
                //     $this->validate($request, [
                //         'no_of_vehicles' => ['required', 'string', 'max:255'],
                //         'company_name' => ['required', 'string', 'max:255'],
                //         'company_address' => ['required', 'string', 'max:255'],
                //         'cac_number' => ['required', 'string', 'max:255'],
                //         'agreement' => ['required', 'string']
                //     ]);

                //     BecomePartner::create([
                //         'user_id' => Auth::user()->id,
                //         'partnership_type' => $request->partnership_type,
                //         'vehicle_type' => $request->vehicle_types,
                //         'no_of_vehicles' => $request->no_of_vehicles,
                //         'company_name' => $request->company_name,
                //         'company_address' => $request->company_address,
                //         'cac_number' => $request->cac_number,
                //         'agreement' => $request->agreement
                //     ]);

                //     return back()->with([
                //         'type' => 'success',
                //         'message' => 'Corporate Partnership Request Sent Successfully.'
                //     ]); 
                // }
            }

            return response()->json([
                'success' => false,
                'message' => "Partnership Type entered doesn't exist. Please select from our list of Partnership Type.",
            ]);
            
        } else {
            return response()->json([
                'success' => false,
                'message' => "Request Sent Before, please wait while the admin reviews your request!",
            ]);
        }

    }

    public function my_requests_hire_vehicle()
    {
        $hireService = HireVehicle::latest()->where('user_id', Auth::user()->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'My Hire Vehicle Requests Retrieved Successfully.',
            'data' => $hireService
        ]);
    }

    public function my_requests_hire_vehicle_count()
    {
        $countHireService = HireVehicle::latest()->where('user_id', Auth::user()->id)->get()->count();

        return response()->json([
            'success' => true,
            'message' => 'Count My Hire Vehicle Requests.',
            'data' => $countHireService
        ]);
    }

    public function my_requests_charter_vehicle()
    {
        $charterService = CharterVehicle::latest()->where('user_id', Auth::user()->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'My Charter Vehicle Requests Retrieved Successfully.',
            'data' => $charterService
        ]);
    }

    public function my_requests_charter_vehicle_count()
    {
        $countCharterService = CharterVehicle::latest()->where('user_id', Auth::user()->id)->get()->count();

        return response()->json([
            'success' => true,
            'message' => 'Count My Charter Vehicle Requests.',
            'data' => $countCharterService
        ]);
    }

    public function my_requests_lease_vehicle()
    {
        $leaseService =  LeaseVehicle::latest()->where('user_id', Auth::user()->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'My Lease Vehicle Requests Retrieved Successfully.',
            'data' => $leaseService
        ]);
    }

    public function my_requests_lease_vehicle_count()
    {
        $countLeaseService = LeaseVehicle::where('user_id', Auth::user()->id)->get()->count();

        return response()->json([
            'success' => true,
            'message' => 'Count My Lease Vehicle Requests.',
            'data' => $countLeaseService
        ]);
    }

    public function my_requests_partner_fleet_management()
    {
        $partnerFleetManagement = BecomePartner::latest()->where('user_id', Auth::user()->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'My Partner Fleet Management Requests Retrieved Successfully.',
            'data' => $partnerFleetManagement
        ]);
    }

    public function my_requests_partner_fleet_management_count()
    {
        $countPartnerFleetManagement = BecomePartner::where('user_id', Auth::user()->id)->get()->count();

        return response()->json([
            'success' => true,
            'message' => 'Count My Partner Fleet Management Requests.',
            'data' => $countPartnerFleetManagement
        ]);
    }

    public function update_hire_vehicle($id, Request $request)
    {
        $hirevehicle = HireVehicle::findorfail($id);

        if($hirevehicle->status == 'Pending')
        {
            $validator = Validator::make(request()->all(), [
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
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }
            
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

            return response()->json([
                'success' => true,
                'message' => 'Request Updated Successfully!',
                'data' => $hirevehicle
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Request not completed, it accepts only when the request sent is pending.',
        ]);
    }

    public function delete_hire_vehicle($id)
    {
        $hire = HireVehicle::findorfail($id);

        if($hire->status == 'Pending')
        {
            $hire->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Request Deleted Successfully!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Request not completed, it accepts only when the request sent is pending.',
        ]);
    }

    public function upload_hire_vehicle($id, Request $request)
    {
        $input = $request->only(['slip', 'description']);

        $validate_data = [
            'slip' => 'required|mimes:jpeg,png,jpg',
            'description' => ['required', 'string', 'max:255'],
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }
        
        $service = HireVehicle::findorfail($id);

        $filename = request()->slip->getClientOriginalName();

        request()->slip->storeAs('users_transaction_slip', $filename, 'public');

        $transaction = Transaction::create([
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

        return response()->json([
            'success' => true,
            'message' => 'Transaction uploaded successfully.',
            'data' => $transaction
        ]);
    }

    public function update_charter_vehicle($id, Request $request)
    {
        $chartervehicle = CharterVehicle::findorfail($id);

        if($chartervehicle->status == 'Pending')
        {
            $validator = Validator::make(request()->all(), [
                'pick_up_address' => ['required', 'string', 'max:255'],
                'drop_off_address' => ['required', 'string', 'max:255'],
                'start_date' => ['required', 'date', 'after:tomorrow'],
                // 'return_date' => ['required', 'date', 'after:start_date'],
                'start_time' => ['required', 'date_format:H:i'],
                // 'return_time' => ['required', 'date_format:H:i'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'charter_type' => ['required', 'string', 'max:255'],
                'purpose_of_use' => ['required', 'string', 'max:255'],
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }
            
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

            return response()->json([
                'success' => true,
                'message' => 'Request Updated Successfully!',
                'data' => $chartervehicle
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Request not completed, it accepts only when the request sent is pending.',
        ]);
    }

    public function delete_charter_vehicle($id)
    {
        $charter = CharterVehicle::findorfail($id);

        if($charter->status == 'Pending')
        {
            $charter->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Request Deleted Successfully!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Request not completed, it accepts only when the request sent is pending.',
        ]);
    }

    public function upload_charter_vehicle($id, Request $request)
    {
        $input = $request->only(['slip', 'description']);

        $validate_data = [
            'slip' => 'required|mimes:jpeg,png,jpg',
            'description' => ['required', 'string', 'max:255'],
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }
        
        $service = CharterVehicle::findorfail($id);

        $filename = request()->slip->getClientOriginalName();

        request()->slip->storeAs('users_transaction_slip', $filename, 'public');

        $transaction = Transaction::create([
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

        return response()->json([
            'success' => true,
            'message' => 'Transaction uploaded successfully.',
            'data' => $transaction
        ]);
    }

    public function update_lease_vehicle($id, Request $request)
    {
        $leaseVehicle = LeaseVehicle::findorfail($id);

        if($leaseVehicle->status == 'Pending')
        {
            $validator = Validator::make(request()->all(), [
                'name' => ['required', 'string', 'max:255'],
                'vehicle_type' => ['required', 'string', 'max:255'],
                'lease_duration' => ['required', 'string', 'max:255'],
                'purpose_of_use' => ['required', 'string', 'max:255'],
                'location_of_use' => ['required', 'string', 'max:255'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }
            
            $leaseVehicle->update([
                'name' => $request->name,
                'vehicle_type' => $request->vehicle_type,
                'lease_duration' => $request->lease_duration,
                'purpose_of_use' => $request->purpose_of_use,
                'location_of_use' => $request->location_of_use,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Request Updated Successfully!',
                'data' => $leaseVehicle
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Request not completed, it accepts only when the request sent is pending.',
        ]);
    }

    public function delete_lease_vehicle($id)
    {
        $lease = LeaseVehicle::findorfail($id);

        if($lease->status == 'Pending')
        {
            $lease->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Request Deleted Successfully!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Request not completed, it accepts only when the request sent is pending.',
        ]);
    }

    public function upload_lease_vehicle($id, Request $request)
    {
        $input = $request->only(['slip', 'description']);

        $validate_data = [
            'slip' => 'required|mimes:jpeg,png,jpg',
            'description' => ['required', 'string', 'max:255'],
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }
        
        $service = LeaseVehicle::findorfail($id);

        $filename = request()->slip->getClientOriginalName();

        request()->slip->storeAs('users_transaction_slip', $filename, 'public');

        $transaction = Transaction::create([
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

        return response()->json([
            'success' => true,
            'message' => 'Transaction uploaded successfully.',
            'data' => $transaction
        ]);
    }

    public function update_partner_fleet_management($id, Request $request)
    {
        $partnerFleetManagement = BecomePartner::findorfail($id);

        if($partnerFleetManagement->status == 'Pending')
        {
            if($partnerFleetManagement->partnership_type == 'Individual')
            {
                // if($request->vehicle_types == '')
                // {
                    $validator = Validator::make(request()->all(), [
                        'vehicle_type' => ['required', 'string', 'max:255'],
                        'no_of_vehicles' => ['required', 'string', 'max:255'],
                        // 'nin' => ['required', 'string', 'max:255'],
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Please see errors parameter for all errors.',
                            'errors' => $validator->errors()
                        ]);
                    }

                    $partnerFleetManagement->update([
                        'vehicle_type' => $request->vehicle_type,
                        'no_of_vehicles' => $request->no_of_vehicles,
                        'nin' => $request->nin,
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Request Updated Successfully!',
                        'data' => $partnerFleetManagement
                    ]);
                // }  else {
                //     $this->validate($request, [
                //         'no_of_vehicles' => ['required', 'string', 'max:255'],
                //         'nin' => ['required', 'string', 'max:255'],
                //     ]);

                //     $partnerFleetManagement->update([
                //         'vehicle_type' => $request->vehicle_types,
                //         'no_of_vehicles' => $request->no_of_vehicles,
                //         'nin' => $request->nin,
                //     ]);

                //     return back()->with([
                //         'type' => 'success',
                //         'message' => 'Updated Successfully!'
                //     ]); 
                // };
            }

            if($partnerFleetManagement->partnership_type == 'Corporate')
            {
                // if($request->vehicle_types == '')
                // {
                    $validator = Validator::make(request()->all(), [
                        'vehicle_type' => ['required', 'string', 'max:255'],
                        'no_of_vehicles' => ['required', 'string', 'max:255'],
                        // 'company_name' => ['required', 'string', 'max:255'],
                        'company_address' => ['required', 'string', 'max:255'],
                        // 'cac_number' => ['required', 'string', 'max:255']
                    ]);
            
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Please see errors parameter for all errors.',
                            'errors' => $validator->errors()
                        ]);
                    }

                    $partnerFleetManagement->update([
                        'vehicle_type' => $request->vehicle_type,
                        'no_of_vehicles' => $request->no_of_vehicles,
                        'company_name' => $request->company_name,
                        'company_address' => $request->company_address,
                        'cac_number' => $request->cac_number,
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Request Updated Successfully!',
                        'data' => $partnerFleetManagement
                    ]);

                // } else {
                //     $this->validate($request, [
                //         'no_of_vehicles' => ['required', 'string', 'max:255'],
                //         'company_name' => ['required', 'string', 'max:255'],
                //         'company_address' => ['required', 'string', 'max:255'],
                //         'cac_number' => ['required', 'string', 'max:255']
                //     ]);

                //     $partnerFleetManagement->update([
                //         'vehicle_type' => $request->vehicle_types,
                //         'no_of_vehicles' => $request->no_of_vehicles,
                //         'company_name' => $request->company_name,
                //         'company_address' => $request->company_address,
                //         'cac_number' => $request->cac_number,
                //     ]);

                //     return response()->json([
                //         'success' => true,
                //         'message' => 'Request Updated Successfully!',
                //         'data' => $partnerFleetManagement
                //     ]);
                // }
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Request not completed, it accepts only when the request sent is pending.',
        ]);
    }
    
    public function delete_partner_fleet_management($id)
    {
        $partner = BecomePartner::findorfail($id);

        if($partner->status == 'Pending')
        {
            $partner->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Request Deleted Successfully!',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Request not completed, it accepts only when the request sent is pending.',
        ]);
        
    }

    public function transactions()
    {
        $transactions = Transaction::latest()->where('user_id', Auth::user()->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'My Transactions Retrieved',
            'data' => $transactions
        ]);
    }

    public function referrals()
    {
        $referrals = Referee::join('users', 'users.id', '=', 'referees.referee_id')
                    ->latest()->where('referees.referrer_id', Auth::user()->id)
                    ->get(['users.name', 'users.email', 'referees.bonus', 'referees.created_at']);

        return response()->json([
            'success' => true,
            'message' => 'My Downlines Retrieved',
            'data' => $referrals
        ]);
    }
    
    public function update_profile(Request $request)
    {
        $input = $request->only(['name', 'sex', 'phone_number']);

        $validate_data = [
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        $user = User::findorfail(Auth::user()->id);
        
        if($user->email == $request->email)
        {
            $user->update([
                'name' => $request->name,
                'sex' => $request->sex,
                'phone_number' => $request->phone_number
            ]); 
        } else {
            //Validate Request
            $validator = Validator::make(request()->all(), [
                'email' => ['string', 'email', 'max:255', 'unique:users'],
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }

            $user->update([
                'email' => $request->email,
                'name' => $request->name,
                'sex' => $request->sex,
                'phone_number' => $request->phone_number
            ]); 
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile Updated Successfully',
            'data' => $user
        ]);
    }

    public function update_password(Request $request)
    {
        $input = $request->only(['new_password', 'new_password_confirmation']);

        $validate_data = [
            'new_password' => ['required', 'string', 'min:8', 'confirmed']
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }
        
        $user = User::findorfail(Auth::user()->id);
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Password Updated Successfully',
            'data' => $user
        ]);
    }

    public function upload_profile_picture(Request $request) 
    {
        $input = $request->only(['avatar']);

        $validate_data = [
            'avatar' => 'required|mimes:jpeg,png,jpg',
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        //User
        $user = User::findorfail(Auth::user()->id);

        $filename = request()->avatar->getClientOriginalName();
        if($user->photo) {
            Storage::delete(str_replace("storage", "public", $user->photo));
        }
        request()->avatar->storeAs('users_avatar', $filename, 'public');
        $user->photo = '/storage/users_avatar/'.$filename;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile Picture Uploaded Successfully!',
            'data' => $user
        ]);
    }

    public function get_profile()
    {
        $user = User::findorfail(Auth::user()->id);

        return response()->json([
            'success' => true,
            'message' => 'Profile Retrieved!',
            'data' => $user
        ]);
    }

    public function get_all_services()
    {
        $services = Service::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'All Services Retrieved',
            'data' => $services
        ]);
    }

    public function get_all_vehicle_type()
    {
        $vehicleType = VehicleType::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'All Vehicle Type Retrieved',
            'data' => $vehicleType
        ]);
    }

    public function get_all_notifications()
    {
        $userNotifications = Notification::join('users', 'notifications.from', '=', 'users.id')
                            ->latest()->where('to', Auth::user()->id)
                            ->get(['users.name','users.account_type', 'notifications.*']);

        return response()->json([
            'success' => true,
            'message' => 'All Notifications Retrieved!',
            'data' => $userNotifications
        ]);
    }

    public function get_all_unread_notifications()
    {
        $userUnreadNotifications = Notification::join('users', 'notifications.from', '=', 'users.id')
                ->latest()->where('to', Auth::user()->id)->where('notifications.status', 'Unread')->take(5)
                ->get(['users.name','users.account_type', 'notifications.*']);

        return response()->json([
            'success' => true,
            'message' => 'All Unread Notifications Retrieved!',
            'data' => $userUnreadNotifications
        ]);
    }

    public function count_unread_notifications()
    {
        $userCountUnreadNotifications = Notification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->count();

        return response()->json([
            'success' => true,
            'message' => 'All Unread Notifications Retrieved!',
            'data' => $userCountUnreadNotifications
        ]);

    }

    public function read_notification($id)
    {
        $notification = Notification::findorfail($id);

        $notification->status = 'Read';
        $notification->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification Read Successfully'
        ]);
    }

    public function get_promo_annoucement_first()
    {
        $annoucement = Annoucement::latest()->first();

        return response()->json([
            'success' => true,
            'message' => 'Retrieve The Latest First Promo/Annoucement',
            'data' => $annoucement
        ]);
    }

    public function get_all_promo_annoucement()
    {
        $annoucement = Annoucement::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'All Promo/Announcement Retrieved',
            'data' => $annoucement
        ]);
    }
}
