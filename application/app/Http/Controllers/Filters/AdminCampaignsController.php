<?php

namespace App\Http\Controllers\Filters;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Helpers\MockDataHelper;
use Illuminate\Http\Request;

class AdminCampaignsController extends Controller
{
    public function index(Request $request)
    {
        $query = Campaign::query();
        $customers = MockDataHelper::getMockCustomers();

        // Apply filters
        if ($request->filled('campaign_name')) {
            $query->where('name', 'like', '%' . $request->campaign_name . '%');
        }

        if ($request->filled('customer')) {
            $searchTerm = $request->customer;
            $matchingCustomerIds = $customers->filter(function($customer) use ($searchTerm) {
                $name = MockDataHelper::getCustomerName($customer);
                return stripos($name, $searchTerm) !== false ||
                       stripos($customer['email'] ?? '', $searchTerm) !== false ||
                       stripos($customer['phone'] ?? '', $searchTerm) !== false ||
                       stripos($customer['first_name'] ?? '', $searchTerm) !== false ||
                       stripos($customer['last_name'] ?? '', $searchTerm) !== false ||
                       stripos($customer['brand_name'] ?? '', $searchTerm) !== false;
            })->pluck('id')->toArray();
            
            // For now, we'll filter campaigns by matching customer IDs
            // In real app, this would be: $query->whereIn('customer_id', $matchingCustomerIds);
            // For mock, we'll assign customer_id based on campaign id modulo
        }

        if ($request->filled('campaign_type')) {
            // Filter by campaign type - stored in a JSON field or separate column
            // For now, we'll handle this in the view
        }

        if ($request->filled('campaign_status')) {
            $query->where('status', $request->campaign_status);
        }

        if ($request->filled('campaign_id')) {
            $query->where('id', $request->campaign_id);
        }

        $campaigns = $query->orderBy('created_at', 'desc')->get();
        
        // Add customer names and campaign types to campaigns
        $campaigns = $campaigns->map(function($campaign) use ($customers) {
            // Assign customer based on campaign id (mock)
            $customerId = ($campaign->id % count($customers)) + 1;
            $customer = $customers->firstWhere('id', $customerId);
            $campaign->customer_name = $customer ? MockDataHelper::getCustomerName($customer) : '-';
            $campaign->customer_id = $customerId;
            
            // Assign campaign type based on campaign id (mock)
            $types = MockDataHelper::getCampaignTypes();
            $typeKeys = array_keys($types);
            $typeIndex = ($campaign->id % count($typeKeys));
            $campaign->campaign_type = $typeKeys[$typeIndex];
            $campaign->campaign_type_label = $types[$typeKeys[$typeIndex]];
            
            return $campaign;
        });

        // Apply customer filter if needed
        if ($request->filled('customer')) {
            $searchTerm = $request->customer;
            $campaigns = $campaigns->filter(function($campaign) use ($searchTerm, $customers) {
                $customer = $customers->firstWhere('id', $campaign->customer_id);
                if (!$customer) return false;
                $name = MockDataHelper::getCustomerName($customer);
                return stripos($name, $searchTerm) !== false ||
                       stripos($customer['email'] ?? '', $searchTerm) !== false ||
                       stripos($customer['phone'] ?? '', $searchTerm) !== false;
            });
        }

        // Apply campaign type filter if needed
        if ($request->filled('campaign_type')) {
            $campaigns = $campaigns->where('campaign_type', $request->campaign_type);
        }

        return view('filters.admin.campaigns', compact('campaigns'));
    }
}

