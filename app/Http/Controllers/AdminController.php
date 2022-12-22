<?php

namespace App\Http\Controllers;

use App\Models\BecomePartner;
use App\Models\CharterVehicle;
use App\Models\HireVehicle;
use App\Models\LeaseVehicle;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
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
        return view('admin.dashboard');
    }

    public function users(){
        return view('admin.users');
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
            'name' => ['required', 'string', 'max:255'],
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
                'name' => $request->name,
                'thumbnail' => '/storage/services_thumbnails/'.$filename,
                'description' => $request->description
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Service Updated Successfully!'
            ]);
        }

        $service->update([
            'name' => $request->name,
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

    public function update_hire_vehicle($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $hirevehicle = HireVehicle::findorfail($finder);
        
        $hirevehicle->update([
            'comment' => $request->comment,
            'status' => $request->status,
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
        
        $chartervehicle->update([
            'comment' => $request->comment,
            'status' => $request->status,
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

        $leasevehicle = LeaseVehicle::findorfail($finder);
        
        $leasevehicle->update([
            'comment' => $request->comment,
            'status' => $request->status,
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

    public function update_partner_fleet_management($id, Request $request)
    {
        $finder = Crypt::decrypt($id);

        $partnerfleetmanagement = BecomePartner::findorfail($finder);
        
        $partnerfleetmanagement->update([
            'comment' => $request->comment,
            'status' => $request->status,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => "Request Updated Successfully!",
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
        return view('admin.notifications');
    }

    public function users_transactions()
    {
        return view('admin.transactions');
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
