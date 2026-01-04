@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="color: #333; margin: 0;">ثبت دستگاه‌ها</h1>
        <a href="{{ route('epic.digital-taxi-rooftop.devices.create') }}" 
           style="display: inline-block; padding: 0.75rem 1.5rem; background: #28a745; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
           onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
            ➕ افزودن دستگاه
        </a>
    </div>

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

    @if($devices->isEmpty())
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 3rem; text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📱</div>
            <p style="color: #666; font-size: 1.1rem;">هیچ دستگاهی ثبت نشده است</p>
            <a href="{{ route('epic.digital-taxi-rooftop.devices.create') }}" 
               style="display: inline-block; margin-top: 1rem; padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
                افزودن اولین دستگاه
            </a>
        </div>
    @else
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">شناسه دستگاه</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">وضعیت</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">آخرین زمان آنلاین شدن</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">مسیر پیش‌فرض</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">مالک دستگاه</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($devices as $device)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem; font-weight: 500; font-family: monospace;">{{ $device->device_id }}</td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: {{ $device->status === 'live' ? '#28a745' : '#dc3545' }}; color: white; font-size: 0.875rem; font-weight: 600;">
                                    {{ $device->status === 'live' ? 'آنلاین' : 'آفلاین' }}
                                </span>
                            </td>
                            <td style="padding: 1rem; color: #666;">
                                {{ $device->last_status_updated_at ? $device->last_status_updated_at->format('Y-m-d H:i:s') : '-' }}
                            </td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; background: #007bff; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 500;">
                                    {{ $device->default_route }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <div>
                                    <p style="margin: 0; font-weight: 500;">{{ $device->owner_first_name }} {{ $device->owner_last_name }}</p>
                                    <p style="margin: 0.25rem 0 0 0; color: #666; font-size: 0.875rem;">کد ملی: {{ $device->owner_national_id }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

