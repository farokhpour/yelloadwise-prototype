@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1>مدیریت کمپین - ادمین</h1>
    
    <div style="margin-bottom: 2rem;">
        <a href="{{ route('campaigns.create') }}" style="display: inline-block; padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px;">
            ایجاد کمپین جدید
        </a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">شناسه</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">نام</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">وضعیت</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">روزها</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">ماشین‌ها</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">هزینه/روز</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($campaigns as $campaign)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 1rem;">{{ $campaign->id }}</td>
                    <td style="padding: 1rem;">{{ $campaign->name }}</td>
                    <td style="padding: 1rem;">
                        <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: 
                            @if($campaign->status === 'draft') #6c757d
                            @elseif($campaign->status === 'waiting_admin_approval') #ffc107
                            @elseif($campaign->status === 'waiting_payment') #17a2b8
                            @elseif($campaign->status === 'waiting_to_run') #007bff
                            @elseif($campaign->status === 'running') #28a745
                            @else #dc3545
                            @endif; color: white; font-size: 0.875rem;">
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
                    <td style="padding: 1rem;" class="ltr">${{ number_format($campaign->cost_per_day ?? 0, 2) }}</td>
                    <td style="padding: 1rem;">
                        <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" 
                           style="padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem;">
                            ویرایش
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding: 2rem; text-align: center; color: #666;">
                        کمپینی یافت نشد.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
