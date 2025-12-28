<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $epics = [
            [
                'id' => 'digital-taxi-rooftop',
                'name' => 'کمپین نمایشگر تاکسی دیجیتال',
                'description' => 'سیستم کامل مدیریت کمپین برای تبلیغات نمایشگر تاکسی دیجیتال',
                'icon' => '🚗',
                'status' => 'active',
                'routes_count' => 8,
            ],
            // Future epics can be added here
        ];

        return view('home', compact('epics'));
    }
}
