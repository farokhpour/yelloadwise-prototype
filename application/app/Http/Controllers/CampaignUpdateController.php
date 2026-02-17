<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignUpdateController extends Controller
{
    // Epic Index Page
    public function epicIndex()
    {
        return view('campaign-update.epic-index');
    }

    // Form 1: Price, Discount Percent, Settlement Account
    public function updateForm1($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('campaign-update.update-form-1', compact('campaign'));
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
        return redirect()->route('epics.campaign-update.update-form-1', $id)
            ->with('success', 'فرم با موفقیت ثبت شد! (این یک نمونه است و داده‌ها ذخیره نشده‌اند)');
    }

    // Form 2: Target and Campaign Start Date
    public function updateForm2($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('campaign-update.update-form-2', compact('campaign'));
    }

    public function updateForm2Store(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        
        $validated = $request->validate([
            'target' => 'required|numeric|min:1',
            'campaign_start_date' => 'required|date',
        ]);

        // In a real application, these would be saved to the database
        // For prototype, we'll just show a success message
        return redirect()->route('epics.campaign-update.update-form-2', $id)
            ->with('success', 'فرم با موفقیت ثبت شد! (این یک نمونه است و داده‌ها ذخیره نشده‌اند)');
    }
}

