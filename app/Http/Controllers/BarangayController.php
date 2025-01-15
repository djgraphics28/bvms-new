<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;

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
        $barangay = Barangay::create([
            'name' => $request->name,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);

        return redirect()->route('barangays.index')->with('success', 'Barangay created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
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
        $barangay = Barangay::findOrFail($id);
        
        $barangay->update([
            'name' => $request->name,
            'longitude' => $request->longitude, 
            'latitude' => $request->latitude
        ]);

        return redirect()->route('barangays.index')->with('success', 'Barangay updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
