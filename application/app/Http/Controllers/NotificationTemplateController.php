<?php

namespace App\Http\Controllers;

use App\Models\NotificationTemplate;
use Illuminate\Http\Request;

class NotificationTemplateController extends Controller
{
    public function index()
    {
        $templates = NotificationTemplate::orderBy('created_at', 'desc')->get();
        return view('notifications.user.templates.index', compact('templates'));
    }

    public function create()
    {
        return view('notifications.user.templates.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:OTP,WALLET,ORDER',
            ]);

            // Build config based on type
            $config = [];
            if ($validated['type'] === 'OTP') {
                $request->validate([
                    'config.brand_name' => 'required|string|max:255',
                ]);
                $config = [
                    'brand_name' => $request->input('config.brand_name'),
                ];
            } elseif ($validated['type'] === 'WALLET') {
                $request->validate([
                    'config.brand_name' => 'required|string|max:255',
                    'config.operation_type' => 'required|in:Credit,Debit',
                ]);
                $config = [
                    'brand_name' => $request->input('config.brand_name'),
                    'operation_type' => $request->input('config.operation_type'),
                    'show_balance' => $request->has('config.show_balance'),
                    'show_amount' => $request->has('config.show_amount'),
                ];
            } elseif ($validated['type'] === 'ORDER') {
                $request->validate([
                    'config.brand_name' => 'required|string|max:255',
                    'config.order_event' => 'required|in:Created,Paid,Shipped',
                ]);
                $config = [
                    'order_event' => $request->input('config.order_event'),
                    'brand_name' => $request->input('config.brand_name'),
                    'show_amount' => $request->has('config.show_amount'),
                    'show_order_link' => $request->has('config.show_order_link'),
                ];
            }

            $template = new NotificationTemplate();
            $template->type = $validated['type'];
            $template->status = 'PENDING';
            $template->config = $config;
            $template->preview = $this->generatePreview($validated['type'], $config);
            $template->save();

            return redirect()->route('epics.notifications.user.templates.index')
                ->with('success', 'قالب با موفقیت ایجاد شد و در انتظار تایید ادمین است.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'خطا در ایجاد قالب: ' . $e->getMessage());
        }
    }

    private function generatePreview($type, $config)
    {
        switch ($type) {
            case 'OTP':
                return $config['brand_name'] . "\nکد تأیید شما: {{otp_code}}";
            
            case 'WALLET':
                $operation = $config['operation_type'] === 'Credit' ? 'افزایش' : 'کاهش';
                $amount = isset($config['show_amount']) && $config['show_amount'] ? "\nمبلغ: {{amount}}" : '';
                $balance = isset($config['show_balance']) && $config['show_balance'] ? "\nموجودی: {{balance}}" : '';
                return $config['brand_name'] . "\nعملیات " . $operation . " انجام شد." . $amount . $balance;
            
            case 'ORDER':
                $eventMap = [
                    'Created' => 'ایجاد شد',
                    'Paid' => 'پرداخت شد',
                    'Shipped' => 'ارسال شد',
                ];
                $event = $eventMap[$config['order_event']] ?? $config['order_event'];
                $amount = isset($config['show_amount']) && $config['show_amount'] ? "\nمبلغ: {{amount}}" : '';
                $link = isset($config['show_order_link']) && $config['show_order_link'] ? "\nلینک مشاهده سفارش: {{order_link}}" : '';
                return $config['brand_name'] . "\nسفارش شما " . $event . " شد." . $amount . $link;
            
            default:
                return '';
        }
    }
}

