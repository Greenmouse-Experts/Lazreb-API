<?php

namespace App\Http\Controllers;

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
        return view('dashboard.dashboard');
    }
    
    public function request_services()
    {
        $services = Service::latest()->get();

        return view('dashboard.request-services', [
            'services' => $services
        ]);
    }

    public function become_a_partner()
    {
        return view('dashboard.become-a-partner');
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
