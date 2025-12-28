<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
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

        // Find running campaigns that match the location
        $campaigns = Campaign::where('status', 'running')
            ->whereJsonContains('locations', $routeId)
            ->get();

        if ($campaigns->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'هیچ کمپین فعالی برای این موقعیت وجود ندارد'
            ], 404);
        }

        // Get the first matching campaign (in production, you'd have logic to select)
        $campaign = $campaigns->first();

        // In production, get video URL from MinIO
        $videoUrl = Storage::url($campaign->video_file);

        return response()->json([
            'success' => true,
            'campaign_id' => $campaign->id,
            'campaign_name' => $campaign->name,
            'video_url' => $videoUrl,
            'link' => $campaign->link,
            'utms' => $campaign->utms,
        ]);
    }
}
