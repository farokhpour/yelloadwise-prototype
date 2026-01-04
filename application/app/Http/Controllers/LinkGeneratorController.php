<?php

namespace App\Http\Controllers;

use App\Models\LinkGenerator;
use App\Models\LinkClick;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkGeneratorController extends Controller
{
    public function epicIndex()
    {
        return view('link-generator.epic-index');
    }

    public function index()
    {
        $links = LinkGenerator::with('campaign')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('link-generator.index', compact('links'));
    }

    public function create()
    {
        $campaigns = Campaign::all();
        return view('link-generator.create', compact('campaigns'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'landing_url' => 'required|url',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'utms' => 'required|array|min:1',
            'utms.*.key' => 'required|string|max:255',
            'utms.*.value' => 'required|string|max:255',
        ]);

        // Generate the link
        $linkGenerator = new LinkGenerator();
        $linkGenerator->landing_url = $validated['landing_url'];
        $linkGenerator->utms = $validated['utms'];
        $linkGenerator->campaign_id = $validated['campaign_id'] ?? null;
        
        // Get campaign info if provided
        if ($linkGenerator->campaign_id) {
            $campaign = Campaign::find($linkGenerator->campaign_id);
            $linkGenerator->campaign_name = $campaign->name;
            $linkGenerator->campaign_type = $campaign->type ?? 'digital-taxi';
            // Get customer name from campaign if available
            $linkGenerator->customer_name = 'مشتری ' . $campaign->id; // Mock for now
        }
        
        $linkGenerator->generated_link = $linkGenerator->generateLink();
        $linkGenerator->token = $linkGenerator->generateToken();
        $linkGenerator->save();

        return redirect()->route('epics.link-generator.index')
            ->with('success', 'لینک با موفقیت ایجاد شد!');
    }

    public function edit($id)
    {
        $link = LinkGenerator::findOrFail($id);
        $campaigns = Campaign::all();
        return view('link-generator.edit', compact('link', 'campaigns'));
    }

    public function update(Request $request, $id)
    {
        $link = LinkGenerator::findOrFail($id);
        
        $validated = $request->validate([
            'landing_url' => 'required|url',
            'campaign_id' => 'nullable|exists:campaigns,id',
            'utms' => 'required|array|min:1',
            'utms.*.key' => 'required|string|max:255',
            'utms.*.value' => 'required|string|max:255',
        ]);

        $link->landing_url = $validated['landing_url'];
        $link->utms = $validated['utms'];
        $link->campaign_id = $validated['campaign_id'] ?? null;
        
        // Update campaign info if provided
        if ($link->campaign_id) {
            $campaign = Campaign::find($link->campaign_id);
            $link->campaign_name = $campaign->name;
            $link->campaign_type = $campaign->type ?? 'digital-taxi';
            $link->customer_name = 'مشتری ' . $campaign->id; // Mock for now
        } else {
            $link->campaign_name = null;
            $link->campaign_type = null;
            $link->customer_name = null;
        }
        
        $link->generated_link = $link->generateLink();
        // Generate token if not exists
        if (!$link->token) {
            $link->token = $link->generateToken();
        }
        $link->save();

        return redirect()->route('epics.link-generator.index')
            ->with('success', 'لینک با موفقیت به‌روزرسانی شد!');
    }

    public function report($id)
    {
        $link = LinkGenerator::findOrFail($id);
        
        // Get click data for the last 30 days
        $startDate = now()->subDays(30);
        $clicks = LinkClick::where('link_generator_id', $id)
            ->where('click_date', '>=', $startDate)
            ->orderBy('click_date', 'asc')
            ->get();
        
        // Prepare data for chart
        $chartData = [];
        $chartLabels = [];
        
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $clickRecord = $clicks->firstWhere('click_date', $date);
            $chartLabels[] = now()->subDays($i)->format('Y-m-d');
            $chartData[] = $clickRecord ? $clickRecord->clicks_count : 0;
        }
        
        return view('link-generator.report', compact('link', 'chartLabels', 'chartData'));
    }

    public function redirect($token)
    {
        $link = LinkGenerator::where('token', $token)->firstOrFail();
        
        // Increment click count
        $link->incrementClick();
        
        // Redirect to the generated link
        return redirect($link->generated_link);
    }
}

