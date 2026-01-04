@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('epics.link-generator.index') }}" 
           style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none; font-weight: 500;">
            ← بازگشت به فهرست لینک‌ها
        </a>
        <h1 style="color: #333; margin-bottom: 0.5rem;">افزودن لینک جدید</h1>
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

    <form method="POST" action="{{ route('epics.link-generator.store') }}" 
          style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
        @csrf

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">لینک فرود (Landing URL) *</label>
            <input type="url" 
                   name="landing_url" 
                   value="{{ old('landing_url') }}" 
                   required
                   placeholder="https://example.com/landing"
                   style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.875rem;">آدرس URL صفحه فرود را وارد کنید</p>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">کمپین (اختیاری)</label>
            <select name="campaign_id" 
                    style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                <option value="">انتخاب کمپین (اختیاری)</option>
                @foreach($campaigns as $campaign)
                    <option value="{{ $campaign->id }}" {{ old('campaign_id') == $campaign->id ? 'selected' : '' }}>
                        {{ $campaign->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 2rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333;">پارامترهای UTM *</label>
            <div id="utms-container">
                <div class="utm-row" style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <input type="text" 
                           name="utms[0][key]" 
                           placeholder="کلید (مثال: utm_source)" 
                           required
                           style="flex: 1; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                    <input type="text" 
                           name="utms[0][value]" 
                           placeholder="مقدار (مثال: google)" 
                           required
                           style="flex: 1; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
                    <button type="button" 
                            onclick="removeUtmRow(this)"
                            style="padding: 0.75rem 1rem; background: #dc3545; color: white; border: none; border-radius: 6px; cursor: pointer; display: none;">
                        حذف
                    </button>
                </div>
            </div>
            <button type="button" 
                    onclick="addUtmRow()"
                    style="padding: 0.5rem 1rem; background: #28a745; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">
                ➕ افزودن UTM
            </button>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('epics.link-generator.index') }}" 
               style="display: inline-block; padding: 0.75rem 1.5rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.background='#5a6268';"
               onmouseout="this.style.background='#6c757d';">
                انصراف
            </a>
            <button type="submit" 
                    style="padding: 0.75rem 1.5rem; background: #28a745; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                    onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
                ایجاد لینک
            </button>
        </div>
    </form>
</div>

<script>
    let utmRowCount = 1;

    function addUtmRow() {
        const container = document.getElementById('utms-container');
        const newRow = document.createElement('div');
        newRow.className = 'utm-row';
        newRow.style.cssText = 'display: flex; gap: 0.5rem; margin-bottom: 0.5rem;';
        newRow.innerHTML = `
            <input type="text" 
                   name="utms[${utmRowCount}][key]" 
                   placeholder="کلید (مثال: utm_source)" 
                   required
                   style="flex: 1; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            <input type="text" 
                   name="utms[${utmRowCount}][value]" 
                   placeholder="مقدار (مثال: google)" 
                   required
                   style="flex: 1; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px; font-size: 1rem; box-sizing: border-box;">
            <button type="button" 
                    onclick="removeUtmRow(this)"
                    style="padding: 0.75rem 1rem; background: #dc3545; color: white; border: none; border-radius: 6px; cursor: pointer;">
                حذف
            </button>
        `;
        container.appendChild(newRow);
        utmRowCount++;
        updateRemoveButtons();
    }

    function removeUtmRow(button) {
        const container = document.getElementById('utms-container');
        if (container.children.length > 1) {
            button.parentElement.remove();
            updateRemoveButtons();
        }
    }

    function updateRemoveButtons() {
        const rows = document.querySelectorAll('.utm-row');
        rows.forEach((row, index) => {
            const removeBtn = row.querySelector('button[onclick*="removeUtmRow"]');
            if (removeBtn) {
                removeBtn.style.display = rows.length > 1 ? 'block' : 'none';
            }
        });
    }

    // Initialize
    updateRemoveButtons();
</script>
@endsection

