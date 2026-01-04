<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Device;
use App\Models\DeviceCall;
use App\Models\DefaultVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IntegrationDemoController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::where('status', 'running')->get();
        return view('integration.demo', compact('campaigns'));
    }

    // API endpoint that digital taxi rooftop devices call
    public function apiGetVideo(Request $request)
    {
        $routeId = $request->input('route_id');
        $location = $request->input('location');
        $deviceId = $request->input('device_id'); // Device ID from query params

        // Update device status if device_id is provided
        if ($deviceId) {
            $device = Device::where('device_id', $deviceId)->first();
            if ($device) {
                // Mark device as online and update timestamp
                $device->markAsOnline();
                
                // Log the device call
                DeviceCall::create([
                    'device_id' => $device->id,
                    'route_id' => $routeId,
                    'location' => $location,
                    'query_params' => $request->all(),
                    'ip_address' => $request->ip(),
                ]);
            }
        }

        // Find running campaigns that match the location
        $campaigns = Campaign::where('status', 'running')
            ->whereJsonContains('locations', $routeId)
            ->get();

        $defaultVideos = DefaultVideo::orderBy('order')->get();
        $hasDefaultVideos = $defaultVideos->count() > 0;

        // If no campaigns found, show default video
        if ($campaigns->isEmpty()) {
            if ($hasDefaultVideos) {
                $defaultVideo = $defaultVideos->random();
                return response()->json([
                    'success' => true,
                    'type' => 'default',
                    'video_id' => $defaultVideo->id,
                    'video_name' => $defaultVideo->name,
                    'video_url' => Storage::url($defaultVideo->video_file),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'هیچ کمپین فعالی یا ویدیو پیش‌فرضی برای این موقعیت وجود ندارد'
                ], 404);
            }
        }

        // Campaign found - decide between campaign and default video
        $campaign = $campaigns->first();
        $showDefaultVideo = false;

        if ($hasDefaultVideos) {
            // 25% chance to show default video, 75% chance to show campaign
            $random = rand(1, 100);
            if ($random <= 25) {
                $showDefaultVideo = true;
            }
        }

        if ($showDefaultVideo) {
            // Show default video (25% probability)
            $defaultVideo = $defaultVideos->random();
            return response()->json([
                'success' => true,
                'type' => 'default',
                'video_id' => $defaultVideo->id,
                'video_name' => $defaultVideo->name,
                'video_url' => Storage::url($defaultVideo->video_file),
                'campaign_available' => true,
                'campaign_id' => $campaign->id,
                'campaign_name' => $campaign->name,
            ]);
        } else {
            // Show campaign video (75% probability)
            $videoUrl = Storage::url($campaign->video_file);
            return response()->json([
                'success' => true,
                'type' => 'campaign',
                'campaign_id' => $campaign->id,
                'campaign_name' => $campaign->name,
                'video_url' => $videoUrl,
                'link' => $campaign->link,
                'utms' => $campaign->utms,
            ]);
        }
    }
}
