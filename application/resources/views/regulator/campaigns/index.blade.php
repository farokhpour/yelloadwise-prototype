@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="margin-bottom: 2rem; color: #333;">کمپین‌های در انتظار تایید مجوز دهنده</h1>

    @if(session('success'))
        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('error') }}
        </div>
    @endif

    @if($campaigns->isEmpty())
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 3rem; text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📋</div>
            <p style="color: #666; font-size: 1.1rem;">هیچ کمپینی در انتظار تایید مجوز دهنده نیست</p>
        </div>
    @else
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">شناسه</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نام کمپین</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">روزها</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">تاریخ ایجاد</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campaigns as $campaign)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem;">{{ $campaign->id }}</td>
                            <td style="padding: 1rem; font-weight: 500;">{{ $campaign->name }}</td>
                            <td style="padding: 1rem;">{{ $campaign->days }} روز</td>
                            <td style="padding: 1rem; color: #666;">{{ $campaign->created_at->format('Y-m-d H:i') }}</td>
                            <td style="padding: 1rem;">
                                <a href="{{ route('epic.digital-taxi-rooftop.regulator.campaigns.show', $campaign->id) }}" 
                                   style="display: inline-block; padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-size: 0.875rem; font-weight: 500; transition: all 0.3s;"
                                   onmouseover="this.style.background='#0056b3'; this.style.transform='translateY(-2px)';"
                                   onmouseout="this.style.background='#007bff'; this.style.transform='translateY(0)';">
                                    مشاهده و تایید
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

