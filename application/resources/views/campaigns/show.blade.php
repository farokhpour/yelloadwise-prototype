@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <h1>کمپین: {{ $campaign->name }}</h1>
    
    <!-- Status Banner -->
    <div style="background: #f5f5f5; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
        <h2>وضعیت کمپین</h2>
        <p><strong>وضعیت:</strong> 
            <span style="padding: 0.5rem 1rem; border-radius: 4px; background: 
                @if($campaign->status === 'draft') #6c757d
                @elseif($campaign->status === 'waiting_admin_approval') #ffc107
                @elseif($campaign->status === 'waiting_payment') #17a2b8
                @elseif($campaign->status === 'waiting_to_run') #007bff
                @elseif($campaign->status === 'running') #28a745
                @else #dc3545
                @endif; color: white; font-weight: bold;">
                @if($campaign->status === 'draft') پیش‌نویس
                @elseif($campaign->status === 'waiting_admin_approval') در انتظار تایید ادمین
                @elseif($campaign->status === 'waiting_payment') در انتظار پرداخت
                @elseif($campaign->status === 'waiting_to_run') آماده اجرا
                @elseif($campaign->status === 'running') در حال اجرا
                @elseif($campaign->status === 'completed') تکمیل شده
                @else لغو شده
                @endif
            </span>
        </p>
    </div>

    <!-- Tabs -->
    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <div style="display: flex; border-bottom: 2px solid #dee2e6;">
            <button onclick="showTab('overview')" id="tab-overview" class="tab-button active" style="padding: 1rem 2rem; border: none; background: none; cursor: pointer; border-bottom: 3px solid #007bff; font-weight: 600;">
                نمای کلی
            </button>
            @if(in_array($campaign->status, ['waiting_payment', 'waiting_to_run', 'running', 'completed']))
                <button onclick="showTab('invoice')" id="tab-invoice" class="tab-button" style="padding: 1rem 2rem; border: none; background: none; cursor: pointer; border-bottom: 3px solid transparent; font-weight: 600;">
                    فاکتور
                </button>
            @endif
            @if($campaign->status === 'running')
                <button onclick="showTab('report')" id="tab-report" class="tab-button" style="padding: 1rem 2rem; border: none; background: none; cursor: pointer; border-bottom: 3px solid transparent; font-weight: 600;">
                    گزارش
                </button>
            @endif
        </div>

        <!-- Overview Tab -->
        <div id="content-overview" class="tab-content" style="padding: 2rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <h3>جزئیات کمپین</h3>
                    <p><strong>نام:</strong> {{ $campaign->name }}</p>
                    <p><strong>روزها:</strong> {{ $campaign->days }}</p>
                    <p><strong>ماشین‌ها:</strong> {{ $campaign->cars }}</p>
                    <p><strong>موقعیت‌ها:</strong> {{ implode('، ', $campaign->locations) }}</p>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <h3>ردیابی و لینک‌ها</h3>
                    <p><strong>لینک فرود:</strong> <a href="{{ $campaign->link }}" target="_blank">{{ $campaign->link }}</a></p>
                    @if($campaign->utms)
                        <p><strong>پارامترهای UTM:</strong></p>
                        <ul>
                            @foreach($campaign->utms as $key => $value)
                                @if($value)
                                    <li>{{ $key }}: {{ $value }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            @if($campaign->status === 'waiting_to_run')
                <div style="background: #d1ecf1; padding: 1.5rem; border-radius: 8px;">
                    <h3>کمپین آماده اجرا</h3>
                    <p>کمپین شما پرداخت شده و در انتظار ادمین برای شروع است.</p>
                </div>
            @endif

            @if($campaign->status === 'running')
                <div style="background: #d4edda; padding: 1.5rem; border-radius: 8px;">
                    <h3>کمپین در حال اجرا است</h3>
                    <p>کمپین شما در حال حاضر فعال است و روی نمایشگرهای تاکسی دیجیتال نمایش داده می‌شود.</p>
                    <p><strong>شروع:</strong> {{ $campaign->started_at ? $campaign->started_at->format('Y-m-d H:i') : 'N/A' }}</p>
                    <p><strong>پایان:</strong> {{ $campaign->ended_at ? $campaign->ended_at->format('Y-m-d H:i') : 'N/A' }}</p>
                </div>
            @endif
        </div>

        <!-- Invoice Tab -->
        @if(in_array($campaign->status, ['waiting_payment', 'waiting_to_run', 'running', 'completed']))
            <div id="content-invoice" class="tab-content" style="display: none; padding: 2rem;">
                @include('campaigns.partials.invoice', ['campaign' => $campaign])
                
                @if($campaign->status === 'waiting_payment')
                    <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #dee2e6;">
                        <form method="POST" action="{{ route('epic.digital-taxi-rooftop.campaign.payment.process', $campaign->id) }}" style="display: inline-block;">
                            @csrf
                            <button type="submit" 
                                    style="padding: 1rem 2.5rem; background: #28a745; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1.1rem; cursor: pointer; transition: all 0.3s;"
                                    onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                                    onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
                                💳 پردازش پرداخت
                            </button>
                        </form>
                        <p style="margin-top: 1rem; color: #666; font-size: 0.875rem;">
                            این یک پروتوتایپ است. پرداخت بلافاصله پردازش خواهد شد.
                        </p>
                    </div>
                @endif
            </div>
        @endif

        <!-- Report Tab -->
        @if($campaign->status === 'running')
            <div id="content-report" class="tab-content" style="display: none; padding: 2rem;">
                @include('campaigns.partials.report', ['campaign' => $campaign])
            </div>
        @endif
    </div>

    @if(session('success'))
        <div style="background: #d4edda; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; color: #155724; border-left: 4px solid #28a745;">
            <strong>✓ موفق!</strong> {{ session('success') }}
        </div>
        @if(session('payment_success'))
            <script>
                // Auto-switch to invoice tab after payment
                setTimeout(function() {
                    showTab('invoice');
                }, 500);
            </script>
        @endif
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; color: #721c24;">
            {{ session('error') }}
        </div>
    @endif
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.style.display = 'none';
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.style.borderBottomColor = 'transparent';
        button.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tabName).style.display = 'block';
    
    // Add active class to selected button
    const activeButton = document.getElementById('tab-' + tabName);
    activeButton.style.borderBottomColor = '#007bff';
    activeButton.classList.add('active');
}
</script>
@endsection
