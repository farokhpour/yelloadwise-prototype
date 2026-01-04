@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('epic.digital-taxi-rooftop.regulator.campaigns.index') }}" 
           style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none; font-weight: 500;">
            ← بازگشت به فهرست کمپین‌ها
        </a>
        <h1 style="color: #333; margin-bottom: 0.5rem;">مشاهده و تایید کمپین: {{ $campaign->name }}</h1>
        <p style="color: #666; font-size: 0.95rem;">وضعیت: <span style="padding: 0.25rem 0.75rem; background: #ffc107; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 600;">در انتظار تایید مجوز دهنده</span></p>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Campaign Details (Read-only) -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem; margin-bottom: 2rem;">
        <h2 style="color: #333; margin-bottom: 1.5rem; border-bottom: 2px solid #dee2e6; padding-bottom: 0.75rem;">اطلاعات کمپین</h2>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #555;">نام کمپین</label>
                <p style="padding: 0.75rem; background: #f8f9fa; border-radius: 6px; margin: 0; color: #333;">{{ $campaign->name }}</p>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #555;">تعداد روزها</label>
                <p style="padding: 0.75rem; background: #f8f9fa; border-radius: 6px; margin: 0; color: #333;">{{ $campaign->days }} روز</p>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #555;">تاریخ ایجاد</label>
                <p style="padding: 0.75rem; background: #f8f9fa; border-radius: 6px; margin: 0; color: #333;">{{ $campaign->created_at->format('Y-m-d H:i') }}</p>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #555;">موقعیت‌ها</label>
                <div style="padding: 0.75rem; background: #f8f9fa; border-radius: 6px; min-height: 2.5rem;">
                    @php
                        $allLocations = [
                            'route-1' => 'مسیر 1 - مرکز شهر',
                            'route-2' => 'مسیر 2 - منطقه مالی',
                            'route-3' => 'مسیر 3 - منطقه خرید',
                            'route-4' => 'مسیر 4 - کریدور فرودگاه',
                            'route-5' => 'مسیر 5 - منطقه دانشگاه',
                            'route-6' => 'مسیر 6 - منطقه تفریحی',
                            'route-7' => 'مسیر 7 - پارک تجاری',
                            'route-8' => 'مسیر 8 - مسکونی شمال',
                            'route-9' => 'مسیر 9 - مسکونی جنوب',
                            'route-10' => 'مسیر 10 - منطقه صنعتی',
                            'route-11' => 'مسیر 11 - ساحلی',
                            'route-12' => 'مسیر 12 - مرکز حومه',
                        ];
                        $selectedLocations = $campaign->locations ?? [];
                    @endphp
                    @if(count($selectedLocations) > 0)
                        <p style="margin: 0; color: #333;">
                            @foreach($selectedLocations as $location)
                                <span style="display: inline-block; padding: 0.25rem 0.75rem; background: #007bff; color: white; border-radius: 4px; font-size: 0.875rem; margin: 0.25rem; font-weight: 500;">
                                    {{ $allLocations[$location] ?? $location }}
                                </span>
                            @endforeach
                        </p>
                    @else
                        <p style="margin: 0; color: #999; font-style: italic;">موقعیتی انتخاب نشده است</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Video File Section -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem; margin-bottom: 2rem;">
        <h2 style="color: #333; margin-bottom: 1.5rem; border-bottom: 2px solid #dee2e6; padding-bottom: 0.75rem;">فایل ویدیو</h2>
        
        @if($campaign->video_file)
            <div style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 6px; border: 1px solid #dee2e6;">
                <div style="flex: 1;">
                    <p style="margin: 0; font-weight: 500; color: #28a745;">✓ فایل ویدیو موجود است</p>
                    <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem; word-break: break-all; font-family: monospace;">
                        {{ basename($campaign->video_file) }}
                    </p>
                </div>
                <a href="{{ route('epic.digital-taxi-rooftop.regulator.campaigns.download-video', $campaign->id) }}" 
                   target="_blank"
                   style="padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-size: 0.875rem; font-weight: 600; transition: all 0.3s;"
                   onmouseover="this.style.background='#0056b3'; this.style.transform='translateY(-2px)';"
                   onmouseout="this.style.background='#007bff'; this.style.transform='translateY(0)';">
                    📥 دانلود ویدیو
                </a>
            </div>
        @else
            <div style="padding: 1rem; background: #fff3cd; border-radius: 6px; border: 1px solid #ffc107;">
                <p style="margin: 0; color: #856404;">⚠️ فایل ویدیو آپلود نشده است</p>
            </div>
        @endif
    </div>

    <!-- Action Buttons -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
        <h2 style="color: #333; margin-bottom: 1.5rem; border-bottom: 2px solid #dee2e6; padding-bottom: 0.75rem;">عملیات</h2>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <!-- Approve Form -->
            <form method="POST" action="{{ route('epic.digital-taxi-rooftop.regulator.campaigns.approve', $campaign->id) }}" style="margin: 0;">
                @csrf
                <button type="submit" 
                        style="width: 100%; padding: 1rem; background: #28a745; color: white; border: none; border-radius: 6px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';"
                        onclick="return confirm('آیا از تایید این کمپین اطمینان دارید؟');">
                    ✓ تایید کمپین
                </button>
            </form>

            <!-- Reject Form -->
            <div>
                <form method="POST" action="{{ route('epic.digital-taxi-rooftop.regulator.campaigns.reject', $campaign->id) }}" id="rejectForm" style="margin: 0;">
                    @csrf
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500; color: #555;">نظر مجوز دهنده (اختیاری)</label>
                        <textarea name="regulator_comment" 
                                  id="regulator_comment"
                                  rows="3"
                                  placeholder="در صورت نیاز، نظر خود را وارد کنید..."
                                  style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 0.95rem; resize: vertical; box-sizing: border-box;"></textarea>
                    </div>
                    <button type="submit" 
                            style="width: 100%; padding: 1rem; background: #dc3545; color: white; border: none; border-radius: 6px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                            onmouseover="this.style.background='#c82333'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.background='#dc3545'; this.style.transform='translateY(0)';"
                            onclick="return confirm('آیا از برگشت این کمپین به ادمین اطمینان دارید؟');">
                        ✗ برگشت به ادمین
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

