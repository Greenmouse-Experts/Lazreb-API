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

class AdminController extends Controller
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
        $hireService = HireVehicle::get()->count();
        $leaseService =  LeaseVehicle::get()->count();
        $charterService = CharterVehicle::get()->count();
        $partnerFleetManagement = BecomePartner::get()->count();
        $userRequestServices = $hireService + $leaseService + $charterService + $partnerFleetManagement;

        $users = User::where('account_type', 'User')->get();

        $recentUsers = User::latest()->where('account_type', 'User')->take(5)->get();
        

        $transactions = Transaction::get()->count();

        return view('admin.dashboard', [
            'hireService' => $hireService,
            'leaseService' => $leaseService,
            'charterService' => $charterService,
            'partnerFleetManagement' => $partnerFleetManagement,
            'userRequestServices' => $userRequestServices,
            'transactions' => $transactions,
            'users' => $users,
            'recentUsers' => $recentUsers
        ]);
    }

    public function users(){
        $users = User::latest()->where('account_type', 'User')->get();

        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function edit_user($id)
    {
        $finder = Crypt::decrypt($id);

        $user = User::findorfail($finder);

        return view('admin.edit-user', [
            'user' => $user
        ]);
    }

    public function admin_deactivate_user($id)
    {
        $finder = Crypt::decrypt($id);

        $user = User::find($finder);

        $user->update([
            'status' => 'Inactive'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $user->name . ' Account Deactivated!'
        ]);
    }

    public function admin_activate_user($id)
    {
        $finder = Crypt::decrypt($id);

        $user = User::find($finder);

        $user->update([
            'status' => 'Active'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => $user->name . ' Account Activated!'
        ]);
    }

    public function admin_delete_user($id)
    {
        $idFinder = Crypt::decrypt($id);

        $user = User::findorfail($idFinder);
        
        if($user->photo) {
            Storage::delete(str_replace("storage", "public", $user->photo));
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Account Deleted Successfully!'
        ]); 

    }

    public function admin_send_message_user($user_id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'subject' => ['required','string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $id = Crypt::decrypt($user_id);

        $user = User::findorfail($id);

        $message = new Notification();
        $message->from = Auth::user()->id;
        $message->to = $user->id;
        $message->subject = request()->subject;
        $message->message = request()->message;
        $message->save();

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $user->name,
            'email' => $user->email
        );
        
        /** Send message to the user */
        Mail::send('emails.notification', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });

        return back()->with([
            'type' => 'success',
            'icon' => 'mdi-check-all',
            'message' => 'Message sent successfully to '.$user->name,
        ]); 
    }

    public function admin_update_password_user($id, Request $request)
    {
        //Validate Request
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $finder = Crypt::decrypt($id);

        $user = User::findorfail($finder);
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => $user->name.' Password Updated Successfully.'
        ]); 
    }

    public function admin_update_profile_user($id, Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
        ]);

        $finder = Crypt::decrypt($id);

        $user = User::findorfail($finder);

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
                'sex' => $request->sex,
                'phone_number' => $request->phone_number,
            ]); 
        }

        return back()->with([
            'type' => 'success',
            'message' => $user->name. ' profile updated successfully!'
        ]);
    }

    public function admin_upload_profile_picture_user($id, Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpeg,png,jpg',
        ]);

        $finder = Crypt::decrypt($id);

        $user = User::findorfail($finder);

        $filename = request()->avatar->getClientOriginalName();
        if($user->photo) {
            Storage::delete(str_replace("storage", "public", $user->photo));
        }
        request()->avatar->storeAs('users_avatar', $filename, 'public');
        $user->photo = '/storage/users_avatar/'.$filename;
        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => $user->name.' Profile Picture Uploaded Successfully!'
        ]);
    }

    public function admin_user_referral($id)
    {
        $finder = Crypt::decrypt($id);

        $user = User::findorfail($finder);

        $referrals = Referee::latest()->where('referrer_id', $user->id)->get();

        return view('admin.referrals', [
            'user' => $user,
            'referrals' => $referrals
        ]);
    }

    public function service(){
        return view('admin.service');
    }

    public function add_service(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'thumbnail' => 'required|mimes:jpeg,png,jpg',
            'description' => ['required', 'string', 'max:255'],
        ]);

        $filename = request()->thumbnail->getClientOriginalName();

        request()->thumbnail->storeAs('services_thumbnails', $filename, 'public');

        Service::create([
            'name' => $request->name,
            'thumbnail' => '/storage/services_thumbnails/'.$filename,
            'description' => $request->description
        ]);

        return redirect()->route('admin.get.services')->with([
            'type' => 'success',
            'message' => 'Service Added Successfully!'
        ]);
    }
    
    public function services()
    {
        $services = Service::latest()->get();

        return view('admin.manage-services', [
            'services' => $services
        ]);
    }

    public function update_service($id, Request $request)
    {
        $this->validate($request, [
            'description' => ['required', 'string', 'max:255'],
        ]);

        $finder = Crypt::decrypt($id);

        $service = Service::findorfail($finder);

        if (request()->hasFile('thumbnail')) {
            
            $this->validate($request, [
                'thumbnail' => 'required|mimes:jpeg,png,jpg',
            ]);

            $filename = request()->thumbnail->getClientOriginalName();
            if($service->thumbnail) {
                Storage::delete(str_replace("storage", "public", $service->thumbnail));
            }
            request()->thumbnail->storeAs('services_thumbnails', $filename, 'public');

            $service->update([
                'thumbnail' => '/storage/services_thumbnails/'.$filename,
                'description' => $request->description
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Service Updated Successfully!'
            ]);
        }

        $service->update([
            'description' => $request->description
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Service Updated Successfully!'
        ]);
       
    }

    public function delete_service($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $service = Service::findorfail($finder);
        
        if($service->thumbnail) {
            Storage::delete(str_replace("storage", "public", $service->thumbnail));
        }

        $service->delete();

        return back()->with([
            'type' => 'success',
            'message' => "Service Deleted Successfully!",
        ]);
    }
    
    public function users_services_requests()
    {
        $services = Service::get();

        $partnerFleetManagement = BecomePartner::get()->count();

        return view('admin.services-requests', [
            'services' => $services,
            'partnerFleetManagement' => $partnerFleetManagement
        ]);
    }

    public function users_view_requested_services($id)
    {
        $finder = Crypt::decrypt($id);

        $service = Service::findorfail($finder);

        return view('admin.view-requested-services', [
            'service' => $service
        ]);
    }

    public function users_partnership_requests()
    {
        $partnershipRequests = BecomePartner::latest()->get();

        return view('admin.partnership-requests', [
            'partnershipRequests' => $partnershipRequests
        ]);
    }

    public function process_hire_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $hirevehicle = HireVehicle::findorfail($finder);
        
        $hirevehicle->update([
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        $user = User::where('id', $hirevehicle->user_id)->first();

        $message = new Notification();
        $message->from = Auth::user()->id;
        $message->to = $user->id;
        $message->subject = 'Hire Vehicle Request';
        $message->message = 'Hello '.$user->name.', Your Request to hire a vehicle has been '. $hirevehicle->status;
        $message->save();

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $user->name,
            'email' => $user->email,
            'service' => 'Hire A Vehicle'
        );
        
        /** Send message to the user */
        Mail::send('emails.service-notification', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });

        return back()->with([
            'type' => 'success',
            'message' => "Request Processed Successfully!",
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

    public function process_charter_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $chartervehicle = CharterVehicle::findorfail($finder);
        
        $chartervehicle->update([
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        $user = User::where('id', $chartervehicle->user_id)->first();
        
        $message = new Notification();
        $message->from = Auth::user()->id;
        $message->to = $user->id;
        $message->subject = 'Charter Vehicle Request';
        $message->message = 'Hello '.$user->name.', Your Request to charter a vehicle has been '. $chartervehicle->status;
        $message->save();

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $user->name,
            'email' => $user->email,
            'service' => 'Charter A Vehicle'
        );
        
        /** Send message to the user */
        Mail::send('emails.service-notification', $data, function ($m) use ($data) {
            $m->to($data['email'])->subject(config('app.name'));
        });

        return back()->with([
            'type' => 'success',
            'message' => "Request Processed Successfully!",
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

    public function process_lease_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $leasevehicle = LeaseVehicle::findorfail($finder);
        
        $leasevehicle->update([
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        $message = new Notification();
        $message->from = Auth::user()->id;
        $message->to = $user->id;
        $message->subject = 'Lease Vehicle Request';
        $message->message = 'Hello '.$user->name.', Your Request to lease a vehicle has been '. $leasevehicle->status;
        $message->save();

        $user = User::where('id', $leasevehicle->user_id)->first();
        
        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $user->name,
            'email' => $user->email,
            'service' => 'Lease A Vehicle'
        );

        return back()->with([
            'type' => 'success',
            'message' => "Request Processed Successfully!",
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

    public function process_partner_fleet_management($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $partnerfleetmanagement = BecomePartner::findorfail($finder);
        
        $partnerfleetmanagement->update([
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        $user = User::where('id', $partnerfleetmanagement->user_id)->first();
        
        $message = new Notification();
        $message->from = Auth::user()->id;
        $message->to = $user->id;
        $message->subject = 'Partner Fleet Management Request';
        $message->message = 'Hello '.$user->name.', Your Request for partner fleet management has been '. $partnerfleetmanagement->status;
        $message->save();

        /** Store information to include in mail in $data as an array */
        $data = array(
            'name' => $user->name,
            'email' => $user->email,
            'service' => 'Partner Fleet Management '
        );

        return back()->with([
            'type' => 'success',
            'message' => "Request Processed Successfully!",
        ]);
    }

    public function delete_partner_fleet_management($id)
    {
        $finder = Crypt::decrypt($id);

        BecomePartner::findorfail($finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => "Request Deleted Successfully!",
        ]);
    }

    public function users_notifications()
    {
        $allUserNotifications = Notification::latest()->get();

        return view('admin.notifications', [
            'allUserNotifications' => $allUserNotifications
        ]);
    }

    public function users_download_transaction($id)
    {
        $finder = Crypt::decrypt($id);

        $transaction = Transaction::findorfail($finder);
        
        return Storage::download(str_replace("storage", "public", $transaction->slip));

    }

    public function users_delete_transaction($id)
    {
        $finder = Crypt::decrypt($id);

        $transaction = Transaction::findorfail($finder);

        if($transaction->slip) {
            Storage::delete(str_replace("storage", "public", $transaction->slip));
        }

        $transaction->delete();

        return back()->with([
            'type' => 'success',
            'message' => "Transaction Deleted Successfully!",
        ]);
    }

    public function users_transactions()
    {
        $transactions = Transaction::latest()->get();

        return view('admin.transactions', [
            'transactions' => $transactions
        ]);
    }

    public function settings(){
        return view('admin.settings');
    }

    public function admin_update_password( Request $request)
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

    public function admin_update_profile(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = User::findorfail(Auth::user()->id);

        if($user->email == $request->email)
        {
            $user->update([
                'name' => $request->name
            ]); 
        } else {
            //Validate Request
            $this->validate($request, [
                'email' => ['string', 'email', 'max:255', 'unique:users'],
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]); 
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function admin_upload_profile_picture(Request $request)
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
