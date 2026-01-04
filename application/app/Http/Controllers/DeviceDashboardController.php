<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceDashboardController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 20; // 5 rows x 4 columns
        $page = $request->get('page', 1);
        $totalMockDevices = 100;
        
        // Always generate mock data for dashboard (100 devices)
        $devices = $this->generateMockDevices($page, $perPage, $totalMockDevices);
        $totalPages = ceil($totalMockDevices / $perPage);
        
        return view('devices.dashboard', compact('devices', 'page', 'totalPages'));
    }
    
    private function generateMockDevices($page, $perPage, $totalDevices = 100)
    {
        $mockDevices = [];
        $startIndex = ($page - 1) * $perPage;
        
        $firstNames = ['علی', 'محمد', 'حسن', 'حسین', 'رضا', 'احمد', 'مهدی', 'امیر', 'سعید', 'فرهاد', 'کامران', 'بهرام', 'داریوش', 'آرش', 'پویا', 'نیما', 'سینا', 'امید', 'پیمان', 'فرزاد', 'رضوان', 'سامان', 'ایمان', 'کیوان', 'آرمان', 'بابک', 'پوریا', 'شایان', 'یاسین', 'مبین'];
        $lastNames = ['احمدی', 'محمدی', 'حسینی', 'رضایی', 'کریمی', 'نوری', 'صادقی', 'جعفری', 'موسوی', 'حیدری', 'کاظمی', 'زمانی', 'رحیمی', 'شریفی', 'نظری', 'قاسمی', 'اکبری', 'عباسی', 'طاهری', 'میرزایی', 'کرمی', 'نادری', 'صالحی', 'موسوی', 'حسنی', 'رستمی', 'فرهادی', 'مهدوی', 'نوری', 'صادقی'];
        
        // High-quality animated GIFs that fill the space well
        $campaigns = [
            ['name' => 'کمپین پپسی', 'gif' => 'https://media.giphy.com/media/l0MYC0LajVPoWe3nq/giphy.gif'],
            ['name' => 'کمپین کوکاکولا', 'gif' => 'https://media.giphy.com/media/3o7aD2saalvxSSzB0s/giphy.gif'],
            ['name' => 'کمپین مک‌دونالد', 'gif' => 'https://media.giphy.com/media/l0HlBO7eyXzSZkJri/giphy.gif'],
            ['name' => 'کمپین سامسونگ', 'gif' => 'https://media.giphy.com/media/3o7aD2saalvxSSzB0s/giphy.gif'],
            ['name' => 'کمپین اپل', 'gif' => 'https://media.giphy.com/media/l0HlBO7eyXzSZkJri/giphy.gif'],
            ['name' => 'کمپین نایک', 'gif' => 'https://media.giphy.com/media/3o7abKhOpu0NwenH3O/giphy.gif'],
            ['name' => 'کمپین آدیداس', 'gif' => 'https://media.giphy.com/media/l0MYC0LajVPoWe3nq/giphy.gif'],
            ['name' => 'کمپین بنز', 'gif' => 'https://media.giphy.com/media/3o7aCTPPm4OHfRLSH6/giphy.gif'],
            ['name' => 'کمپین بی‌ام‌دبلیو', 'gif' => 'https://media.giphy.com/media/l0HlBO7eyXzSZkJri/giphy.gif'],
            ['name' => 'کمپین تسلا', 'gif' => 'https://media.giphy.com/media/3o7aD2saalvxSSzB0s/giphy.gif'],
            ['name' => 'کمپین آمازون', 'gif' => 'https://media.giphy.com/media/3o7abKhOpu0NwenH3O/giphy.gif'],
            ['name' => 'کمپین گوگل', 'gif' => 'https://media.giphy.com/media/l0MYC0LajVPoWe3nq/giphy.gif'],
            ['name' => 'کمپین مایکروسافت', 'gif' => 'https://media.giphy.com/media/3o7aCTPPm4OHfRLSH6/giphy.gif'],
            ['name' => 'کمپین فیسبوک', 'gif' => 'https://media.giphy.com/media/l0HlBO7eyXzSZkJri/giphy.gif'],
            ['name' => 'کمپین اینستاگرام', 'gif' => 'https://media.giphy.com/media/3o7aD2saalvxSSzB0s/giphy.gif'],
            ['name' => 'کمپین توییتر', 'gif' => 'https://media.giphy.com/media/3o7abKhOpu0NwenH3O/giphy.gif'],
            ['name' => 'کمپین یوتیوب', 'gif' => 'https://media.giphy.com/media/l0MYC0LajVPoWe3nq/giphy.gif'],
            ['name' => 'کمپین نتفلیکس', 'gif' => 'https://media.giphy.com/media/3o7aCTPPm4OHfRLSH6/giphy.gif'],
            ['name' => 'کمپین اسپاتیفای', 'gif' => 'https://media.giphy.com/media/l0HlBO7eyXzSZkJri/giphy.gif'],
            ['name' => 'کمپین اوبر', 'gif' => 'https://media.giphy.com/media/3o7aD2saalvxSSzB0s/giphy.gif'],
        ];
        
        // Use a seed based on device index to ensure consistent random assignment
        mt_srand($startIndex);
        
        for ($i = 0; $i < $perPage; $i++) {
            $deviceIndex = $startIndex + $i + 1;
            
            // Consistent random selection for each device
            $firstNameIndex = ($deviceIndex * 7) % count($firstNames);
            $lastNameIndex = ($deviceIndex * 11) % count($lastNames);
            $campaignIndex = ($deviceIndex * 13) % count($campaigns);
            $statusRandom = ($deviceIndex * 17) % 100;
            
            $firstName = $firstNames[$firstNameIndex];
            $lastName = $lastNames[$lastNameIndex];
            $campaign = $campaigns[$campaignIndex];
            
            // 70% chance of being live, 30% offline
            $status = $statusRandom < 70 ? 'live' : 'offline';
            
            // For live devices, last update is recent (0-10 minutes ago)
            // For offline devices, last update is older (10-30 minutes ago)
            $minutesAgo = $status === 'live' ? rand(0, 10) : rand(10, 30);
            
            $mockDevices[] = (object)[
                'id' => $deviceIndex,
                'device_id' => 'DEV-' . str_pad($deviceIndex, 3, '0', STR_PAD_LEFT),
                'owner_first_name' => $firstName,
                'owner_last_name' => $lastName,
                'status' => $status,
                'campaign_name' => $campaign['name'],
                'campaign_gif' => $campaign['gif'],
                'last_status_updated_at' => now()->subMinutes($minutesAgo),
            ];
        }
        
        return collect($mockDevices);
    }
}

