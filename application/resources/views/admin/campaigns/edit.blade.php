@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <h1>ویرایش کمپین: {{ $campaign->name }}</h1>
    
    @if(session('success'))
        <div style="background: #d4edda; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; color: #155724;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; color: #721c24;">
            {{ session('error') }}
        </div>
    @endif

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
            <button onclick="showTab('edit')" id="tab-edit" class="tab-button active" style="padding: 1rem 2rem; border: none; background: none; cursor: pointer; border-bottom: 3px solid #007bff; font-weight: 600;">
                ویرایش کمپین
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

        <!-- Edit Tab -->
        <div id="content-edit" class="tab-content" style="padding: 2rem;">
            <form method="POST" action="{{ route('admin.campaigns.update', $campaign->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Video File Management -->
                <div style="margin-bottom: 2rem; padding: 1.5rem; background: #f8f9fa; border-radius: 8px; border: 2px solid #dee2e6;">
                    <label style="display: block; margin-bottom: 1rem; font-weight: 500; font-size: 1.1rem;">مدیریت فایل ویدیو</label>
                    
                    @if($campaign->video_file)
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; padding: 1rem; background: white; border-radius: 6px; border: 1px solid #dee2e6;">
                            <div style="flex: 1;">
                                <p style="margin: 0; font-weight: 500; color: #28a745;">✓ فایل ویدیو فعلی:</p>
                                <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.9rem; word-break: break-all; font-family: monospace;">
                                    {{ basename($campaign->video_file) }}
                                </p>
                            </div>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="{{ route('admin.campaigns.download-video', $campaign->id) }}" 
                                   target="_blank"
                                   style="padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem; display: inline-block;">
                                    📥 دانلود
                                </a>
                                <label style="padding: 0.5rem 1rem; background: #dc3545; color: white; border-radius: 4px; font-size: 0.875rem; cursor: pointer; display: inline-block;">
                                    🗑️ حذف
                                    <input type="checkbox" name="remove_video" value="1" id="remove_video_checkbox" style="display: none;" 
                                           onchange="const fileInput = document.getElementById('video_file_input'); if (this.checked) { fileInput.disabled = true; fileInput.value = ''; fileInput.required = false; } else { fileInput.disabled = false; }">
                                </label>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                            {{ $campaign->video_file ? 'آپلود فایل ویدیو جدید (اختیاری)' : 'فایل ویدیو *' }}
                        </label>
                        <input type="file" name="video_file" id="video_file_input" accept="video/*" 
                               {{ !$campaign->video_file ? 'required' : '' }}
                               style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                        <p style="font-size: 0.875rem; color: #666; margin-top: 0.5rem;">
                            حداکثر اندازه فایل: 500MB. فرمت‌ها: MP4, AVI, MOV, WMV
                        </p>
                        @if($campaign->video_file)
                            <p style="font-size: 0.875rem; color: #ffc107; margin-top: 0.5rem;">
                                ⚠️ اگر فایل جدیدی آپلود کنید، ویدیو فعلی جایگزین خواهد شد.
                            </p>
                        @endif
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">نام کمپین *</label>
                        <input type="text" name="name" value="{{ old('name', $campaign->name) }}" required
                               style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">هزینه هر روز ($) *</label>
                        <input type="number" name="cost_per_day" value="{{ old('cost_per_day', $campaign->cost_per_day) }}" 
                               step="0.01" min="0" required
                               style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">روزها *</label>
                        <input type="number" name="days" value="{{ old('days', $campaign->days) }}" min="1" required
                               style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    </div>

                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">ماشین‌ها *</label>
                        <input type="number" name="cars" value="{{ old('cars', $campaign->cars) }}" min="1" required
                               style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    </div>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">موقعیت‌ها * (چندتایی انتخاب کنید)</label>
                    <select name="locations[]" multiple size="6" required
                            style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
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
                        @endphp
                        @foreach($allLocations as $key => $label)
                            <option value="{{ $key }}" {{ in_array($key, old('locations', $campaign->locations ?? [])) ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <p style="font-size: 0.875rem; color: #666; margin-top: 0.5rem;">برای انتخاب چند موقعیت، Ctrl (ویندوز) یا Cmd (مک) را نگه دارید</p>
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">لینک صفحه فرود *</label>
                    <input type="url" name="link" value="{{ old('link', $campaign->link) }}" required
                           style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                </div>

                <div style="margin-bottom: 2rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">پارامترهای UTM</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.875rem;">utm_source</label>
                            <input type="text" name="utms[utm_source]" value="{{ old('utms.utm_source', $campaign->utms['utm_source'] ?? '') }}"
                                   style="width: 100%; padding: 0.5rem; border: 2px solid #ddd; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.875rem;">utm_medium</label>
                            <input type="text" name="utms[utm_medium]" value="{{ old('utms.utm_medium', $campaign->utms['utm_medium'] ?? '') }}"
                                   style="width: 100%; padding: 0.5rem; border: 2px solid #ddd; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.875rem;">utm_campaign</label>
                            <input type="text" name="utms[utm_campaign]" value="{{ old('utms.utm_campaign', $campaign->utms['utm_campaign'] ?? '') }}"
                                   style="width: 100%; padding: 0.5rem; border: 2px solid #ddd; border-radius: 4px;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.25rem; font-size: 0.875rem;">utm_term</label>
                            <input type="text" name="utms[utm_term]" value="{{ old('utms.utm_term', $campaign->utms['utm_term'] ?? '') }}"
                                   style="width: 100%; padding: 0.5rem; border: 2px solid #ddd; border-radius: 4px;">
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    @if($campaign->status === 'waiting_admin_approval')
                        <button type="submit" name="approve" value="1" style="flex: 1; padding: 1rem; background: #28a745; color: white; border: none; border-radius: 6px; font-size: 1.1rem; font-weight: 600; cursor: pointer;">
                            به‌روزرسانی و تایید کمپین
                        </button>
                    @else
                        <button type="submit" style="flex: 1; padding: 1rem; background: #007bff; color: white; border: none; border-radius: 6px; font-size: 1.1rem; font-weight: 600; cursor: pointer;">
                            به‌روزرسانی کمپین
                        </button>
                    @endif
                    <a href="{{ route('admin.campaigns.index') }}" 
                       style="flex: 1; padding: 1rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; text-align: center; font-size: 1.1rem; font-weight: 600;">
                        بازگشت به فهرست
                    </a>
                </div>
            </form>

            @if($campaign->status === 'waiting_to_run')
                <form method="POST" action="{{ route('admin.campaigns.run', $campaign->id) }}" style="margin-top: 2rem; background: #d1ecf1; padding: 1.5rem; border-radius: 8px;">
                    @csrf
                    <h3>اجرای کمپین</h3>
                    <p>این کمپین را شروع کنید. نمایش روی نمایشگرهای تاکسی دیجیتال آغاز خواهد شد.</p>
                    <button type="submit" style="padding: 0.75rem 2rem; background: #007bff; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; margin-top: 1rem;">
                        اجرای کمپین
                    </button>
                </form>
            @endif
        </div>

        <!-- Invoice Tab -->
        @if(in_array($campaign->status, ['waiting_payment', 'waiting_to_run', 'running', 'completed']))
            <div id="content-invoice" class="tab-content" style="display: none; padding: 2rem;">
                @include('campaigns.partials.invoice', ['campaign' => $campaign])
            </div>
        @endif

        <!-- Report Tab -->
        @if($campaign->status === 'running')
            <div id="content-report" class="tab-content" style="display: none; padding: 2rem;">
                @include('campaigns.partials.report', ['campaign' => $campaign])
            </div>
        @endif
    </div>
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
