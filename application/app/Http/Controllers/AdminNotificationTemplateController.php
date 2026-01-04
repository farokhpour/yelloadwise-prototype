<?php

namespace App\Http\Controllers;

use App\Models\NotificationTemplate;
use Illuminate\Http\Request;

class AdminNotificationTemplateController extends Controller
{
    public function index()
    {
        $templates = NotificationTemplate::orderBy('created_at', 'desc')->get();
        return view('notifications.admin.templates.index', compact('templates'));
    }

    public function approve($id)
    {
        $template = NotificationTemplate::findOrFail($id);
        $template->status = 'APPROVED';
        $template->admin_comment = null;
        $template->save();

        return redirect()->route('epics.notifications.admin.templates.index')
            ->with('success', 'قالب با موفقیت تایید شد.');
    }

    public function return(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $template = NotificationTemplate::findOrFail($id);
        $template->status = 'RETURNED';
        $template->admin_comment = $validated['comment'];
        $template->save();

        return redirect()->route('epics.notifications.admin.templates.index')
            ->with('success', 'قالب با موفقیت برگشت داده شد.');
    }
}

