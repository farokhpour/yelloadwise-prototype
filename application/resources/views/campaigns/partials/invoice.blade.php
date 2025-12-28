<div style="max-width: 800px; margin: 0 auto;">
    <div style="background: white; padding: 3rem; border: 2px solid #dee2e6; border-radius: 8px;">
        <!-- Invoice Header -->
        <div style="text-align: center; margin-bottom: 3rem; border-bottom: 2px solid #dee2e6; padding-bottom: 2rem;">
            <h1 style="color: #007bff; margin-bottom: 0.5rem;">فاکتور</h1>
            <p style="color: #666; margin: 0;">خدمات تبلیغات کمپین</p>
        </div>

        <!-- Invoice Details -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <div>
                <h3 style="color: #333; margin-bottom: 1rem;">صورتحساب به:</h3>
                <p style="margin: 0.25rem 0; color: #666;">کمپین: {{ $campaign->name }}</p>
                <p style="margin: 0.25rem 0; color: #666;">تاریخ فاکتور: {{ $campaign->approved_at ? $campaign->approved_at->format('Y-m-d') : now()->format('Y-m-d') }}</p>
                <p style="margin: 0.25rem 0; color: #666;">شماره فاکتور: INV-{{ str_pad($campaign->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div style="text-align: right;">
                <h3 style="color: #333; margin-bottom: 1rem;">جزئیات کمپین:</h3>
                <p style="margin: 0.25rem 0; color: #666;">وضعیت: 
                    @if($campaign->status === 'waiting_payment') در انتظار پرداخت
                    @elseif($campaign->status === 'waiting_to_run') آماده اجرا
                    @elseif($campaign->status === 'running') در حال اجرا
                    @elseif($campaign->status === 'completed') تکمیل شده
                    @else {{ $campaign->status }}
                    @endif
                </p>
                <p style="margin: 0.25rem 0; color: #666;">مدت زمان: {{ $campaign->days }} روز</p>
                <p style="margin: 0.25rem 0; color: #666;">وسایل نقلیه: {{ $campaign->cars }} ماشین</p>
            </div>
        </div>

        <!-- Invoice Items -->
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 2rem;">
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                    <th style="padding: 1rem; text-align: right;">توضیحات</th>
                    <th style="padding: 1rem; text-align: center;">تعداد</th>
                    <th style="padding: 1rem; text-align: left;">قیمت واحد</th>
                    <th style="padding: 1rem; text-align: left;">جمع</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 1rem;">تبلیغات نمایشگر تاکسی دیجیتال</td>
                    <td style="padding: 1rem; text-align: center;">{{ $campaign->days }} روز</td>
                    <td style="padding: 1rem; text-align: left;" class="ltr">${{ number_format($campaign->cost_per_day ?? 0, 2) }}</td>
                    <td style="padding: 1rem; text-align: left;" class="ltr">${{ number_format(($campaign->cost_per_day ?? 0) * $campaign->days, 2) }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 1rem;">تعداد وسایل نقلیه</td>
                    <td style="padding: 1rem; text-align: center;">{{ $campaign->cars }} ماشین</td>
                    <td style="padding: 1rem; text-align: left;">-</td>
                    <td style="padding: 1rem; text-align: left;">-</td>
                </tr>
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 1rem;">موقعیت‌ها</td>
                    <td style="padding: 1rem; text-align: center;">{{ count($campaign->locations) }} مسیر</td>
                    <td style="padding: 1rem; text-align: left;">-</td>
                    <td style="padding: 1rem; text-align: left;">-</td>
                </tr>
            </tbody>
        </table>

        <!-- Invoice Total -->
        <div style="display: flex; justify-content: flex-start; margin-bottom: 2rem;">
            <div style="width: 300px;">
                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #dee2e6;">
                    <span style="font-weight: 600;">جمع کل:</span>
                    <span class="ltr">${{ number_format(($campaign->cost_per_day ?? 0) * $campaign->days, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid #dee2e6;">
                    <span style="font-weight: 600;">مالیات (0%):</span>
                    <span class="ltr">$0.00</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 1rem 0; background: #f8f9fa; margin-top: 1rem; border-radius: 4px; padding-left: 1rem; padding-right: 1rem;">
                    <span style="font-weight: bold; font-size: 1.2rem;">مجموع:</span>
                    <span style="font-weight: bold; font-size: 1.2rem; color: #28a745;" class="ltr">${{ number_format($campaign->total_cost, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Invoice Footer -->
        <div style="text-align: center; padding-top: 2rem; border-top: 2px solid #dee2e6; color: #666;">
            <p style="margin: 0.5rem 0;">از همکاری شما متشکریم!</p>
            <p style="margin: 0.5rem 0; font-size: 0.875rem;">این یک فاکتور پروتوتایپ برای اهداف نمایشی است.</p>
        </div>
    </div>
</div>
