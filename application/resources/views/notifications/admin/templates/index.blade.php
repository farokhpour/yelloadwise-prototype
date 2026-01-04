@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="color: #333; margin-bottom: 2rem;">بررسی قالب‌های اعلان</h1>

    <!-- What is happening here -->
    <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #2196f3;">
        <h3 style="color: #1565c0; margin-bottom: 0.75rem; font-size: 1.1rem;">📖 چه اتفاقی اینجا می‌افتد؟</h3>
        <p style="color: #1565c0; line-height: 1.8; margin: 0; font-size: 0.95rem;">
            این صفحه تمام قالب‌های ایجاد شده توسط کاربران را نمایش می‌دهد. شما به عنوان ادمین می‌توانید قالب‌ها را تایید کنید 
            یا با ارائه نظر، آن‌ها را به کاربر برگشت دهید. این فرآیند برای اطمینان از انطباق با مقررات مخابراتی و جلوگیری از سوء استفاده است.
        </p>
    </div>

    <!-- Why this design exists -->
    <div style="background: #fff3e0; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #ff9800;">
        <h3 style="color: #e65100; margin-bottom: 0.75rem; font-size: 1.1rem;">🎯 چرا این طراحی وجود دارد؟</h3>
        <p style="color: #e65100; line-height: 1.8; margin: 0; font-size: 0.95rem;">
            تایید ادمین برای اطمینان از انطباق با مقررات مخابراتی و جلوگیری از سوء استفاده وجود دارد. 
            بدون تایید ادمین، قالب‌ها نمی‌توانند در API استفاده شوند. این یک لایه حاکمیتی مهم است.
        </p>
    </div>

    <!-- Explanation Block -->
    <div style="background: #fff3cd; border: 2px solid #ffc107; padding: 2rem; border-radius: 12px; margin-bottom: 2rem;">
        <h3 style="color: #856404; margin-bottom: 1rem; font-size: 1.2rem;">ℹ️ توضیحات</h3>
        <p style="color: #856404; line-height: 2; margin: 0; font-size: 1.05rem;">
            تایید ادمین برای اطمینان از انطباق با مقررات مخابراتی و جلوگیری از سوء استفاده وجود دارد. 
            این فرآیند تضمین می‌کند که فقط قالب‌های مناسب و مطابق با قوانین می‌توانند در سیستم استفاده شوند.
        </p>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @if($templates->isEmpty())
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 3rem; text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">📋</div>
            <p style="color: #666; font-size: 1.1rem;">هیچ قالبی برای بررسی وجود ندارد</p>
        </div>
    @else
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">شناسه قالب</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">نوع</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">پیش‌نمایش کاربر</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">وضعیت</th>
                        <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">عملیات</th>
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
                                <div style="background: #f8f9fa; padding: 0.75rem; border-radius: 6px; font-family: monospace; font-size: 0.875rem; white-space: pre-wrap; max-width: 400px;">
                                    {{ $template->preview }}
                                </div>
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
                            </td>
                            <td style="padding: 1rem;">
                                @if($template->status === 'PENDING')
                                    <div style="display: flex; gap: 0.5rem; flex-direction: column;">
                                        <form method="POST" action="{{ route('epics.notifications.admin.templates.approve', $template->id) }}" style="margin: 0;">
                                            @csrf
                                            <button type="submit" 
                                                    style="width: 100%; padding: 0.5rem 1rem; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 0.875rem; font-weight: 600; cursor: pointer;">
                                                ✅ تایید
                                            </button>
                                        </form>
                                        <button type="button" 
                                                onclick="showReturnForm({{ $template->id }})"
                                                style="width: 100%; padding: 0.5rem 1rem; background: #dc3545; color: white; border: none; border-radius: 4px; font-size: 0.875rem; font-weight: 600; cursor: pointer;">
                                            ❌ برگشت
                                        </button>
                                    </div>
                                @else
                                    <span style="color: #999; font-size: 0.875rem;">-</span>
                                @endif
                            </td>
                        </tr>
                        
                        <!-- Return Form (Hidden by default) -->
                        <tr id="return-form-{{ $template->id }}" style="display: none; background: #fff3cd;">
                            <td colspan="5" style="padding: 1.5rem;">
                                <form method="POST" action="{{ route('epics.notifications.admin.templates.return', $template->id) }}">
                                    @csrf
                                    <div style="margin-bottom: 1rem;">
                                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #856404;">نظر ادمین (الزامی):</label>
                                        <textarea name="comment" rows="3" required
                                                  style="width: 100%; padding: 0.75rem; border: 2px solid #ffc107; border-radius: 6px; font-size: 1rem; box-sizing: border-box;"></textarea>
                                    </div>
                                    <div style="display: flex; gap: 0.5rem;">
                                        <button type="submit" 
                                                style="padding: 0.5rem 1rem; background: #dc3545; color: white; border: none; border-radius: 4px; font-weight: 600; cursor: pointer;">
                                            ارسال نظر و برگشت
                                        </button>
                                        <button type="button" 
                                                onclick="hideReturnForm({{ $template->id }})"
                                                style="padding: 0.5rem 1rem; background: #6c757d; color: white; border: none; border-radius: 4px; font-weight: 600; cursor: pointer;">
                                            انصراف
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<script>
    function showReturnForm(templateId) {
        document.getElementById('return-form-' + templateId).style.display = 'table-row';
    }

    function hideReturnForm(templateId) {
        document.getElementById('return-form-' + templateId).style.display = 'none';
    }
</script>
@endsection

