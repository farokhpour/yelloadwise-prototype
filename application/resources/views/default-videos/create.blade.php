@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('epic.digital-taxi-rooftop.default-videos.index') }}" 
           style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none; font-weight: 500;">
            ← بازگشت به فهرست ویدیوهای پیش‌فرض
        </a>
        <h1 style="color: #333; margin-bottom: 0.5rem;">افزودن ویدیو پیش‌فرض</h1>
    </div>

    @if($errors->any())
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-right: 1.5rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('epic.digital-taxi-rooftop.default-videos.store') }}" enctype="multipart/form-data" 
          style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
        @csrf

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">نام ویدیو *</label>
            <input type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required
                   placeholder="مثال: ویدیو پیش‌فرض 1"
                   style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.875rem;">نامی برای شناسایی این ویدیو پیش‌فرض وارد کنید</p>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">فایل ویدیو *</label>
            <input type="file" 
                   name="video_file" 
                   accept="video/*"
                   required
                   style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.875rem;">فرمت‌های مجاز: MP4, AVI, MOV, WMV, FLV. حداکثر 100 مگابایت</p>
        </div>

        <div style="margin-bottom: 2rem; padding: 1.5rem; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6;">
            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                <input type="checkbox" 
                       name="show_any_time" 
                       value="1"
                       {{ old('show_any_time') ? 'checked' : '' }}
                       style="width: 20px; height: 20px; cursor: pointer;">
                <div>
                    <span style="font-weight: 600; color: #333; display: block; margin-bottom: 0.25rem;">نمایش در هر زمان</span>
                    <span style="color: #666; font-size: 0.875rem;">اگر این گزینه فعال باشد، این ویدیو می‌تواند در هر زمانی نمایش داده شود (حتی زمانی که کمپین‌های فعال وجود دارند)</span>
                </div>
            </label>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('epic.digital-taxi-rooftop.default-videos.index') }}" 
               style="display: inline-block; padding: 0.75rem 1.5rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.background='#5a6268';"
               onmouseout="this.style.background='#6c757d';">
                انصراف
            </a>
            <button type="submit" 
                    style="padding: 0.75rem 1.5rem; background: #28a745; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                    onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
                افزودن ویدیو
            </button>
        </div>
    </form>
</div>
@endsection

