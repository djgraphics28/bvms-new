<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangays = Barangay::all();

        return view('barangays.index', compact('barangays'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barangays.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Added more image formats
        ]);

        // Create a new Barangay
        $barangay = Barangay::create([
            'name' => $request->name,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);

        // Redirect to the index route with a success message


        if ($barangay instanceof Model) {

            // Check if a picture is uploaded
            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                $file = $request->file('picture');

                // Store the image using Spatie Media Library
                $barangay->addMedia($file)
                    ->toMediaCollection('barangay-image', 'public');
            }


            toastr()->success('Barangay created successfully!');
            return redirect()->route('barangays.index');
        }

        toastr()->error('An error has occurred please try again later.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $barangay = Barangay::findOrFail($id);

        $adminUsers = $barangay->adminUsers;
        $drivers = $barangay->drivers;
        $vehicles = $barangay->vehicles;
        $incidents = $barangay->incidents;
        return view('barangays.info', compact('barangay', 'adminUsers', 'drivers', 'vehicles', 'incidents'));
    }    /**
         * Show the form for editing the specified resource.
         */
    public function edit(string $id)
    {
        $barangay = Barangay::findOrFail($id);
        return view('barangays.edit', compact('barangay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $barangay = Barangay::findOrFail($id);

        $barangay->update([
            'name' => $request->name,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);

        // Handle picture upload
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            // Delete old media first
            $barangay->clearMediaCollection('barangay-image');

            // Upload new picture
            $barangay->addMedia($request->file('picture'))
                ->toMediaCollection('barangay-image', 'public');
        }

        return redirect()->route('barangays.index')->with('success', 'Barangay updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangay = Barangay::findOrFail($id);
        $barangay->clearMediaCollection('barangay-image');
        $barangay->delete();
        toastr()->success('Barangay deleted successfully!');
        return redirect()->route('barangays.index');
    }
}
