<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'code' => 'required|unique:devices',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Added more image formats
        ]);

        $device = Device::create([
            'code' => $request->code
        ]);


        if ($device instanceof Model) {

            // Check if a picture is uploaded
            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                $file = $request->file('picture');

                // Store the image using Spatie Media Library
                $device->addMedia($file)
                    ->toMediaCollection('device-image', 'public');
            }

            toastr()->success('Device created successfully!');
            return redirect()->route('devices.index');
        }

        toastr()->error('An error has occurred please try again later.');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $device = Device::findOrFail($id);
        return view('devices.show', compact('device'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $device = Device::findOrFail($id);
        return view('devices.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $device = Device::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|unique:devices,code,' . $id,
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
        ]);

        $device->update($validated);

        if ($request->hasFile('picture')) {
            $device->clearMediaCollection('device-image');
            $device->addMediaFromRequest('picture')->toMediaCollection('device-image');
        }
        toastr()->success('Device updated successfully!');
        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $device = Device::findOrFail($id);
        $device->clearMediaCollection('devices');
        $device->delete();
        toastr()->success('Device deleted successfully!');
        return redirect()->route('devices.index');
    }
}
