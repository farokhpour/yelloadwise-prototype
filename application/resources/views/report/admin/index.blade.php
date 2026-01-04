@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="margin-bottom: 2rem; color: #333;">گزارش‌های ادمین</h1>
    
    <!-- Report Type Selection -->
    <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <form method="GET" action="{{ route('epics.report.admin') }}" id="reportForm">
            <div style="display: grid; grid-template-columns: 1fr auto; gap: 1rem; align-items: end;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">نوع گزارش</label>
                    <select name="report_type" id="report_type" 
                            style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;"
                            onchange="document.getElementById('reportForm').submit();">
                        <option value="" {{ !$reportType || $reportType === '' ? 'selected' : '' }}>انتخاب گزارش</option>
                        <option value="debtor" {{ $reportType === 'debtor' ? 'selected' : '' }}>کمپین‌های بدهکار</option>
                        <option value="internal" {{ $reportType === 'internal' ? 'selected' : '' }}>کمپین‌های داخلی</option>
                        <option value="invoices" {{ $reportType === 'invoices' ? 'selected' : '' }}>فاکتورها</option>
                    </select>
                </div>
                
                <div>
                    @php
                        $exportParams = [
                            'report_type' => $reportType ?? request('report_type', ''),
                            'start_date' => request('start_date'),
                            'end_date' => request('end_date'),
                            'invoice_status' => request('invoice_status'),
                        ];
                        $exportParams = array_filter($exportParams); // Remove null/empty values
                        $exportUrl = route('epics.report.export') . '?' . http_build_query($exportParams);
                    @endphp
                    <a href="{{ $exportUrl }}" 
                       style="display: inline-block; padding: 0.75rem 1.5rem; background: {{ $reportType ? '#28a745' : '#6c757d' }}; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; white-space: nowrap; text-align: center; transition: all 0.3s; {{ !$reportType ? 'pointer-events: none; cursor: not-allowed;' : '' }}"
                       @if($reportType)
                       onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                       onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';"
                       @endif>
                        📥 خروجی Excel
                    </a>
                </div>
            </div>
            
            <!-- Filters Section -->
            @if($reportType)
            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #eee;">
                <div style="display: grid; grid-template-columns: 1fr 1fr @if($reportType === 'invoices') 1fr @endif auto; gap: 1rem; align-items: end;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">از تاریخ</label>
                        <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" 
                               style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">تا تاریخ</label>
                        <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" 
                               style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    </div>
                    
                    @if($reportType === 'invoices')
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">وضعیت فاکتور</label>
                            <select name="invoice_status" id="invoice_status" style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                                <option value="">همه وضعیت‌ها</option>
                                <option value="بدهکار" {{ $invoiceStatus === 'بدهکار' ? 'selected' : '' }}>بدهکار</option>
                                <option value="در انتظار پرداخت" {{ $invoiceStatus === 'در انتظار پرداخت' ? 'selected' : '' }}>در انتظار پرداخت</option>
                                <option value="پرداخت شده در انتظار شماره فاکتور" {{ $invoiceStatus === 'پرداخت شده در انتظار شماره فاکتور' ? 'selected' : '' }}>پرداخت شده در انتظار شماره فاکتور</option>
                                <option value="پرداخت شده تمام شده" {{ $invoiceStatus === 'پرداخت شده تمام شده' ? 'selected' : '' }}>پرداخت شده تمام شده</option>
                            </select>
                        </div>
                    @endif
                    
                    <div>
                        <button type="submit" style="padding: 0.75rem 1.5rem; background: #007bff; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; white-space: nowrap;">
                            🔍 جستجو
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </form>
    </div>
    
    <!-- Report Table -->
    @if($reportType)
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
        @if($reportType === 'debtor' || $reportType === 'internal')
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">عنوان کمپین</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نام مشتری</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نوع کمپین</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">قیمت کمپین</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">تاریخ شروع</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">تاریخ پایان</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem; font-weight: 500;">{{ $row['campaign_title'] }}</td>
                            <td style="padding: 1rem;">{{ $row['customer_name'] }}</td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #6c757d; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ $row['campaign_type'] }}
                                </span>
                            </td>
                            <td style="padding: 1rem; font-weight: 600; color: #333;">{{ number_format($row['campaign_price']) }} تومان</td>
                            <td style="padding: 1rem; color: #666;">{{ $row['campaign_start_date'] }}</td>
                            <td style="padding: 1rem; color: #666;">{{ $row['campaign_finished_date'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 3rem; text-align: center; color: #666;">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                                <p style="font-size: 1.1rem;">هیچ داده‌ای یافت نشد</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @elseif($reportType === 'invoices')
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">عنوان کمپین</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نام مشتری</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نوع کمپین</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">وضعیت فاکتور</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">قیمت فاکتور</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">شماره فاکتور</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">تاریخ شروع</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">تاریخ پایان</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem; font-weight: 500;">{{ $row['campaign_title'] }}</td>
                            <td style="padding: 1rem;">{{ $row['customer_name'] }}</td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #6c757d; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ $row['campaign_type'] }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: 
                                    @if($row['invoice_status'] === 'بدهکار') #6c757d
                                    @elseif($row['invoice_status'] === 'در انتظار پرداخت') #ffc107
                                    @elseif($row['invoice_status'] === 'پرداخت شده در انتظار شماره فاکتور') #007bff
                                    @else #28a745
                                    @endif; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ $row['invoice_status'] }}
                                </span>
                            </td>
                            <td style="padding: 1rem; font-weight: 600; color: #333;">{{ number_format($row['invoice_price']) }} تومان</td>
                            <td style="padding: 1rem; color: #666;">{{ $row['invoice_number'] }}</td>
                            <td style="padding: 1rem; color: #666;">{{ $row['campaign_start_date'] }}</td>
                            <td style="padding: 1rem; color: #666;">{{ $row['campaign_finished_date'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding: 3rem; text-align: center; color: #666;">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                                <p style="font-size: 1.1rem;">هیچ داده‌ای یافت نشد</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>
    @else
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 3rem; text-align: center;">
        <div style="font-size: 4rem; margin-bottom: 1rem;">📋</div>
        <p style="font-size: 1.2rem; color: #666;">لطفاً نوع گزارش را انتخاب کنید</p>
    </div>
    @endif
</div>

@endsection

