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
            [
                'id' => 'filters',
                'name' => 'افزودن فیلترهای بیشتر به جداول داده',
                'description' => 'این یک سیستم فیلتر است که به کاربران و ادمین‌ها کمک می‌کند تا در جداول داده بهتر جستجو کنند.',
                'icon' => '🔍',
                'status' => 'active',
                'routes_count' => 3,
            ],
        ];

        return view('home', compact('epics'));
    }
}
