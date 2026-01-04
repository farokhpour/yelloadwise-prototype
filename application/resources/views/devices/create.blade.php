@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('epic.digital-taxi-rooftop.devices.index') }}" 
           style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none; font-weight: 500;">
            ← بازگشت به فهرست دستگاه‌ها
        </a>
        <h1 style="color: #333; margin-bottom: 0.5rem;">افزودن دستگاه جدید</h1>
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

    <form method="POST" action="{{ route('epic.digital-taxi-rooftop.devices.store') }}" enctype="multipart/form-data" 
          style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
        @csrf

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">شناسه دستگاه *</label>
            <input type="text" 
                   name="device_id" 
                   value="{{ old('device_id') }}" 
                   required
                   placeholder="مثال: DEV-001"
                   style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.875rem;">شناسه یکتای دستگاه را وارد کنید</p>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">مسیر پیش‌فرض *</label>
            <input type="text" 
                   name="default_route" 
                   value="{{ old('default_route') }}" 
                   required
                   placeholder="مثال: route-1"
                   style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.875rem;">مسیر پیش‌فرض دستگاه در پنل را وارد کنید</p>
        </div>

        <div style="margin-bottom: 2rem; padding: 1.5rem; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6;">
            <h3 style="margin: 0 0 1rem 0; color: #333; font-size: 1.1rem;">اطلاعات مالک دستگاه</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">نام *</label>
                    <input type="text" 
                           name="owner_first_name" 
                           value="{{ old('owner_first_name') }}" 
                           required
                           placeholder="نام"
                           style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                </div>
                
                <div>
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">نام خانوادگی *</label>
                    <input type="text" 
                           name="owner_last_name" 
                           value="{{ old('owner_last_name') }}" 
                           required
                           placeholder="نام خانوادگی"
                           style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                </div>
            </div>

            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">کد ملی *</label>
                <input type="text" 
                       name="owner_national_id" 
                       value="{{ old('owner_national_id') }}" 
                       required
                       placeholder="کد ملی"
                       maxlength="20"
                       style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            </div>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">آپلود مدارک (اختیاری)</label>
            <input type="file" 
                   name="documents_file" 
                   accept="image/*,.pdf"
                   style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.875rem;">فایل‌های تصویری (JPG, PNG) یا PDF. حداکثر 10 مگابایت</p>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('epic.digital-taxi-rooftop.devices.index') }}" 
               style="display: inline-block; padding: 0.75rem 1.5rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.background='#5a6268';"
               onmouseout="this.style.background='#6c757d';">
                انصراف
            </a>
            <button type="submit" 
                    style="padding: 0.75rem 1.5rem; background: #28a745; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                    onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
                ثبت دستگاه
            </button>
        </div>
    </form>
</div>
@endsection

