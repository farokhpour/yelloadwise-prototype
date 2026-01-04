<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Helpers\MockDataHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $reportType = $request->get('report_type', '');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $invoiceStatus = $request->get('invoice_status');
        
        $data = [];
        
        // If no report type selected, return empty data
        if (empty($reportType)) {
            return view('report.admin.index', compact('reportType', 'data', 'startDate', 'endDate', 'invoiceStatus'));
        }
        
        // Get all campaigns for mock data
        $campaigns = Campaign::all();
        
        // Always use mock data for now (can be changed later to use real data when campaigns exist)
        $data = $this->getMockReportData($reportType, $startDate, $endDate, $invoiceStatus);
        
        // Uncomment below to use real data when campaigns exist
        /*
        if ($campaigns->isEmpty()) {
            $data = $this->getMockReportData($reportType, $startDate, $endDate, $invoiceStatus);
        } else {
            if ($reportType === 'debtor' || $reportType === 'internal') {
                // Filter by date if provided
                $query = Campaign::query();
                
                if ($startDate) {
                    $query->where(function($q) use ($startDate) {
                        $q->whereDate('started_at', '>=', $startDate)
                          ->orWhere(function($q2) use ($startDate) {
                              $q2->whereNull('started_at')->whereDate('created_at', '>=', $startDate);
                          });
                    });
                }
                
                if ($endDate) {
                    $query->where(function($q) use ($endDate) {
                        $q->whereDate('ended_at', '<=', $endDate)
                          ->orWhere(function($q2) use ($endDate) {
                              $q2->whereNull('ended_at')->whereDate('created_at', '<=', $endDate);
                          });
                    });
                }
                
                // For debtor campaigns, filter by status (waiting_payment = debtors)
                if ($reportType === 'debtor') {
                    $query->where('status', 'waiting_payment');
                }
                // For internal campaigns, show all campaigns (no status filter)
                
                $filteredCampaigns = $query->get();
                
                foreach ($filteredCampaigns as $campaign) {
                    $customer = MockDataHelper::getMockCustomerByCampaignId($campaign->id);
                    $data[] = [
                        'campaign_title' => $campaign->name,
                        'customer_name' => MockDataHelper::getCustomerName($customer),
                        'campaign_type' => MockDataHelper::getCampaignTypeByCampaignId($campaign->id),
                        'campaign_price' => ($campaign->cost_per_day ?? 0) * ($campaign->days ?? 1),
                        'campaign_start_date' => $campaign->started_at ? $campaign->started_at->format('Y-m-d') : '-',
                        'campaign_finished_date' => $campaign->ended_at ? $campaign->ended_at->format('Y-m-d') : '-',
                    ];
                }
            } elseif ($reportType === 'invoices') {
                // Filter campaigns for invoices
                $query = Campaign::query();
            
                if ($startDate) {
                    $query->where(function($q) use ($startDate) {
                        $q->whereDate('started_at', '>=', $startDate)
                          ->orWhere(function($q2) use ($startDate) {
                              $q2->whereNull('started_at')->whereDate('created_at', '>=', $startDate);
                          });
                    });
                }
                
                if ($endDate) {
                    $query->where(function($q) use ($endDate) {
                        $q->whereDate('ended_at', '<=', $endDate)
                          ->orWhere(function($q2) use ($endDate) {
                              $q2->whereNull('ended_at')->whereDate('created_at', '<=', $endDate);
                          });
                    });
                }
                
                // Filter by invoice status (mapped to campaign status)
                if ($invoiceStatus) {
                    $statusMap = [
                        'بدهکار' => 'waiting_payment',
                        'در انتظار پرداخت' => 'waiting_payment',
                        'پرداخت شده در انتظار شماره فاکتور' => 'waiting_to_run',
                        'پرداخت شده تمام شده' => 'completed',
                    ];
                    
                    if (isset($statusMap[$invoiceStatus])) {
                        $query->where('status', $statusMap[$invoiceStatus]);
                    }
                }
                
                $filteredCampaigns = $query->get();
                
                foreach ($filteredCampaigns as $campaign) {
                    $customer = MockDataHelper::getMockCustomerByCampaignId($campaign->id);
                    
                    // Map campaign status to invoice status
                    $invoiceStatusText = $this->mapStatusToInvoiceStatus($campaign->status);
                    
                    $data[] = [
                        'campaign_title' => $campaign->name,
                        'customer_name' => MockDataHelper::getCustomerName($customer),
                        'campaign_type' => MockDataHelper::getCampaignTypeByCampaignId($campaign->id),
                        'invoice_status' => $invoiceStatusText,
                        'invoice_price' => $campaign->cost_per_day ? ($campaign->cost_per_day * $campaign->days) : 0,
                        'invoice_number' => 'INV-' . str_pad($campaign->id, 6, '0', STR_PAD_LEFT),
                        'campaign_start_date' => $campaign->started_at ? $campaign->started_at->format('Y-m-d') : '-',
                        'campaign_finished_date' => $campaign->ended_at ? $campaign->ended_at->format('Y-m-d') : '-',
                    ];
                }
            }
        }
        */
        
        return view('report.admin.index', compact('reportType', 'data', 'startDate', 'endDate', 'invoiceStatus'));
    }
    
    public function export(Request $request)
    {
        $reportType = $request->get('report_type', 'debtor');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $invoiceStatus = $request->get('invoice_status');
        
        $data = [];
        
        // Get all campaigns
        $campaigns = Campaign::all();
        
        // If no campaigns exist, use mock data
        if ($campaigns->isEmpty()) {
            $data = $this->getMockReportData($reportType, $startDate, $endDate, $invoiceStatus);
        } else {
            // Get filtered data (same logic as index)
            if ($reportType === 'debtor' || $reportType === 'internal') {
                $query = Campaign::query();
            
                if ($startDate) {
                    $query->where(function($q) use ($startDate) {
                        $q->whereDate('started_at', '>=', $startDate)
                          ->orWhere(function($q2) use ($startDate) {
                              $q2->whereNull('started_at')->whereDate('created_at', '>=', $startDate);
                          });
                    });
                }
                
                if ($endDate) {
                    $query->where(function($q) use ($endDate) {
                        $q->whereDate('ended_at', '<=', $endDate)
                          ->orWhere(function($q2) use ($endDate) {
                              $q2->whereNull('ended_at')->whereDate('created_at', '<=', $endDate);
                          });
                    });
                }
                
                if ($reportType === 'debtor') {
                    $query->where('status', 'waiting_payment');
                }
                
                $filteredCampaigns = $query->get();
                
                foreach ($filteredCampaigns as $campaign) {
                    $customer = MockDataHelper::getMockCustomerByCampaignId($campaign->id);
                    $data[] = [
                        'campaign_title' => $campaign->name,
                        'customer_name' => MockDataHelper::getCustomerName($customer),
                        'campaign_type' => MockDataHelper::getCampaignTypeByCampaignId($campaign->id),
                        'campaign_price' => ($campaign->cost_per_day ?? 0) * ($campaign->days ?? 1),
                        'campaign_start_date' => $campaign->started_at ? $campaign->started_at->format('Y-m-d') : '-',
                        'campaign_finished_date' => $campaign->ended_at ? $campaign->ended_at->format('Y-m-d') : '-',
                    ];
                }
            } elseif ($reportType === 'invoices') {
                $query = Campaign::query();
                
                if ($startDate) {
                    $query->where(function($q) use ($startDate) {
                        $q->whereDate('started_at', '>=', $startDate)
                          ->orWhere(function($q2) use ($startDate) {
                              $q2->whereNull('started_at')->whereDate('created_at', '>=', $startDate);
                          });
                    });
                }
                
                if ($endDate) {
                    $query->where(function($q) use ($endDate) {
                        $q->whereDate('ended_at', '<=', $endDate)
                          ->orWhere(function($q2) use ($endDate) {
                              $q2->whereNull('ended_at')->whereDate('created_at', '<=', $endDate);
                          });
                    });
                }
                
                if ($invoiceStatus) {
                    $statusMap = [
                        'بدهکار' => 'waiting_payment',
                        'در انتظار پرداخت' => 'waiting_payment',
                        'پرداخت شده در انتظار شماره فاکتور' => 'waiting_to_run',
                        'پرداخت شده تمام شده' => 'completed',
                    ];
                    
                    if (isset($statusMap[$invoiceStatus])) {
                        $query->where('status', $statusMap[$invoiceStatus]);
                    }
                }
                
                $filteredCampaigns = $query->get();
                
                foreach ($filteredCampaigns as $campaign) {
                    $customer = MockDataHelper::getMockCustomerByCampaignId($campaign->id);
                    $invoiceStatusText = $this->mapStatusToInvoiceStatus($campaign->status);
                    
                    $data[] = [
                        'campaign_title' => $campaign->name,
                        'customer_name' => MockDataHelper::getCustomerName($customer),
                        'campaign_type' => MockDataHelper::getCampaignTypeByCampaignId($campaign->id),
                        'invoice_status' => $invoiceStatusText,
                        'invoice_price' => $campaign->cost_per_day ? ($campaign->cost_per_day * $campaign->days) : 0,
                        'invoice_number' => 'INV-' . str_pad($campaign->id, 6, '0', STR_PAD_LEFT),
                        'campaign_start_date' => $campaign->started_at ? $campaign->started_at->format('Y-m-d') : '-',
                        'campaign_finished_date' => $campaign->ended_at ? $campaign->ended_at->format('Y-m-d') : '-',
                    ];
                }
            }
        }
        
        // Generate CSV content
        $csvContent = '';
        
        // Set headers based on report type
        if ($reportType === 'debtor' || $reportType === 'internal') {
            // Add BOM for UTF-8 Excel compatibility
            $csvContent = "\xEF\xBB\xBF";
            $csvContent .= "عنوان کمپین,نام مشتری,نوع کمپین,قیمت کمپین,تاریخ شروع,تاریخ پایان\n";
            
            foreach ($data as $item) {
                $csvContent .= sprintf(
                    '"%s","%s","%s","%s","%s","%s"' . "\n",
                    $item['campaign_title'],
                    $item['customer_name'],
                    $item['campaign_type'],
                    number_format($item['campaign_price']),
                    $item['campaign_start_date'],
                    $item['campaign_finished_date']
                );
            }
        } else {
            // Add BOM for UTF-8 Excel compatibility
            $csvContent = "\xEF\xBB\xBF";
            $csvContent .= "عنوان کمپین,نام مشتری,نوع کمپین,وضعیت فاکتور,قیمت فاکتور,شماره فاکتور,تاریخ شروع,تاریخ پایان\n";
            
            foreach ($data as $item) {
                $csvContent .= sprintf(
                    '"%s","%s","%s","%s","%s","%s","%s","%s"' . "\n",
                    $item['campaign_title'],
                    $item['customer_name'],
                    $item['campaign_type'],
                    $item['invoice_status'],
                    number_format($item['invoice_price']),
                    $item['invoice_number'],
                    $item['campaign_start_date'],
                    $item['campaign_finished_date']
                );
            }
        }
        
        // Generate filename
        $reportNames = [
            'debtor' => 'کمپین_های_بدهکار',
            'internal' => 'کمپین_های_داخلی',
            'invoices' => 'فاکتورها',
        ];
        
        $filename = $reportNames[$reportType] . '_' . date('Y-m-d') . '.csv';
        
        return Response::make($csvContent, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
    
    private function mapStatusToInvoiceStatus($campaignStatus)
    {
        $statusMap = [
            'waiting_payment' => 'در انتظار پرداخت',
            'waiting_to_run' => 'پرداخت شده در انتظار شماره فاکتور',
            'completed' => 'پرداخت شده تمام شده',
            'running' => 'پرداخت شده تمام شده',
        ];
        
        return $statusMap[$campaignStatus] ?? 'بدهکار';
    }

    private function getMockReportData($reportType, $startDate = null, $endDate = null, $invoiceStatus = null)
    {
        $data = [];
        $customers = MockDataHelper::getMockCustomers();
        $campaignTypes = MockDataHelper::getCampaignTypes();
        $typeKeys = array_keys($campaignTypes);
        
        // Generate mock data based on report type
        if ($reportType === 'debtor') {
            // Mock debtor campaigns (waiting_payment status)
            for ($i = 1; $i <= 10; $i++) {
                $customer = $customers->values()->get(($i - 1) % $customers->count());
                $typeIndex = ($i - 1) % count($typeKeys);
                $startDateValue = $startDate ?: now()->subDays(rand(1, 30))->format('Y-m-d');
                $endDateValue = $endDate ?: now()->addDays(rand(1, 30))->format('Y-m-d');
                
                $data[] = [
                    'campaign_title' => 'کمپین بدهکار ' . $i,
                    'customer_name' => MockDataHelper::getCustomerName($customer),
                    'campaign_type' => $campaignTypes[$typeKeys[$typeIndex]],
                    'campaign_price' => rand(500000, 5000000),
                    'campaign_start_date' => $startDateValue,
                    'campaign_finished_date' => $endDateValue,
                ];
            }
        } elseif ($reportType === 'internal') {
            // Mock internal campaigns
            for ($i = 1; $i <= 15; $i++) {
                $customer = $customers->values()->get(($i - 1) % $customers->count());
                $typeIndex = ($i - 1) % count($typeKeys);
                $startDateValue = $startDate ?: now()->subDays(rand(1, 30))->format('Y-m-d');
                $endDateValue = $endDate ?: now()->addDays(rand(1, 30))->format('Y-m-d');
                
                $data[] = [
                    'campaign_title' => 'کمپین داخلی ' . $i,
                    'customer_name' => MockDataHelper::getCustomerName($customer),
                    'campaign_type' => $campaignTypes[$typeKeys[$typeIndex]],
                    'campaign_price' => rand(300000, 4000000),
                    'campaign_start_date' => $startDateValue,
                    'campaign_finished_date' => $endDateValue,
                ];
            }
        } elseif ($reportType === 'invoices') {
            // Mock invoices
            $invoiceStatuses = ['بدهکار', 'در انتظار پرداخت', 'پرداخت شده در انتظار شماره فاکتور', 'پرداخت شده تمام شده'];
            
            for ($i = 1; $i <= 12; $i++) {
                $customer = $customers->values()->get(($i - 1) % $customers->count());
                $typeIndex = ($i - 1) % count($typeKeys);
                $statusIndex = ($i - 1) % count($invoiceStatuses);
                $invoiceStatusValue = $invoiceStatuses[$statusIndex];
                
                // Filter by invoice status if provided
                if ($invoiceStatus && $invoiceStatus !== $invoiceStatusValue) {
                    continue;
                }
                
                $startDateValue = $startDate ?: now()->subDays(rand(1, 30))->format('Y-m-d');
                $endDateValue = $endDate ?: now()->addDays(rand(1, 30))->format('Y-m-d');
                
                $data[] = [
                    'campaign_title' => 'کمپین فاکتور ' . $i,
                    'customer_name' => MockDataHelper::getCustomerName($customer),
                    'campaign_type' => $campaignTypes[$typeKeys[$typeIndex]],
                    'invoice_status' => $invoiceStatusValue,
                    'invoice_price' => rand(400000, 6000000),
                    'invoice_number' => 'INV-' . str_pad($i, 6, '0', STR_PAD_LEFT),
                    'campaign_start_date' => $startDateValue,
                    'campaign_finished_date' => $endDateValue,
                ];
            }
        }
        
        return $data;
    }
}

