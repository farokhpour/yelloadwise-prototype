@extends('layouts.app')

@section('content')
<div style="max-width: 1920px; margin: 0 auto; padding: 1rem; background: #f5f5f5; min-height: 100vh;">
    <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 1rem;">
        <h1 style="color: #333; margin: 0; text-align: center; font-size: 1.8rem;">📺 داشبورد نمایش محتوای دستگاه‌ها</h1>
        <p style="text-align: center; color: #666; margin: 0.5rem 0 0 0; font-size: 0.95rem;">
            صفحه {{ $page }} از {{ $totalPages }} | تعداد کل دستگاه‌ها: {{ $totalPages * 20 }}
        </p>
    </div>

    <!-- Device Grid: 5 rows x 4 columns = 20 devices -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
        @foreach($devices as $device)
            <div style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s;"
                 onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.15)';"
                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)';">
                <!-- Device Header -->
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 0.75rem; color: white;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="font-weight: 600; font-size: 0.9rem;">{{ $device->device_id }}</span>
                        <span style="padding: 0.25rem 0.5rem; border-radius: 4px; background: {{ $device->status === 'live' ? 'rgba(40, 167, 69, 0.3)' : 'rgba(220, 53, 69, 0.3)' }}; font-size: 0.75rem; font-weight: 600;">
                            {{ $device->status === 'live' ? '🟢 آنلاین' : '🔴 آفلاین' }}
                        </span>
                    </div>
                    <div style="font-size: 0.85rem; opacity: 0.9;">
                        راننده: {{ $device->owner_first_name }} {{ $device->owner_last_name }}
                    </div>
                </div>
                
                <!-- Campaign Content -->
                <div style="padding: 1rem; text-align: center;">
                    <div style="margin-bottom: 0.75rem;">
                        <p style="margin: 0 0 0.5rem 0; font-weight: 600; color: #333; font-size: 0.9rem;">{{ $device->campaign_name ?? 'بدون محتوا' }}</p>
                    </div>
                    <div style="width: 100%; height: 220px; background: #000; border-radius: 6px; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
                        @if(isset($device->campaign_gif))
                            <img src="{{ $device->campaign_gif }}" 
                                 alt="{{ $device->campaign_name }}" 
                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px; display: block;">
                        @else
                            <div style="color: #999; font-size: 0.85rem; text-align: center;">بدون محتوا</div>
                        @endif
                    </div>
                </div>
                
                <!-- Device Footer -->
                <div style="background: #f8f9fa; padding: 0.5rem 1rem; border-top: 1px solid #dee2e6; font-size: 0.75rem; color: #666;">
                    آخرین به‌روزرسانی: {{ $device->last_status_updated_at ? $device->last_status_updated_at->format('H:i') : '-' }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 1.5rem;">
        <div style="display: flex; justify-content: center; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
            @if($page > 1)
                <a href="{{ route('epic.digital-taxi-rooftop.devices.dashboard', ['page' => $page - 1]) }}" 
                   style="padding: 0.5rem 1rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
                   onmouseover="this.style.background='#5a6268';"
                   onmouseout="this.style.background='#6c757d';">
                    ← قبلی
                </a>
            @endif
            
            @for($i = 1; $i <= $totalPages; $i++)
                <a href="{{ route('epic.digital-taxi-rooftop.devices.dashboard', ['page' => $i]) }}" 
                   style="padding: 0.5rem 1rem; background: {{ $i == $page ? '#007bff' : '#e9ecef' }}; color: {{ $i == $page ? 'white' : '#333' }}; text-decoration: none; border-radius: 6px; font-weight: {{ $i == $page ? '600' : '500' }}; transition: all 0.3s; min-width: 40px; text-align: center;"
                   onmouseover="this.style.background='{{ $i == $page ? '#0056b3' : '#dee2e6' }}';"
                   onmouseout="this.style.background='{{ $i == $page ? '#007bff' : '#e9ecef' }}';">
                    {{ $i }}
                </a>
            @endfor
            
            @if($page < $totalPages)
                <a href="{{ route('epic.digital-taxi-rooftop.devices.dashboard', ['page' => $page + 1]) }}" 
                   style="padding: 0.5rem 1rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
                   onmouseover="this.style.background='#5a6268';"
                   onmouseout="this.style.background='#6c757d';">
                    بعدی →
                </a>
            @endif
        </div>
        
        <!-- Auto-pagination indicator -->
        <div style="text-align: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #dee2e6;">
            <p style="margin: 0; color: #666; font-size: 0.9rem;">
                <span id="countdown" style="font-weight: 600; color: #007bff;">60</span> ثانیه تا صفحه بعدی
            </p>
        </div>
    </div>

    <!-- How It Works Section -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem; text-align: center;">📋 نحوه کار این صفحه</h2>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border-right: 4px solid #007bff;">
            <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.1rem;">🎯 هدف صفحه</h3>
            <p style="color: #555; line-height: 1.8; margin: 0;">
                این داشبورد برای نمایش محتوای در حال پخش روی هر دستگاه نمایشگر تاکسی دیجیتال طراحی شده است. 
                ادمین‌ها می‌توانند به صورت لحظه‌ای ببینند که هر دستگاه چه محتوایی را نمایش می‌دهد.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
            <div style="background: #e8f5e9; padding: 1.5rem; border-radius: 8px; border: 1px solid #c8e6c9;">
                <h4 style="color: #2e7d32; margin-bottom: 1rem; font-size: 1rem;">📊 ساختار صفحه</h4>
                <ul style="color: #555; line-height: 1.8; padding-right: 1.5rem; margin: 0;">
                    <li><strong>5 ردیف × 4 ستون</strong> = 20 دستگاه در هر صفحه</li>
                    <li><strong>100 دستگاه</strong> در مجموع (5 صفحه)</li>
                    <li>هر کارت دستگاه شامل:
                        <ul style="margin-top: 0.5rem;">
                            <li>شناسه دستگاه</li>
                            <li>نام راننده</li>
                            <li>وضعیت دستگاه (آنلاین/آفلاین)</li>
                            <li>محتوای در حال پخش (GIF متحرک)</li>
                            <li>زمان آخرین به‌روزرسانی</li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div style="background: #fff3e0; padding: 1.5rem; border-radius: 8px; border: 1px solid #ffcc80;">
                <h4 style="color: #e65100; margin-bottom: 1rem; font-size: 1rem;">⏱️ تغییر خودکار صفحه</h4>
                <ul style="color: #555; line-height: 1.8; padding-right: 1.5rem; margin: 0;">
                    <li>صفحه به صورت <strong>خودکار</strong> هر <strong>1 دقیقه</strong> به صفحه بعدی می‌رود</li>
                    <li>این فرآیند برای <strong>5 دقیقه</strong> ادامه دارد (هر صفحه 1 دقیقه)</li>
                    <li>بعد از صفحه 5، دوباره به صفحه 1 برمی‌گردد</li>
                    <li>شمارش معکوس در پایین صفحه نمایش داده می‌شود</li>
                    <li>کاربر می‌تواند به صورت دستی نیز بین صفحات جابجا شود</li>
                </ul>
            </div>

            <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; border: 1px solid #90caf9;">
                <h4 style="color: #1565c0; margin-bottom: 1rem; font-size: 1rem;">🖼️ نمایش محتوا</h4>
                <ul style="color: #555; line-height: 1.8; padding-right: 1.5rem; margin: 0;">
                    <li>هر دستگاه محتوای کمپین فعال خود را به صورت <strong>GIF متحرک</strong> نمایش می‌دهد</li>
                    <li>اگر دستگاه محتوایی نداشته باشد، پیام "بدون محتوا" نمایش داده می‌شود</li>
                    <li>GIF‌ها به صورت خودکار پخش می‌شوند</li>
                    <li>در حالت واقعی، این GIF‌ها از ویدیوهای کمپین‌های فعال استخراج می‌شوند</li>
                </ul>
            </div>
        </div>

        <div style="background: #f3e5f5; padding: 1.5rem; border-radius: 8px; margin-top: 1.5rem; border-right: 4px solid #9c27b0;">
            <h4 style="color: #6a1b9a; margin-bottom: 1rem; font-size: 1rem;">💡 استفاده در مانیتور</h4>
            <p style="color: #555; line-height: 1.8; margin: 0;">
                این صفحه برای نمایش روی یک <strong>مانیتور بزرگ</strong> در اتاق کنترل طراحی شده است. 
                با تغییر خودکار صفحات، ادمین‌ها می‌توانند تمام 100 دستگاه را در یک چرخه 5 دقیقه‌ای مشاهده کنند 
                و از وضعیت و محتوای هر دستگاه مطلع شوند.
            </p>
        </div>
    </div>
</div>

<script>
    let countdown = 60; // 60 seconds = 1 minute
    const countdownElement = document.getElementById('countdown');
    const baseUrl = '{{ route("epic.digital-taxi-rooftop.devices.dashboard") }}';
    
    function updateCountdown() {
        countdown--;
        countdownElement.textContent = countdown;
        
        if (countdown <= 0) {
            // Go to next page
            const currentPage = {{ $page }};
            const totalPages = {{ $totalPages }};
            const nextPage = currentPage < totalPages ? currentPage + 1 : 1;
            
            window.location.href = baseUrl + '?page=' + nextPage;
        }
    }
    
    // Update countdown every second
    setInterval(updateCountdown, 1000);
</script>
@endsection

