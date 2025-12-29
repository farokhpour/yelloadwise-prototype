<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CampaignController extends Controller
{
    public function index()
    {
        // Get all campaigns (in production, filter by authenticated user)
        $campaigns = Campaign::orderBy('created_at', 'desc')->get();
        return view('campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100',
            'video_file' => 'nullable|file|mimes:mp4,mkv,avi,mov,wmv|max:102400', // 100MB max, optional
            'days' => 'required|integer|min:1|max:60',
            'cars' => 'required|integer|min:1|max:100',
            'locations' => 'nullable|string', // JSON string, optional
            'link' => 'nullable|url', // Optional
            'utms' => 'nullable|string', // JSON string
        ]);

        // Parse JSON strings
        $locations = !empty($validated['locations']) ? json_decode($validated['locations'], true) : [];
        $utms = json_decode($validated['utms'] ?? '{}', true);

        // Store video file if provided (in production, this would go to MinIO)
        $videoPath = null;
        if ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('campaigns/videos', 'public');
        }

        $campaign = Campaign::create([
            'name' => $validated['name'],
            'video_file' => $videoPath,
            'days' => $validated['days'],
            'cars' => $validated['cars'],
            'locations' => $locations ?: [],
            'link' => $validated['link'] ?? null,
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
            return redirect()->route('epic.digital-taxi-rooftop.campaign.show', $id)
                ->with('error', 'کمپین آماده پرداخت نیست');
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

        return redirect()->route('epic.digital-taxi-rooftop.campaign.show', $id)
            ->with('success', 'پرداخت با موفقیت انجام شد! کمپین در انتظار اجرا است.')
            ->with('payment_success', true);
    }
}
