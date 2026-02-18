@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 2rem;">
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h1 style="color: #333; margin-bottom: 1.5rem; text-align: center;">فرم به‌روزرسانی کمپین - فرم دوم</h1>
        
        <div style="background: #e3f2fd; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #2196f3;">
            <p style="margin: 0; color: #1565c0; font-size: 0.95rem;">
                <strong>کمپین:</strong> {{ $campaign->name }}
            </p>
        </div>

        @if(session('success'))
            <div style="background: #d4edda; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; color: #155724; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background: #f8d7da; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; color: #721c24; border: 1px solid #f5c6cb;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Business Rules -->
        <div style="background: #f8d7da; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #dc3545;">
            <h3 style="color: #721c24; margin-bottom: 1rem; font-size: 1.1rem;">📜 قوانین و محدودیت‌ها</h3>
            <div style="color: #721c24; line-height: 2; font-size: 0.95rem;">
                <p style="margin: 0 0 1rem 0; font-weight: 600;">
                    ⚠️ در این فرم محدودیت‌هایی بر اساس وضعیت کمپین وجود دارد:
                </p>

                <div style="background: rgba(255,255,255,0.5); padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                    <p style="margin: 0; font-weight: 600;">🔴 کمپین تمام شده:</p>
                    <p style="margin: 0.25rem 0 0 1rem;">امکان تغییر وجود ندارد.</p>
                </div>

                <div style="background: rgba(255,255,255,0.5); padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                    <p style="margin: 0; font-weight: 600;">🟢 کمپین در انتظار اجرا:</p>
                    <p style="margin: 0.25rem 0 0 1rem;">امکان تغییر بدون هیچ محدودیتی وجود دارد.</p>
                </div>

                <div style="background: rgba(255,255,255,0.5); padding: 1rem; border-radius: 6px;">
                    <p style="margin: 0; font-weight: 600;">🟡 کمپین در حال اجرا یا تمام شده (پرداخت نشده):</p>
                    <ul style="margin: 0.5rem 0 0 0; padding-right: 2rem; line-height: 2.2;">
                        <li><strong>هدف - افزایش:</strong> امکان افزایش هدف وجود دارد.</li>
                        <li><strong>هدف - کاهش:</strong> فقط در صورتی امکان‌پذیر است که تعداد روزهایی که گزارش دارد از تعداد روزهای هدف جدید بیشتر نباشد.</li>
                        <li><strong>تاریخ شروع - جلو بردن:</strong> امکان جلو بردن تاریخ شروع وجود دارد (مثلاً ۲ روز جلوتر)، اما فقط در صورتی که در آن تاریخ‌ها گزارش کلیک نداشته باشد.</li>
                        <li><strong>تاریخ شروع - عقب بردن:</strong> امکان عقب بردن تاریخ شروع به قبل از تاریخ شروع فعلی وجود ندارد.</li>
                    </ul>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('epics.campaign-update.update-form-2.store', $campaign->id) }}" style="margin-top: 2rem;">
            @csrf

            <!-- Target Field -->
            <div style="margin-bottom: 1.5rem;">
                <label for="target" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                    هدف <span style="color: #dc3545;">*</span>
                </label>
                <input type="number" 
                       id="target" 
                       name="target" 
                       value="{{ old('target', '') }}" 
                       required
                       min="1"
                       style="width: 100%; padding: 0.75rem; border: 2px solid #dee2e6; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                       onfocus="this.style.borderColor='#007bff';"
                       onblur="this.style.borderColor='#dee2e6';"
                       placeholder="مثال: 30">
                <small style="display: block; margin-top: 0.5rem; color: #6c757d; font-size: 0.875rem;">
                    تعداد روز یا تعداد پیامک کمپین را وارد کنید
                </small>
                @error('target')
                    <div style="color: #dc3545; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campaign Start Date Field -->
            <div style="margin-bottom: 2rem;">
                <label for="campaign_start_date" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                    تاریخ شروع کمپین <span style="color: #dc3545;">*</span>
                </label>
                <input type="date" 
                       id="campaign_start_date" 
                       name="campaign_start_date" 
                       value="{{ old('campaign_start_date', $campaign->started_at ? $campaign->started_at->format('Y-m-d') : '') }}" 
                       required
                       style="width: 100%; padding: 0.75rem; border: 2px solid #dee2e6; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                       onfocus="this.style.borderColor='#007bff';"
                       onblur="this.style.borderColor='#dee2e6';">
                <small style="display: block; margin-top: 0.5rem; color: #6c757d; font-size: 0.875rem;">
                    تاریخ شروع اجرای کمپین را انتخاب کنید
                </small>
                @error('campaign_start_date')
                    <div style="color: #dc3545; margin-top: 0.5rem; font-size: 0.875rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" 
                        style="flex: 1; padding: 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 1.1rem; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    💾 ذخیره
                </button>
                <a href="{{ route('epics.campaign-update.epic-index') }}" 
                   style="flex: 1; padding: 1rem; background: #6c757d; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 1.1rem; text-align: center; transition: all 0.3s; display: flex; align-items: center; justify-content: center;"
                   onmouseover="this.style.background='#5a6268'; this.style.transform='translateY(-2px)';"
                   onmouseout="this.style.background='#6c757d'; this.style.transform='translateY(0)';">
                    ← بازگشت
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

