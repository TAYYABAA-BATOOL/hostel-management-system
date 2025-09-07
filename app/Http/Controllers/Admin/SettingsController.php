<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        // Get the first setting record or create a default one if not exists
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'hostel_name' => '',
                'contact_email' => '',
                'contact_phone' => '',
                'hostel_address' => ''
            ]);
        }

        return view('admin.settings.show', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hostel_name'     => 'required|string|max:255',
            'contact_email'   => 'required|email|max:255',
            'contact_phone'   => 'required|string|max:20',
            'hostel_address'  => 'nullable|string|max:255',
        ]);

        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        $setting->hostel_name    = $request->hostel_name;
        $setting->contact_email  = $request->contact_email;
        $setting->contact_phone  = $request->contact_phone;
        $setting->hostel_address = $request->hostel_address;
        $setting->save();

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
