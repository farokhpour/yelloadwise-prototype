@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="color: #333; margin: 0;">قالب‌های اعلان من</h1>
        <a href="{{ route('epics.notifications.user.templates.create') }}" 
           style="display: inline-block; padding: 0.75rem 1.5rem; background: #28a745; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
           onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
           onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
            ➕ ایجاد قالب جدید
        </a>
    </div>

    <!-- What is happening here -->
    <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #2196f3;">
        <h3 style="color: #1565c0; margin-bottom: 0.75rem; font-size: 1.1rem;">📖 چه اتفاقی اینجا می‌افتد؟</h3>
        <p style="color: #1565c0; line-height: 1.8; margin: 0; font-size: 0.95rem;">
            این جدول تمام قالب‌های اعلانی که شما ایجاد کرده‌اید را نمایش می‌دهد. هر قالب یک شناسه یکتا دارد که 
            پس از تایید ادمین، در فراخوانی‌های API استفاده می‌شود. وضعیت قالب نشان می‌دهد که آیا تایید شده، 
            در انتظار تایید است یا برگشت داده شده.
        </p>
    </div>

    <!-- Why this design exists -->
    <div style="background: #fff3e0; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #ff9800;">
        <h3 style="color: #e65100; margin-bottom: 0.75rem; font-size: 1.1rem;">🎯 چرا این طراحی وجود دارد؟</h3>
        <p style="color: #e65100; line-height: 1.8; margin: 0; font-size: 0.95rem;">
            نمایش قالب‌ها در یک جدول به کاربران امکان می‌دهد تا تمام قالب‌های خود را در یک نگاه ببینند و 
            وضعیت هر کدام را پیگیری کنند. شناسه قالب (Template ID) مهم است زیرا در API استفاده می‌شود.
        </p>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if($templates->isEmpty())
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 3rem; text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📝</div>
            <p style="color: #666; font-size: 1.1rem;">هیچ قالبی ایجاد نشده است</p>
            <a href="{{ route('epics.notifications.user.templates.create') }}" 
               style="display: inline-block; margin-top: 1rem; padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
                ایجاد اولین قالب
            </a>
        </div>
    @else
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">شناسه قالب</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نوع</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">وضعیت</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">پیش‌نمایش</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($templates as $template)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                            onmouseover="this.style.background='#f8f9fa';"
                            onmouseout="this.style.background='white';">
                            <td style="padding: 1rem; font-family: monospace; font-weight: 600; color: #007bff;">
                                {{ $template->template_id }}
                            </td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; background: 
                                    @if($template->type === 'OTP') #007bff
                                    @elseif($template->type === 'WALLET') #28a745
                                    @else #ffc107
                                    @endif; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 600;">
                                    {{ $template->type }}
                                </span>
                            </td>
                            <td style="padding: 1rem;">
                                <span style="padding: 0.25rem 0.75rem; background: 
                                    @if($template->status === 'APPROVED') #28a745
                                    @elseif($template->status === 'PENDING') #ffc107
                                    @else #dc3545
                                    @endif; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 600;">
                                    @if($template->status === 'APPROVED') تایید شده
                                    @elseif($template->status === 'PENDING') در انتظار تایید
                                    @else برگشت داده شده
                                    @endif
                                </span>
                                @if($template->status === 'RETURNED' && $template->admin_comment)
                                    <div style="margin-top: 0.5rem; padding: 0.5rem; background: #f8d7da; border-radius: 4px; font-size: 0.875rem; color: #721c24;">
                                        <strong>نظر ادمین:</strong> {{ $template->admin_comment }}
                                    </div>
                                @endif
                            </td>
                            <td style="padding: 1rem;">
                                <div style="background: #f8f9fa; padding: 0.75rem; border-radius: 6px; font-family: monospace; font-size: 0.875rem; white-space: pre-wrap;">
                                    {{ $template->preview }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; margin-top: 2rem; border-right: 4px solid #2196f3;">
            <p style="color: #1565c0; line-height: 1.8; margin: 0; font-size: 0.95rem;">
                <strong>نکته مهم:</strong> شناسه‌های قالب (Template ID) پس از تایید ادمین در فراخوانی‌های API استفاده می‌شوند. 
                فقط قالب‌های تایید شده می‌توانند در API استفاده شوند.
            </p>
        </div>
    @endif
</div>
@endsection

