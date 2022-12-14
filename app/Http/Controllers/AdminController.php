<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
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

    public function add_service(Request $request)
    {
        $input = $request->only(['name', 'thumbnail', 'description']);

        $validate_data = [
            'name' => ['required', 'string', 'max:255'],
            'thumbnail' => 'required|mimes:jpeg,png,jpg',
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

        $filename = request()->thumbnail->getClientOriginalName();

        request()->thumbnail->storeAs('services_thumbnails', $filename, 'public');

        $service = Service::create([
            'name' => $request->name,
            'thumbnail' => '/storage/services_thumbnails/'.$filename,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Service Added Successfully!',
            'data' => $service
        ]);
    }

    public function update_service($id, Request $request)
    {
        $input = $request->only(['name', 'thumbnail', 'description']);

        $validate_data = [
            'name' => ['required', 'string', 'max:255'],
            'thumbnail' => 'required|mimes:jpeg,png,jpg',
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

        $service = Service::findorfail($id);

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

        return response()->json([
            'success' => true,
            'message' => 'Service Updated Successfully!',
            'data' => $service
        ]);
    }

    public function delete_service($id, Request $request)
    {
        $input = $request->only(['delete_field']);

        $validate_data = [
            'delete_field' => ['required', 'string', 'max:255']
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        if($request->delete_field == "DELETE")
        {
            $service = Service::findorfail($id);
            
            if($service->thumbnail) {
                Storage::delete(str_replace("storage", "public", $service->thumbnail));
            }

            $service->delete();

            return response()->json([
                'success' => true,
                'message' => "Service Deleted Successfully!",
            ]);
        } 

        return response()->json([
            'success' => false,
            'message' => "Field doesn't match, Try Again!",
        ]);
    }

    public function services()
    {
        $services = Service::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'All Services Retrieved',
            'data' => $services
        ]);
    }
}
