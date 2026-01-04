<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::orderBy('created_at', 'desc')->get();
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|string|max:255|unique:devices,device_id',
            'default_route' => 'required|string|max:255',
            'owner_first_name' => 'required|string|max:255',
            'owner_last_name' => 'required|string|max:255',
            'owner_national_id' => 'required|string|max:20',
            'documents_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB max
        ]);

        $deviceData = [
            'device_id' => $validated['device_id'],
            'default_route' => $validated['default_route'],
            'owner_first_name' => $validated['owner_first_name'],
            'owner_last_name' => $validated['owner_last_name'],
            'owner_national_id' => $validated['owner_national_id'],
            'status' => 'offline',
            'last_status_updated_at' => now(),
        ];

        // Handle document upload
        if ($request->hasFile('documents_file')) {
            $deviceData['documents_file'] = $request->file('documents_file')->store('devices/documents', 'public');
        }

        Device::create($deviceData);

        return redirect()->route('epic.digital-taxi-rooftop.devices.index')
            ->with('success', 'دستگاه با موفقیت ثبت شد!');
    }
}

