<div style="max-width: 1200px; margin: 0 auto;">
    <!-- Summary Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem; border-radius: 12px; color: white;">
            <h3 style="margin: 0 0 0.5rem 0; font-size: 0.9rem; opacity: 0.9;">ماشین‌های در حال اجرا</h3>
            <p style="margin: 0; font-size: 2.5rem; font-weight: bold;">{{ $campaign->cars }}</p>
            <p style="margin: 0.5rem 0 0 0; font-size: 0.875rem; opacity: 0.8;">وسایل نقلیه فعال</p>
        </div>

        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); padding: 2rem; border-radius: 12px; color: white;">
            <h3 style="margin: 0 0 0.5rem 0; font-size: 0.9rem; opacity: 0.9;">روزهای در حال اجرا</h3>
            <p style="margin: 0; font-size: 2.5rem; font-weight: bold;">
                {{ $campaign->started_at ? (int)$campaign->started_at->diffInDays(now()) : 0 }}
            </p>
            <p style="margin: 0.5rem 0 0 0; font-size: 0.875rem; opacity: 0.8;">از {{ $campaign->days }} روز</p>
        </div>

        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); padding: 2rem; border-radius: 12px; color: white;">
            <h3 style="margin: 0 0 0.5rem 0; font-size: 0.9rem; opacity: 0.9;">کل کلیک‌ها</h3>
            <p style="margin: 0; font-size: 2.5rem; font-weight: bold;">{{ rand(150, 500) }}</p>
            <p style="margin: 0.5rem 0 0 0; font-size: 0.875rem; opacity: 0.8;">کلیک لینک</p>
        </div>
    </div>

    <!-- Daily Clicks Chart -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #333; margin-bottom: 1.5rem;">کلیک‌های روزانه لینک</h2>
        <div style="height: 300px; display: flex; align-items: flex-end; justify-content: space-around; gap: 0.5rem; border-bottom: 2px solid #dee2e6; padding-bottom: 1rem;">
            @php
                $days = $campaign->started_at ? min((int)$campaign->started_at->diffInDays(now()) + 1, 7) : 7;
                $maxClicks = 100;
            @endphp
            @for($i = 0; $i < $days; $i++)
                @php
                    $clicks = rand(10, $maxClicks);
                    $height = ($clicks / $maxClicks) * 100;
                @endphp
                <div style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <div style="width: 100%; background: linear-gradient(to top, #007bff, #0056b3); border-radius: 4px 4px 0 0; min-height: 20px; height: {{ $height }}%; margin-bottom: 0.5rem; position: relative;">
                        <span style="position: absolute; top: -25px; left: 50%; transform: translateX(-50%); font-size: 0.875rem; font-weight: 600; color: #333;">{{ $clicks }}</span>
                    </div>
                    <span style="font-size: 0.75rem; color: #666; text-align: center;">روز {{ $i + 1 }}</span>
                </div>
            @endfor
        </div>
        <p style="text-align: center; color: #666; margin-top: 1rem; font-size: 0.875rem;">* داده‌های پروتوتایپ - کلیک‌های واقعی در تولید ردیابی خواهند شد</p>
    </div>

    <!-- Car Performance Table -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #333; margin-bottom: 1.5rem;">عملکرد ماشین</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                    <th style="padding: 1rem; text-align: right;">شناسه ماشین</th>
                    <th style="padding: 1rem; text-align: right;">مسیر</th>
                    <th style="padding: 1rem; text-align: center;">دقایق نمایش داده شده</th>
                    <th style="padding: 1rem; text-align: center;">کلیک‌ها</th>
                </tr>
            </thead>
            <tbody>
                @for($i = 1; $i <= $campaign->cars; $i++)
                    @php
                        $route = $campaign->locations[($i - 1) % count($campaign->locations)] ?? 'route-1';
                        $minutes = rand(120, 480); // Random minutes between 2-8 hours
                        $clicks = rand(5, 25);
                    @endphp
                    <tr style="border-bottom: 1px solid #dee2e6;">
                        <td style="padding: 1rem;">CAR-{{ str_pad($i, 3, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding: 1rem;">{{ ucfirst(str_replace('-', ' ', $route)) }}</td>
                        <td style="padding: 1rem; text-align: center; font-weight: 600; color: #007bff;">{{ $minutes }} دقیقه</td>
                        <td style="padding: 1rem; text-align: center; font-weight: 600; color: #28a745;">{{ $clicks }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
        <p style="text-align: center; color: #666; margin-top: 1rem; font-size: 0.875rem;">* داده‌های پروتوتایپ - دقایق بر اساس زمان نمایش واقعی در تولید محاسبه خواهند شد</p>
    </div>
</div>
