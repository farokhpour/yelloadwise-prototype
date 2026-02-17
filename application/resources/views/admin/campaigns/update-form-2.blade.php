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

        <form method="POST" action="{{ route('epic.digital-taxi-rooftop.admin.campaigns.update-form-2.store', $campaign->id) }}" style="margin-top: 2rem;">
            @csrf

            <!-- Target Field -->
            <div style="margin-bottom: 1.5rem;">
                <label for="target" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">
                    هدف <span style="color: #dc3545;">*</span>
                </label>
                <input type="text" 
                       id="target" 
                       name="target" 
                       value="{{ old('target', '') }}" 
                       required
                       style="width: 100%; padding: 0.75rem; border: 2px solid #dee2e6; border-radius: 6px; font-size: 1rem; transition: border-color 0.3s;"
                       onfocus="this.style.borderColor='#007bff';"
                       onblur="this.style.borderColor='#dee2e6';"
                       placeholder="مثال: نمایش در 50 دستگاه در مسیرهای مرکزی شهر">
                <small style="display: block; margin-top: 0.5rem; color: #6c757d; font-size: 0.875rem;">
                    هدف کمپین را مشخص کنید
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
                <a href="{{ route('epic.digital-taxi-rooftop.admin.campaigns.edit', $campaign->id) }}" 
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

