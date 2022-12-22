<?php

namespace App\Http\Controllers;

use App\Models\BecomePartner;
use App\Models\Referee;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function post_partner_fleet_management(Request $request)
    {
        $allBecomePartner = BecomePartner::where('user_id', Auth::user()->id)->get();

        if($allBecomePartner->isEmpty())
        {
            if($request->partnership_type == 'Individual')
            {
                // if($request->vehicle_types == '')
                // {
                    $validator = Validator::make(request()->all(), [
                        'vehicle_type' => ['required', 'string', 'max:255'],
                        'no_of_vehicles' => ['required', 'string', 'max:255'],
                        'nin' => ['required', 'string', 'max:255'],
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
                        'no_of_vehicles' => ['required', 'string', 'max:255'],
                        'company_name' => ['required', 'string', 'max:255'],
                        'company_address' => ['required', 'string', 'max:255'],
                        'cac_number' => ['required', 'string', 'max:255'],
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

    public function get_partner_fleet_management()
    {
        $partnerFleetManagement = BecomePartner::latest()->where('user_id', Auth::user()->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Partner Fleet Management Retrieved Successfully!',
            'data' => $partnerFleetManagement
        ]);
    }

    public function update_partner_fleet_management($id, Request $request)
    {
        $partnerFleetManagement = BecomePartner::findorfail($id);

        if($partnerFleetManagement->partnership_type == 'Individual')
        {
            // if($request->vehicle_types == '')
            // {
                $validator = Validator::make(request()->all(), [
                    'vehicle_type' => ['required', 'string', 'max:255'],
                    'no_of_vehicles' => ['required', 'string', 'max:255'],
                    'nin' => ['required', 'string', 'max:255'],
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
                    'company_name' => ['required', 'string', 'max:255'],
                    'company_address' => ['required', 'string', 'max:255'],
                    'cac_number' => ['required', 'string', 'max:255']
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
            'message' => 'Request not completed, accepts only when the request sent is pending.',
        ]);
        
    }

    public function referrals()
    {
        $referrals = Referee::latest()->where('referrer_id', Auth::user()->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'My downlines Retrieved',
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

    public function get_all_services()
    {
        $services = Service::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'All Services Retrieved',
            'data' => $services
        ]);
    }
}
