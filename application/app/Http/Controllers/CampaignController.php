<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'video_file' => 'required|file|mimes:mp4,avi,mov,wmv|max:102400', // 100MB max
            'days' => 'required|integer|min:1',
            'cars' => 'required|integer|min:1',
            'locations' => 'required|string', // JSON string
            'link' => 'required|url',
            'utms' => 'nullable|string', // JSON string
        ]);

        // Parse JSON strings
        $locations = json_decode($validated['locations'], true);
        $utms = json_decode($validated['utms'] ?? '{}', true);

        // Store video file (in production, this would go to MinIO)
        $videoPath = $request->file('video_file')->store('campaigns/videos', 'public');

        $campaign = Campaign::create([
            'name' => $validated['name'],
            'video_file' => $videoPath,
            'days' => $validated['days'],
            'cars' => $validated['cars'],
            'locations' => $locations,
            'link' => $validated['link'],
            'utms' => $utms,
            'status' => 'waiting_admin_approval',
        ]);

        return response()->json([
            'success' => true,
            'campaign_id' => $campaign->id,
            'message' => 'کمپین با موفقیت ایجاد شد'
        ]);
    }

    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('campaigns.show', compact('campaign'));
    }

    public function payment($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'waiting_payment') {
            return redirect()->route('campaigns.show', $id)
                ->with('error', 'Campaign is not ready for payment');
        }

        return view('campaigns.payment', compact('campaign'));
    }

    public function processPayment(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'waiting_payment') {
            return back()->with('error', 'کمپین آماده پرداخت نیست');
        }

        // In production, integrate with payment gateway
        // For prototype, just mark as paid
        $campaign->update([
            'status' => 'waiting_to_run',
            'paid_at' => now(),
        ]);

        return redirect()->route('campaigns.show', $id)
            ->with('success', 'پرداخت با موفقیت انجام شد! کمپین در انتظار اجرا است.')
            ->with('payment_success', true);
    }
}
