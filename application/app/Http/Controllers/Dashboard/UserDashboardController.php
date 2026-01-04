<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Get total campaigns count
        $totalCampaigns = Campaign::count();
        
        // Get running campaigns count
        $runningCampaigns = Campaign::where('status', 'running')->count();
        
        // Mock wallet balance (in a real app, this would come from a wallet/balance table)
        $walletBalance = 1250000; // 1,250,000 Toman
        
        // Mock last 10 transactions
        $transactions = [
            [
                'id' => 1,
                'type' => 'پرداخت',
                'amount' => 500000,
                'description' => 'پرداخت کمپین #123',
                'date' => now()->subHours(2)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 2,
                'type' => 'شارژ',
                'amount' => 2000000,
                'description' => 'شارژ کیف پول',
                'date' => now()->subDays(1)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 3,
                'type' => 'پرداخت',
                'amount' => 750000,
                'description' => 'پرداخت کمپین #120',
                'date' => now()->subDays(2)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 4,
                'type' => 'بازگشت',
                'amount' => 300000,
                'description' => 'بازگشت وجه کمپین #115',
                'date' => now()->subDays(3)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 5,
                'type' => 'پرداخت',
                'amount' => 450000,
                'description' => 'پرداخت کمپین #118',
                'date' => now()->subDays(4)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 6,
                'type' => 'شارژ',
                'amount' => 1500000,
                'description' => 'شارژ کیف پول',
                'date' => now()->subDays(5)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 7,
                'type' => 'پرداخت',
                'amount' => 600000,
                'description' => 'پرداخت کمپین #112',
                'date' => now()->subDays(6)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 8,
                'type' => 'پرداخت',
                'amount' => 800000,
                'description' => 'پرداخت کمپین #110',
                'date' => now()->subDays(7)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 9,
                'type' => 'شارژ',
                'amount' => 1000000,
                'description' => 'شارژ کیف پول',
                'date' => now()->subDays(8)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
            [
                'id' => 10,
                'type' => 'پرداخت',
                'amount' => 350000,
                'description' => 'پرداخت کمپین #108',
                'date' => now()->subDays(9)->format('Y-m-d H:i'),
                'status' => 'موفق',
            ],
        ];
        
        return view('dashboard.user.index', compact('totalCampaigns', 'runningCampaigns', 'walletBalance', 'transactions'));
    }
}

