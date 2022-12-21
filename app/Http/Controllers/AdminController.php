<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
    
    public function users_services_requests(){
        return view('admin.services-requests');
    }

    public function users_partnership_requests(){
        return view('admin.partnership-requests');
    }

    public function users_notifications(){
        return view('admin.notifications');
    }

    public function users_transactions(){
        return view('admin.transactions');
    }

    public function settings(){
        return view('admin.settings');
    }
}
