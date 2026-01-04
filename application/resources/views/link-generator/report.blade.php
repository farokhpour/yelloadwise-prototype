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

    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
        <h2 style="color: #333; margin-bottom: 1.5rem;">نمودار کلیک‌ها (30 روز گذشته)</h2>
        <canvas id="clicksChart" style="max-height: 400px;"></canvas>
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

