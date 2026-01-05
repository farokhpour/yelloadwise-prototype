@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('epics.link-generator.index') }}" 
           style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none; font-weight: 500;">
            ← بازگشت به فهرست لینک‌ها
        </a>
        <h1 style="color: #333; margin-bottom: 0.5rem;">گزارش کلیک‌های لینک</h1>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem; margin-bottom: 2rem;">
        <h2 style="color: #333; margin-bottom: 1rem;">اطلاعات لینک</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
            <div>
                <p style="margin: 0; color: #666; font-size: 0.9rem;">لینک:</p>
                <p style="margin: 0.25rem 0 0 0; font-weight: 600; word-break: break-all;">
                    <a href="{{ $link->generated_link }}" target="_blank" style="color: #007bff; text-decoration: none;">
                        {{ $link->generated_link }}
                    </a>
                </p>
            </div>
            <div>
                <p style="margin: 0; color: #666; font-size: 0.9rem;">نام کمپین:</p>
                <p style="margin: 0.25rem 0 0 0; font-weight: 600;">{{ $link->campaign_name ?? '-' }}</p>
            </div>
            <div>
                <p style="margin: 0; color: #666; font-size: 0.9rem;">کل کلیک‌ها:</p>
                <p style="margin: 0.25rem 0 0 0; font-weight: 600; color: #28a745; font-size: 1.2rem;">{{ number_format($link->total_clicks) }}</p>
            </div>
        </div>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem; margin-bottom: 2rem;">
        <h2 style="color: #333; margin-bottom: 1.5rem;">نمودار کلیک‌ها (30 روز گذشته)</h2>
        <canvas id="clicksChart" style="max-height: 400px;"></canvas>
    </div>

    <!-- Explanation Section -->
    <div style="background: #e3f2fd; border: 2px solid #2196f3; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
        <p style="color: #1565c0; line-height: 2; margin: 0; font-size: 1.05rem;">
            <strong>📊 بخش گزارش موجود (as_is report):</strong> نمودار بالا همان گزارش موجود سیستم است که کلیک‌های روزانه را نمایش می‌دهد.
        </p>
        <p style="color: #1565c0; line-height: 2; margin: 1rem 0 0 0; font-size: 1.05rem;">
            <strong>📋 جدول جدید:</strong> جدول زیر شامل لینک‌ها و تعداد کلیک‌های هر لینک است.
        </p>
    </div>

    <!-- Links and Clicks Table -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
        <h2 style="color: #333; margin-bottom: 1.5rem;">لینک‌ها و کلیک‌ها</h2>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">لینک کوتاه (ylad.ir)</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">لینک کامل</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #555;">تعداد کلیک‌ها</th>
                        <th style="padding: 1rem; text-align: center; font-weight: 600; color: #555;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // Mock data for prototype - in production, this would come from LinkGenerator model
                        $mockLinks = [
                            [
                                'short_link' => 'ylad.ir/' . $link->token,
                                'full_link' => $link->generated_link,
                                'clicks' => $link->total_clicks,
                                'id' => $link->id,
                            ],
                            // Add a few more mock links for demonstration
                            [
                                'short_link' => 'ylad.ir/abc12345',
                                'full_link' => $link->landing_url . '?utm_source=test&utm_medium=email',
                                'clicks' => rand(50, 200),
                                'id' => $link->id + 1,
                            ],
                            [
                                'short_link' => 'ylad.ir/xyz67890',
                                'full_link' => $link->landing_url . '?utm_source=social&utm_campaign=summer',
                                'clicks' => rand(30, 150),
                                'id' => $link->id + 2,
                            ],
                        ];
                    @endphp
                    @foreach($mockLinks as $mockLink)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem;">
                                <a href="http://{{ $mockLink['short_link'] }}" target="_blank" 
                                   style="color: #28a745; text-decoration: none; font-family: monospace; font-size: 0.875rem; font-weight: 600;">
                                    {{ $mockLink['short_link'] }}
                                </a>
                            </td>
                            <td style="padding: 1rem;">
                                <a href="{{ $mockLink['full_link'] }}" target="_blank" 
                                   style="color: #007bff; text-decoration: none; font-family: monospace; font-size: 0.875rem; word-break: break-all;">
                                    {{ Str::limit($mockLink['full_link'], 60) }}
                                </a>
                            </td>
                            <td style="padding: 1rem; text-align: center; font-weight: 600; color: #28a745;">
                                {{ number_format($mockLink['clicks']) }}
                            </td>
                            <td style="padding: 1rem; text-align: center;">
                                <a href="{{ route('epics.link-generator.report', $mockLink['id']) }}" 
                                   style="padding: 0.5rem 1rem; background: #17a2b8; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem;">
                                    📊 جزئیات
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p style="text-align: center; color: #666; margin-top: 1rem; font-size: 0.875rem; padding: 1rem; background: #f8f9fa; border-radius: 6px;">
            * داده‌های پروتوتایپ - در تولید، این جدول از لینک‌های واقعی مرتبط با کمپین استخراج خواهد شد
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    const ctx = document.getElementById('clicksChart').getContext('2d');
    const chartData = {
        labels: @json($chartLabels),
        datasets: [{
            label: 'تعداد کلیک‌ها',
            data: @json($chartData),
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1,
            fill: true
        }]
    };

    const config = {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    };

    new Chart(ctx, config);
</script>
@endsection

