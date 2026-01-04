@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="color: #333; margin: 0;">تولیدکننده لینک</h1>
        <a href="{{ route('epics.link-generator.create') }}" 
           style="display: inline-block; padding: 0.75rem 1.5rem; background: #28a745; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
           onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
            ➕ افزودن لینک
        </a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if($links->isEmpty())
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 3rem; text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">🔗</div>
            <p style="color: #666; font-size: 1.1rem;">هیچ لینکی ایجاد نشده است</p>
            <a href="{{ route('epics.link-generator.create') }}" 
               style="display: inline-block; margin-top: 1rem; padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
                افزودن اولین لینک
            </a>
        </div>
    @else
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">لینک کوتاه</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">لینک کامل</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نام کمپین</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نام مشتری</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نوع کمپین</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">کل کلیک‌ها</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($links as $link)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem;">
                                @if($link->token)
                                    <a href="http://ylad.ir/{{ $link->token }}" target="_blank" 
                                       style="color: #28a745; text-decoration: none; font-family: monospace; font-size: 0.875rem; font-weight: 600;">
                                        http://ylad.ir/{{ $link->token }}
                                    </a>
                                @else
                                    <span style="color: #999; font-size: 0.875rem;">-</span>
                                @endif
                            </td>
                            <td style="padding: 1rem;">
                                <a href="{{ $link->generated_link }}" target="_blank" 
                                   style="color: #007bff; text-decoration: none; font-family: monospace; font-size: 0.875rem; word-break: break-all;">
                                    {{ Str::limit($link->generated_link, 50) }}
                                </a>
                            </td>
                            <td style="padding: 1rem;">{{ $link->campaign_name ?? '-' }}</td>
                            <td style="padding: 1rem;">{{ $link->customer_name ?? '-' }}</td>
                            <td style="padding: 1rem;">
                                @if($link->campaign_type)
                                    <span style="padding: 0.25rem 0.75rem; background: #007bff; color: white; border-radius: 4px; font-size: 0.875rem;">
                                        {{ $link->campaign_type }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td style="padding: 1rem; font-weight: 600; color: #28a745;">{{ number_format($link->total_clicks) }}</td>
                            <td style="padding: 1rem;">
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('epics.link-generator.edit', $link->id) }}" 
                                       style="padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem;">
                                        ✏️ ویرایش
                                    </a>
                                    <a href="{{ route('epics.link-generator.report', $link->id) }}" 
                                       style="padding: 0.5rem 1rem; background: #17a2b8; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem;">
                                        📊 گزارش
                                    </a>
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

