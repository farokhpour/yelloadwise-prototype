<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);
        
        // Only show invoice if campaign is approved or beyond
        if (!in_array($campaign->status, ['waiting_payment', 'waiting_to_run', 'running', 'completed'])) {
            return redirect()->route('campaigns.show', $id)
                ->with('error', 'فاکتور برای این وضعیت کمپین در دسترس نیست');
        }

        return view('invoices.show', compact('campaign'));
    }
}
