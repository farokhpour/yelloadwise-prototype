<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::orderBy('created_at', 'desc')->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaigns.edit', compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer|min:1',
            'cars' => 'required|integer|min:1',
            'locations' => 'required|array',
            'link' => 'required|url',
            'utms' => 'nullable|array',
            'cost_per_day' => 'nullable|numeric|min:0',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:102400', // 100MB max
            'remove_video' => 'nullable|boolean',
        ]);

        // Handle video file update
        if ($request->has('remove_video') && $request->remove_video) {
            // Delete old video file
            if ($campaign->video_file && Storage::disk('public')->exists($campaign->video_file)) {
                Storage::disk('public')->delete($campaign->video_file);
            }
            $validated['video_file'] = null;
        } elseif ($request->hasFile('video_file')) {
            // Delete old video file if exists
            if ($campaign->video_file && Storage::disk('public')->exists($campaign->video_file)) {
                Storage::disk('public')->delete($campaign->video_file);
            }
            // Store new video file
            $validated['video_file'] = $request->file('video_file')->store('campaigns/videos', 'public');
        } else {
            // Keep existing video file
            unset($validated['video_file']);
        }

        // Remove remove_video from validated data
        unset($validated['remove_video']);

        // Check if approve button was clicked (before updating)
        $shouldApprove = $request->has('approve') && $campaign->status === 'waiting_admin_approval';

        // Update campaign
        $campaign->update($validated);

        // Approve if requested
        if ($shouldApprove) {
            $campaign->update([
                'status' => 'waiting_payment',
                'approved_at' => now(),
            ]);
            return redirect()->route('admin.campaigns.edit', $id)
                    ->with('success', 'کمپین با موفقیت به‌روزرسانی و تایید شد!');
        }

        return redirect()->route('admin.campaigns.edit', $id)
            ->with('success', 'کمپین با موفقیت به‌روزرسانی شد');
    }

    public function downloadVideo($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if (!$campaign->video_file || !Storage::disk('public')->exists($campaign->video_file)) {
            return back()->with('error', 'فایل ویدیو یافت نشد');
        }

        return Storage::disk('public')->download($campaign->video_file);
    }

    public function approve($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'waiting_admin_approval') {
            return back()->with('error', 'کمپین در وضعیت فعلی قابل تایید نیست');
        }

        $campaign->update([
            'status' => 'waiting_payment',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'کمپین تایید شد! در انتظار پرداخت.');
    }

    public function run($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'waiting_to_run') {
            return back()->with('error', 'کمپین در وضعیت فعلی قابل اجرا نیست');
        }

        $campaign->update([
            'status' => 'running',
            'started_at' => now(),
            'ended_at' => now()->addDays($campaign->days),
        ]);

        return back()->with('success', 'کمپین اکنون در حال اجرا است!');
    }
}
