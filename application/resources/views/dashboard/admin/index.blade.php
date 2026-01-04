@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="margin-bottom: 2rem; color: #333;">داشبورد ادمین</h1>
    
    <!-- Running Campaigns Card -->
    <div style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white; margin-bottom: 2rem; max-width: 400px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
            <h3 style="margin: 0; font-size: 1rem; opacity: 0.9;">کمپین‌های در حال اجرا</h3>
            <span style="font-size: 2rem;">▶️</span>
        </div>
        <div style="font-size: 2.5rem; font-weight: bold;">{{ number_format($runningCampaigns) }}</div>
    </div>
    
    <!-- Clicks Per Channel Daily -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem; margin-bottom: 2rem;">
        <h2 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #eee; padding-bottom: 1rem;">کلیک‌های روزانه به تفکیک کانال (7 روز گذشته)</h2>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">تاریخ</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">Top Banner</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">Icon Row 1 - Left</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">Icon Row 1 - Left Middle</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">SMS</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">MCA</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">جمع کل</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clicksPerChannel as $day)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem; font-weight: 500;">{{ $day['date'] }}</td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #007bff; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ number_format($day['top_banner']) }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #28a745; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ number_format($day['icon_row_1_left']) }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #ffc107; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ number_format($day['icon_row_1_left_middle']) }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #17a2b8; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ number_format($day['sms']) }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #dc3545; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ number_format($day['mca']) }}
                                </span>
                            </td>
                            <td style="padding: 1rem; font-weight: 600; color: #333;">
                                {{ number_format($day['top_banner'] + $day['icon_row_1_left'] + $day['icon_row_1_left_middle'] + $day['sms'] + $day['mca']) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 3rem; text-align: center; color: #666;">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                                <p style="font-size: 1.1rem;">هیچ داده‌ای یافت نشد</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Yesterday SMS Stats -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
            <h3 style="margin-bottom: 1rem; color: #333; border-bottom: 2px solid #eee; padding-bottom: 0.75rem;">آمار پیامک دیروز</h3>
            <div style="margin-bottom: 1rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span style="color: #666;">کل ارسال شده:</span>
                    <span style="font-weight: 600; color: #007bff;">{{ number_format($yesterdaySmsSent) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span style="color: #666;">تحویل شده:</span>
                    <span style="font-weight: 600; color: #28a745;">{{ number_format($yesterdaySmsDelivered) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #666;">نرخ تحویل:</span>
                    <span style="font-weight: 600; color: #333;">{{ $yesterdayDeliveryRate }}%</span>
                </div>
            </div>
            <div style="background: #f8f9fa; border-radius: 8px; padding: 1rem; margin-top: 1rem;">
                <div style="background: #28a745; height: 8px; border-radius: 4px; width: {{ $yesterdayDeliveryRate }}%;"></div>
            </div>
        </div>
    </div>
    
    <!-- ECP Accounts Status -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem;">
        <h2 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #eee; padding-bottom: 1rem;">وضعیت ارسال پیامک توسط حساب‌های ECP</h2>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نام حساب</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">کل ارسال شده</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">اندازه صف</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">آخرین فعالیت</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ecpAccounts as $account)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem; font-weight: 500;">{{ $account['account_name'] }}</td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #007bff; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ number_format($account['total_sent']) }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                @if($account['queue_size'] > 0)
                                    <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #ffc107; color: white; font-size: 0.875rem; font-weight: 600;">
                                        {{ number_format($account['queue_size']) }}
                                    </span>
                                @else
                                    <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #28a745; color: white; font-size: 0.875rem; font-weight: 600;">
                                        خالی
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 1rem; color: #666;">{{ $account['last_activity'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 3rem; text-align: center; color: #666;">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                                <p style="font-size: 1.1rem;">هیچ حسابی یافت نشد</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

