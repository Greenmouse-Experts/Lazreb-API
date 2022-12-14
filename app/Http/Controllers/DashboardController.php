<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if($user->avatar) {
            Storage::delete(str_replace("storage", "public", $user->avatar));
        }
        request()->avatar->storeAs('users_avatar', $filename, 'public');
        $user->avatar = '/storage/users_avatar/'.$filename;
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
