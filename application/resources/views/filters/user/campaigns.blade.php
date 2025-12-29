@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1>جدول کمپین‌های کاربر با فیلترهای پیشرفته</h1>
    
    <!-- Filters Section -->
    <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <form method="GET" action="{{ route('epics.filters.user.campaigns') }}" id="filterForm" style="display: grid; grid-template-columns: 1fr 1fr 1fr auto auto; gap: 1rem; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">نام کمپین</label>
                <input type="text" name="campaign_name" id="campaign_name" value="{{ request('campaign_name') }}" 
                       placeholder="جستجو بر اساس نام..."
                       style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;"
                       onkeypress="if(event.key === 'Enter') { event.preventDefault(); document.getElementById('filterForm').submit(); }">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">نوع کمپین</label>
                <select name="campaign_type" id="campaign_type" style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    <option value="">همه انواع</option>
                    <option value="irancell-man" {{ request('campaign_type') === 'irancell-man' ? 'selected' : '' }}>ایرانسل من</option>
                    <option value="missed-call" {{ request('campaign_type') === 'missed-call' ? 'selected' : '' }}>تماس از دست رفته</option>
                    <option value="targeted-sms" {{ request('campaign_type') === 'targeted-sms' ? 'selected' : '' }}>پیامک هدفمند</option>
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">وضعیت کمپین</label>
                <select name="campaign_status" id="campaign_status" style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    <option value="">همه وضعیت‌ها</option>
                    <option value="draft" {{ request('campaign_status') === 'draft' ? 'selected' : '' }}>پیش‌نویس</option>
                    <option value="waiting_admin_approval" {{ request('campaign_status') === 'waiting_admin_approval' ? 'selected' : '' }}>در انتظار تایید ادمین</option>
                    <option value="waiting_payment" {{ request('campaign_status') === 'waiting_payment' ? 'selected' : '' }}>در انتظار پرداخت</option>
                    <option value="waiting_to_run" {{ request('campaign_status') === 'waiting_to_run' ? 'selected' : '' }}>آماده اجرا</option>
                    <option value="running" {{ request('campaign_status') === 'running' ? 'selected' : '' }}>در حال اجرا</option>
                    <option value="completed" {{ request('campaign_status') === 'completed' ? 'selected' : '' }}>تکمیل شده</option>
                </select>
            </div>
            
            <div>
                <button type="submit" style="padding: 0.75rem 2rem; background: #007bff; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; white-space: nowrap;">
                    🔍 جستجو
                </button>
            </div>
            
            <div>
                <a href="{{ route('epics.filters.user.campaigns') }}" 
                   title="حذف فیلترها"
                   style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-size: 1.2rem; transition: all 0.3s;"
                   onmouseover="this.style.background='#5a6268'; this.style.transform='scale(1.1)';"
                   onmouseout="this.style.background='#6c757d'; this.style.transform='scale(1)';">
                    ✕
                </a>
            </div>
        </form>
    </div>

    <!-- Campaigns Table -->
    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa;">
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">شناسه</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">نام کمپین</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">نوع کمپین</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">وضعیت</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">روزها</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">ماشین‌ها</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">تاریخ ایجاد</th>
                </tr>
            </thead>
            <tbody>
                @forelse($campaigns as $campaign)
                    <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                        onmouseover="this.style.background='#f8f9fa';"
                        onmouseout="this.style.background='white';">
                        <td style="padding: 1rem;">{{ $campaign->id }}</td>
                        <td style="padding: 1rem; font-weight: 500;">{{ $campaign->name }}</td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #6c757d; color: white; font-size: 0.875rem; font-weight: 600;">
                                {{ $campaign->campaign_type_label ?? '-' }}
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: 
                                @if($campaign->status === 'draft') #6c757d
                                @elseif($campaign->status === 'waiting_admin_approval') #ffc107
                                @elseif($campaign->status === 'waiting_payment') #17a2b8
                                @elseif($campaign->status === 'waiting_to_run') #007bff
                                @elseif($campaign->status === 'running') #28a745
                                @else #dc3545
                                @endif; color: white; font-size: 0.875rem; font-weight: 600;">
                                @if($campaign->status === 'draft') پیش‌نویس
                                @elseif($campaign->status === 'waiting_admin_approval') در انتظار تایید ادمین
                                @elseif($campaign->status === 'waiting_payment') در انتظار پرداخت
                                @elseif($campaign->status === 'waiting_to_run') آماده اجرا
                                @elseif($campaign->status === 'running') در حال اجرا
                                @elseif($campaign->status === 'completed') تکمیل شده
                                @else لغو شده
                                @endif
                            </span>
                        </td>
                        <td style="padding: 1rem;">{{ $campaign->days }}</td>
                        <td style="padding: 1rem;">{{ $campaign->cars }}</td>
                        <td style="padding: 1rem;">{{ $campaign->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="padding: 3rem; text-align: center; color: #666;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                            <p style="font-size: 1.1rem;">هیچ کمپینی یافت نشد</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

