@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="margin-bottom: 2rem; color: #333;">داشبورد کاربر</h1>
    
    <!-- Statistics Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <!-- Total Campaigns Card -->
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <h3 style="margin: 0; font-size: 1rem; opacity: 0.9;">کل کمپین‌ها</h3>
                <span style="font-size: 2rem;">📊</span>
            </div>
            <div style="font-size: 2.5rem; font-weight: bold;">{{ number_format($totalCampaigns) }}</div>
        </div>
        
        <!-- Running Campaigns Card -->
        <div style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <h3 style="margin: 0; font-size: 1rem; opacity: 0.9;">کمپین‌های در حال اجرا</h3>
                <span style="font-size: 2rem;">▶️</span>
            </div>
            <div style="font-size: 2.5rem; font-weight: bold;">{{ number_format($runningCampaigns) }}</div>
        </div>
        
        <!-- Wallet Balance Card -->
        <div style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%); padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); color: white;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <h3 style="margin: 0; font-size: 1rem; opacity: 0.9;">موجودی کیف پول</h3>
                <span style="font-size: 2rem;">💰</span>
            </div>
            <div style="font-size: 2.5rem; font-weight: bold;">{{ number_format($walletBalance) }}</div>
            <div style="font-size: 0.9rem; opacity: 0.9; margin-top: 0.5rem;">تومان</div>
        </div>
    </div>
    
    <!-- Last 10 Transactions -->
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 2rem; margin-bottom: 2rem;">
        <h2 style="margin-bottom: 1.5rem; color: #333; border-bottom: 2px solid #eee; padding-bottom: 1rem;">10 تراکنش آخر</h2>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">شناسه</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نوع</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">مبلغ</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">توضیحات</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">تاریخ</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">وضعیت</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem;">{{ $transaction['id'] }}</td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: 
                                    @if($transaction['type'] === 'پرداخت') #dc3545
                                    @elseif($transaction['type'] === 'شارژ') #28a745
                                    @else #17a2b8
                                    @endif; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ $transaction['type'] }}
                                </span>
                            </td>
                            <td style="padding: 1rem; font-weight: 600; color: 
                                @if($transaction['type'] === 'پرداخت') #dc3545
                                @elseif($transaction['type'] === 'شارژ') #28a745
                                @else #17a2b8
                                @endif;">
                                {{ $transaction['type'] === 'پرداخت' ? '-' : '+' }}{{ number_format($transaction['amount']) }} تومان
                            </td>
                            <td style="padding: 1rem; color: #666;">{{ $transaction['description'] }}</td>
                            <td style="padding: 1rem; color: #666;">{{ $transaction['date'] }}</td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: #28a745; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ $transaction['status'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 3rem; text-align: center; color: #666;">
                                <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                                <p style="font-size: 1.1rem;">هیچ تراکنشی یافت نشد</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

