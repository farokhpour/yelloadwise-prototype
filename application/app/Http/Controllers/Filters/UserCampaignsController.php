<?php

namespace App\Http\Controllers\Filters;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Helpers\MockDataHelper;
use Illuminate\Http\Request;

class UserCampaignsController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::query();

        // Apply filters
        if ($request->filled('campaign_name')) {
            $query->where('name', 'like', '%' . $request->campaign_name . '%');
        }

        if ($request->filled('campaign_status')) {
            $query->where('status', $request->campaign_status);
        }

        $campaigns = $query->orderBy('created_at', 'desc')->get();
        
        // Add campaign types to campaigns
        $campaigns = $campaigns->map(function($campaign) {
            // Assign campaign type based on campaign id (mock)
            $types = MockDataHelper::getCampaignTypes();
            $typeKeys = array_keys($types);
            $typeIndex = ($campaign->id % count($typeKeys));
            $campaign->campaign_type = $typeKeys[$typeIndex];
            $campaign->campaign_type_label = $types[$typeKeys[$typeIndex]];
            
            return $campaign;
        });

        // Apply campaign type filter if needed
        if ($request->filled('campaign_type')) {
            $campaigns = $campaigns->where('campaign_type', $request->campaign_type);
        }

        return view('filters.user.campaigns', compact('campaigns'));
    }
}

