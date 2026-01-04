<?php

namespace App\Http\Controllers;

use App\Models\NotificationTemplate;

class NotificationApiDocsController extends Controller
{
    public function index()
    {
        $approvedTemplates = NotificationTemplate::where('status', 'APPROVED')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('notifications.user.api-docs', compact('approvedTemplates'));
    }
}

