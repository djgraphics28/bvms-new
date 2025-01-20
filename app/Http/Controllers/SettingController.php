<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function updateLogo(Request $request)
    {
        if ($request->hasFile('logo')) {
            $setting = Setting::updateOrCreate(
                ['group' => 'logo'],
                ['key' => 'site-logo', 'value' => 'logo']
            );

            $setting->clearMediaCollection('logo');
            $setting->addMediaFromRequest('logo')
                ->toMediaCollection('logo');

            return response()->json([
                'success' => true,
                'message' => 'Logo updated successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Please upload a logo file'
        ]);
    }
}
