<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegulatorCampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::where('status', 'waiting_for_regulator_approval')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('regulator.campaigns.index', compact('campaigns'));
    }

    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'waiting_for_regulator_approval') {
            return redirect()->route('epic.digital-taxi-rooftop.regulator.campaigns.index')
                ->with('error', 'این کمپین در انتظار تایید مجوز دهنده نیست');
        }
        
        return view('regulator.campaigns.show', compact('campaign'));
    }

    public function approve(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'waiting_for_regulator_approval') {
            return back()->with('error', 'کمپین در وضعیت فعلی قابل تایید نیست');
        }

        $campaign->update([
            'status' => 'waiting_payment',
        ]);

        return redirect()->route('epic.digital-taxi-rooftop.regulator.campaigns.index')
            ->with('success', 'کمپین تایید شد! در انتظار پرداخت.');
    }

    public function reject(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if ($campaign->status !== 'waiting_for_regulator_approval') {
            return back()->with('error', 'کمپین در وضعیت فعلی قابل رد نیست');
        }

        $validated = $request->validate([
            'regulator_comment' => 'nullable|string|max:1000',
        ]);

        $campaign->update([
            'status' => 'waiting_admin_approval',
            'regulator_comment' => $validated['regulator_comment'] ?? null,
        ]);

        return redirect()->route('epic.digital-taxi-rooftop.regulator.campaigns.index')
            ->with('success', 'کمپین به ادمین برگشت داده شد.');
    }

    public function downloadVideo($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        if (!$campaign->video_file || !Storage::disk('public')->exists($campaign->video_file)) {
            return back()->with('error', 'فایل ویدیو یافت نشد');
        }

        return Storage::disk('public')->download($campaign->video_file);
    }
}

