<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordCode;
use App\Mail\VerificationCode;
use App\Models\Referee;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Register user.
     *
     * @return json
     */

    public function log()
    {
        return view('auth.log-in');
    }

    public function sign()
    {
        if (request()->has('ref')) {
            session(['referrer' => request()->query('ref')]);
        }

        $referrer = User::wherereferral_code(session()->pull('referrer'))->first();
        $referrer_id = $referrer ? $referrer->referral_code : null;

        return view('auth.sign-up', compact('referrer_id'));
    }


    public function forgot()
    {
        return view('auth.forgot');
    }

    public function admin()
    {
        return view('auth.admin_login');
    }

    public function register(Request $request)
    {
        if( $request->is('api/*')){
            $validator = Validator::make(request()->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'sex' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }
    
            if ($request->referrer_code == null) {
                $user = User::create([
                    'account_type' => 'User',
                    'referral_code' => $this->referrer_id_generate(7),
                    'name' => ucfirst($request->name),
                    'email' => $request->email,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'agreement' => $request->agreement,
                    'password' => Hash::make($request->password)
                ]);
            } else {
                $validator = Validator::make(request()->all(), [
                    'referrer_code' => 'exists:users,referral_code'
                ]);
    
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please see errors parameter for all errors.',
                        'errors' => $validator->errors()
                    ]);
                }
    
                $referrerId = User::where('referral_code', $request->referrer_code)->first();
    
                $user = User::create([
                    'account_type' => 'User',
                    'referral_code' => $this->referrer_id_generate(7),
                    'name' => ucfirst($request->name),
                    'email' => $request->email,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'agreement' => $request->agreement,
                    'password' => Hash::make($request->password),
                    'referrer_id' => $referrerId->id
                ]);
    
                Referee::create([
                    'referee_id' => $user->id,
                    'referrer_id' => $referrerId->id,
                ]);
            }
            $code = mt_rand(1000, 9999);
    
            $user->update([
                'code' => $code
            ]);
    
            // Send verification code to user
            Mail::to($user->email)->send(new VerificationCode($user->code));
    
            return response()->json([
                'success' => true,
                'message' => 'Registration Successfully, Please check your email for a verification code',
                'data' => $user
            ]);
        } else {

            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'sex' => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'string', 'max:255'],
                'agreement' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            if ($request->referrer_code == null) {
                $user = User::create([
                    'account_type' => 'User',
                    'referral_code' => $this->referrer_id_generate(7),
                    'name' => ucfirst($request->name),
                    'email' => $request->email,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'agreement' => $request->agreement,
                    'password' => Hash::make($request->password)
                ]);
            } else {
                $this->validate($request, [
                    'referrer_code' => 'exists:users,referral_code'
                ]);
    
                $referrerId = User::where('referral_code', $request->referrer_code)->first();
    
                $user = User::create([
                    'account_type' => 'User',
                    'referral_code' => $this->referrer_id_generate(7),
                    'name' => ucfirst($request->name),
                    'email' => $request->email,
                    'sex' => $request->sex,
                    'phone_number' => $request->phone_number,
                    'agreement' => $request->agreement,
                    'password' => Hash::make($request->password),
                    'referrer_id' => $referrerId->id
                ]);
    
                Referee::create([
                    'referee_id' => $user->id,
                    'referrer_id' => $referrerId->id,
                ]);
            }
    
            $code = mt_rand(1000, 9999);
    
            $user->update([
                'code' => $code
            ]);
    
            // Send verification code to user
            Mail::to($user->email)->send(new VerificationCode($user->code));
    
            return redirect()->route('verify.account', Crypt::encrypt($user->email))->with([
                'type' => 'success',
                'message' => 'Registration Successful, Please verify your account!'
            ]); 
        }
    }

    function referrer_id_generate($input, $strength = 7)
    {
        $input = '0123456789';
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public function verify_account($email)
    {
        $userFinder = Crypt::decrypt($email);

        $user = User::where('email', $userFinder)->first();

        return view('auth.verify_account', [
            'user' => $user
        ]);
    }

    public function registerConfirm(Request $request)
    {
        if( $request->is('api/*')){
            $validator = Validator::make(request()->all(), [
                'code' => ['required', 'numeric']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please see errors parameter for all errors.',
                    'errors' => $validator->errors()
                ]);
            }
            
            $user = User::where('code', $request->code)->first();
            
            if ($user == null) {
                return response()->json([
                    'success' => false,
                    'message' => 'This activation code is invalid.'
                ]);
            }

            if ($user->code == $request->code) {
                $user->email_verified_at = now();
                $user->code = null;
                $user->save();
    
 
                return response()->json([
                    'success' => true,
                    'message' => 'User verified successfully, you can now login.',
                    'data' => null
                ]);
            }
    
            return response()->json([
                'success' => false,
                'message' => 'Incorrect Code'
            ]);

        } else {
            $this->validate($request, [
                'first' => ['required', 'numeric'],
                'second' => ['required', 'numeric'],
                'third' => ['required', 'numeric'],
                'fourth' => ['required', 'numeric']
            ]);

            $code = sprintf('%s%s%s%s',$request->first,$request->second,$request->third,$request->fourth);

            $user = User::where('code', $code)->first();

            if ($user == null) {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'This activation code is invalid.'
                ]);
            }

            if ($user->code == $code) {
                $user->email_verified_at = now();
                $user->code = null;
                $user->save();
    
                return redirect()->route('log')->with([
                    'type' => 'success',
                    'message' => 'User verified successfully, you can now login.'
                ]);
            }

            return back()->with([
                'type' => 'danger',
                'message' => 'Incorrect Code'
            ]);

        }
    }

    public function email_verify_resend($email, Request $request)
    {
        if( $request->is('api/*')){
        } else {
            $email = Crypt::decrypt($email);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            if( $request->is('api/*')){
                return response()->json([
                    'success' => false,
                    'message' => "Email doesn't exist!",
                ]);
            } else {
                return back()->with([
                    'type' => 'danger',
                    'message' => "Email doesn't exist!"
                ]); 
            }
        }

        if (!$user->email_verified_at) {
            $code = mt_rand(1000, 9999);

            $user->update([
                'code' => $code
            ]);

            // Send verification code to user
            Mail::to($user->email)->send(new VerificationCode($user->code));

            if( $request->is('api/*')){
                return response()->json([
                    'success' => true,
                    'message' => 'A fresh verification code has been sent to your email address.',
                ]);
            } else {
                return back()->with([
                    'type' => 'success',
                    'message' => 'A fresh verification code has been sent to your email address.'
                ]); 
            }
        } else {
            if( $request->is('api/*')){
                return response()->json([
                    'success' => false,
                    'message' => 'User email has been verified, You can now login.',
                ]);
            } else {
                return back()->with([
                    'type' => 'danger',
                    'message' => 'User email has been verified, You can now login.'
                ]); 
            }
        }
    }

    /**
     * Login user.
     *
     * @return json
     */
    public function login(Request $request)
    {
        $input = $request->only(['email', 'password']);

        $validate_data = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $validator = Validator::make($input, $validate_data);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        $user = User::query()->where('email', $request->email)->first();

        if ($user && !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect Password!',
            ]);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email does\'nt exist',
            ]);
        }

        if ($user->account_type == 'Administrator') {
            return response()->json([
                'success' => false,
                'message' => 'You are not an User',
            ]);
        }

        // authentication attempt
        if (auth()->attempt($input)) {
            if ($user->status !== 'Active') {
                return response()->json([
                    'success' => false,
                    'message' => 'Account Deactivated, please contact the site administrator!',
                ]);
            }

            if (!$user->email_verified_at) {

                $code = mt_rand(1000, 9999);

                $user->update([
                    'code' => $code
                ]);

                // Send verification code to user
                Mail::to($user->email)->send(new VerificationCode($user->code));

                return response()->json([
                    'success' => false,
                    'message' => 'Before proceeding, please check your email for a verification link',
                    'data' => $user
                ]);
            }

            $token = auth()->user()->createToken('passport_token')->accessToken;

            return response()->json([
                'success' => true,
                'message' => 'User login succesfully, Use token to authenticate.',
                'token' => $token,
                'data' => Auth::user()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User authentication failed.'
            ]);
        }
    }

    public function user_login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
      
        $input = $request->only(['email', 'password']);

        $user = User::query()->where('email', $request->email)->first();
        
        if ($user && !Hash::check($request->password, $user->password)){
            return back()->with([
                'type' => 'danger',
                'message' => 'Incorrect Password!'
            ]);
        }
        
        if(!$user || !Hash::check($request->password, $user->password)) {
            return back()->with([
                'type' => 'danger',
                'message' => "Email doesn't exist"
            ]);
        }

        if ($user->account_type == 'Administrator') {
            return back()->with([
                'type' => 'danger',
                'message' => "You are not an User"
            ]);
        }

        // authentication attempt
        if(auth()->attempt($input)) {
            if ($user->status !== 'Active') {
                return back()->with([
                    'success' => 'danger',
                    'message' => 'Account Deactivated, please contact the site administrator!',
                ]);
            }

            if(!$user->email_verified_at){
                // Send email to user
                $user->notify(new SendVerificationCode($user));

                return redirect()->route('verify.account', Crypt::encrypt($user->email))->with([
                    'type' => 'success',
                    'message' => 'Registration Successful, Please verify your account!'
                ]); 
            }

            if (!$user->email_verified_at) {

                $code = mt_rand(1000, 9999);

                $user->update([
                    'code' => $code
                ]);

                // Send verification code to user
                Mail::to($user->email)->send(new VerificationCode($user->code));

                return redirect()->route('verify.account', Crypt::encrypt($user->email))->with([
                    'type' => 'success',
                    'message' => 'Registration Successful, Please verify your account!'
                ]); 
            }

            if($user->account_type == 'User'){
                return redirect()->route('user.dashboard');
            }
            
            Auth::logout();

            return back()->with([
                'type' => 'danger',
                'message' => 'You are not a User.'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'User authentication failed.'
            ]);
        }
    }

    public function forget_password(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $data['code'] = mt_rand(1000, 9999);

        // Create a new code
        $codeData = ResetCodePassword::create($data);

        // Send email to user
        Mail::to($request->email)->send(new ResetPasswordCode($codeData->code));

        return response()->json([
            'success' => true,
            'message' => 'We have emailed your password reset code!'
        ]);
    }

    public function password_forget(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email', $request->email)->first();

        // Delete all old code that user send before.
        ResetCodePassword::where('email', $request->email)->delete();

        // Generate random code
        $code = mt_rand(1000, 9999);

        // Create a new code
        $codeData = ResetCodePassword::create([
            'email' => $request->email,
            'code' => $code
        ]);

        // Send email to user
        Mail::to($request->email)->send(new ResetPasswordCode($codeData->code));

        return redirect()->route('user.reset.password', Crypt::encrypt($user->email))->with([
            'type' => 'success',
            'message' => 'We have emailed your password reset code!'
        ]);
    }

    public function password_reset_email($email) 
    {
        $email = Crypt::decrypt($email);

        return view('auth.reset_password', [
            'email' => $email
        ]);
    }

    public function password_reset(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (ResetCodePassword::where('code', '=', $request->code)->exists()) {
            // find the code
            $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

            // check if it does not expired: the time is one hour
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();

                return back()->with([
                    'type' => 'danger',
                    'message' => 'Password reset code expired'
                ]);
            }

            // find user's email 
            $user = User::firstWhere('email', $passwordReset->email);

            // update user password
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // delete current code 
            $passwordReset->delete();

            return redirect()->route('log')->with([
                'type' => 'success',
                'message' => 'Password has been successfully reset, Please login'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => "Code doesn't exist in our database"
            ]);
        }
    }

    public function code_check(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response()->json([
                'success' => false,
                'message' => 'Password reset code expired'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Password reset code valid',
            'data' => $passwordReset->code,
        ]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (ResetCodePassword::where('code', '=', $request->code)->exists()) {
            // find the code
            $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

            // check if it does not expired: the time is one hour
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();

                return response()->json([
                    'success' => false,
                    'message' => 'Password reset code expired'
                ]);
            }

            // find user's email 
            $user = User::firstWhere('email', $passwordReset->email);

            // update user password
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // delete current code 
            $passwordReset->delete();

            return response()->json([
                'success' => true,
                'message' => 'Password has been successfully reset'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Code does\'nt exist in our database'
            ]);
        }
    }

    public function admin_login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $input = $request->only(['email', 'password']);

        $user = User::query()->where('email', $request->email)->first();

        if ($user && !Hash::check($request->password, $user->password)) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Incorrect Password!'
            ]);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with([
                'type' => 'danger',
                'message' => "Email doesn't exist"
            ]);
        }

        // authentication attempt
        if (auth()->attempt($input)) {
            if ($user->account_type == 'Administrator') {
                return redirect()->route('admin.dashboard');
            }

            return back()->with([
                'type' => 'danger',
                'message' => 'You are not an Administrator!'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'User authentication failed.'
            ]);
        }
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('/');
    }
}
