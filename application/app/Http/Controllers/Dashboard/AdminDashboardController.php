<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get running campaigns count
        $runningCampaigns = Campaign::where('status', 'running')->count();
        
        // Mock clicks per channel daily (last 7 days) - 5 channels
        $clicksPerChannel = [
            [
                'date' => now()->subDays(6)->format('Y-m-d'),
                'top_banner' => 12500,
                'icon_row_1_left' => 8900,
                'icon_row_1_left_middle' => 7600,
                'sms' => 15600,
                'mca' => 11200,
            ],
            [
                'date' => now()->subDays(5)->format('Y-m-d'),
                'top_banner' => 13200,
                'icon_row_1_left' => 9200,
                'icon_row_1_left_middle' => 8100,
                'sms' => 16200,
                'mca' => 11800,
            ],
            [
                'date' => now()->subDays(4)->format('Y-m-d'),
                'top_banner' => 11800,
                'icon_row_1_left' => 8500,
                'icon_row_1_left_middle' => 7200,
                'sms' => 14800,
                'mca' => 10800,
            ],
            [
                'date' => now()->subDays(3)->format('Y-m-d'),
                'top_banner' => 14100,
                'icon_row_1_left' => 9600,
                'icon_row_1_left_middle' => 8800,
                'sms' => 17100,
                'mca' => 12500,
            ],
            [
                'date' => now()->subDays(2)->format('Y-m-d'),
                'top_banner' => 12800,
                'icon_row_1_left' => 8800,
                'icon_row_1_left_middle' => 7900,
                'sms' => 15900,
                'mca' => 11500,
            ],
            [
                'date' => now()->subDays(1)->format('Y-m-d'),
                'top_banner' => 13500,
                'icon_row_1_left' => 9400,
                'icon_row_1_left_middle' => 8500,
                'sms' => 16400,
                'mca' => 12000,
            ],
            [
                'date' => now()->format('Y-m-d'),
                'top_banner' => 7200,
                'icon_row_1_left' => 5100,
                'icon_row_1_left_middle' => 4500,
                'sms' => 8900,
                'mca' => 6400,
            ],
        ];
        
        // Mock yesterday SMS stats
        $yesterdaySmsSent = 125000;
        $yesterdaySmsDelivered = 118500;
        $yesterdayDeliveryRate = round(($yesterdaySmsDelivered / $yesterdaySmsSent) * 100, 2);
        
        // Mock total SMS sending by each ECP account
        $ecpAccounts = [
            [
                'account_name' => 'حساب ECP-001',
                'total_sent' => 2500000,
                'queue_size' => 150000,
                'status' => 'فعال',
                'last_activity' => now()->subMinutes(5)->format('Y-m-d H:i'),
            ],
            [
                'account_name' => 'حساب ECP-002',
                'total_sent' => 1800000,
                'queue_size' => 0,
                'status' => 'فعال',
                'last_activity' => now()->subMinutes(2)->format('Y-m-d H:i'),
            ],
            [
                'account_name' => 'حساب ECP-003',
                'total_sent' => 3200000,
                'queue_size' => 450000,
                'status' => 'فعال',
                'last_activity' => now()->subMinutes(8)->format('Y-m-d H:i'),
            ],
            [
                'account_name' => 'حساب ECP-004',
                'total_sent' => 950000,
                'queue_size' => 0,
                'status' => 'فعال',
                'last_activity' => now()->subMinutes(1)->format('Y-m-d H:i'),
            ],
            [
                'account_name' => 'حساب ECP-005',
                'total_sent' => 4100000,
                'queue_size' => 680000,
                'status' => 'فعال',
                'last_activity' => now()->subMinutes(12)->format('Y-m-d H:i'),
            ],
        ];
        
        return view('dashboard.admin.index', compact(
            'runningCampaigns',
            'clicksPerChannel',
            'yesterdaySmsSent',
            'yesterdaySmsDelivered',
            'yesterdayDeliveryRate',
            'ecpAccounts'
        ));
    }
}

