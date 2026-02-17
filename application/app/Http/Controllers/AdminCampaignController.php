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

        // Prevent updates when campaign is in read-only status
        if (in_array($campaign->status, ['waiting_to_run', 'running', 'completed'])) {
            return back()->with('error', 'این کمپین در وضعیت فعلی قابل ویرایش نیست.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer|min:1',
            'cars' => 'required|integer|min:1',
            'locations' => 'nullable|array',
            'link' => 'nullable|url',
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

        // Handle locations - convert to empty array if not provided
        if (!isset($validated['locations']) || empty($validated['locations'])) {
            $validated['locations'] = [];
        }

        // Handle link - set to null if empty
        if (isset($validated['link']) && empty(trim($validated['link']))) {
            $validated['link'] = null;
        }

        // Check if approve button was clicked (before updating)
        $shouldApprove = $request->has('approve') && $campaign->status === 'waiting_admin_approval';

        // Update campaign
        $campaign->update($validated);

        // Approve if requested
        if ($shouldApprove) {
            $campaign->update([
                'status' => 'waiting_for_regulator_approval',
                'approved_at' => now(),
                'regulator_comment' => null, // Clear previous regulator comment when admin approves again
            ]);
            return redirect()->route('epic.digital-taxi-rooftop.admin.campaigns.edit', $id)
                    ->with('success', 'کمپین با موفقیت به‌روزرسانی و تایید شد! در انتظار تایید مجوز دهنده.');
        }

        return redirect()->route('epic.digital-taxi-rooftop.admin.campaigns.edit', $id)
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
            'status' => 'waiting_for_regulator_approval',
            'approved_at' => now(),
            'regulator_comment' => null, // Clear previous regulator comment when admin approves again
        ]);

        return back()->with('success', 'کمپین تایید شد! در انتظار تایید مجوز دهنده.');
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

    // Form 1: Price, Discount Percent, Settlement Account
    public function updateForm1($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaigns.update-form-1', compact('campaign'));
    }

    public function updateForm1Store(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
            'discount_percent' => 'nullable|numeric|min:0|max:100',
            'settlement_account' => 'nullable|boolean',
        ]);

        // In a real application, these would be saved to the database
        // For prototype, we'll just show a success message
        return redirect()->route('epic.digital-taxi-rooftop.admin.campaigns.update-form-1', $id)
            ->with('success', 'فرم با موفقیت ثبت شد! (این یک نمونه است و داده‌ها ذخیره نشده‌اند)');
    }

    // Form 2: Target and Campaign Start Date
    public function updateForm2($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaigns.update-form-2', compact('campaign'));
    }

    public function updateForm2Store(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        $validated = $request->validate([
            'target' => 'required|string|max:255',
            'campaign_start_date' => 'required|date',
        ]);

        // In a real application, these would be saved to the database
        // For prototype, we'll just show a success message
        return redirect()->route('epic.digital-taxi-rooftop.admin.campaigns.update-form-2', $id)
            ->with('success', 'فرم با موفقیت ثبت شد! (این یک نمونه است و داده‌ها ذخیره نشده‌اند)');
    }
}
