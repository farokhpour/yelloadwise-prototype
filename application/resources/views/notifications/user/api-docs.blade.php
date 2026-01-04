@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="color: #333; margin-bottom: 2rem;">مستندات API اعلان‌های تراکنشی</h1>

    <!-- What is happening here -->
    <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #2196f3;">
        <h3 style="color: #1565c0; margin-bottom: 0.75rem; font-size: 1.1rem;">📖 چه اتفاقی اینجا می‌افتد؟</h3>
        <p style="color: #1565c0; line-height: 1.8; margin: 0; font-size: 0.95rem;">
            این صفحه مستندات کامل API برای ارسال اعلان‌های تراکنشی را ارائه می‌دهد. این شامل نمای کلی سیستم، 
            چرخه حیات قالب، مثال‌های API، مرجع Template ID و سناریوهای خطا است.
        </p>
    </div>

    <!-- Why this design exists -->
    <div style="background: #fff3e0; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #ff9800;">
        <h3 style="color: #e65100; margin-bottom: 0.75rem; font-size: 1.1rem;">🎯 چرا این طراحی وجود دارد؟</h3>
        <p style="color: #e65100; line-height: 1.8; margin: 0; font-size: 0.95rem;">
            مستندات API برای آموزش توسعه‌دهندگان در مورد نحوه یکپارچه‌سازی با سیستم طراحی شده است. 
            این صفحه تمام اطلاعات لازم برای استفاده از API را به زبان ساده و قابل فهم ارائه می‌دهد.
        </p>
    </div>

    <!-- Section 1: Overview -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">1. نمای کلی</h2>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">اعلان‌های تراکنشی بر اساس رویداد</h4>
            <p style="color: #555; line-height: 1.8; margin: 0;">
                سیستم اعلان‌های تراکنشی برای ارسال پیام‌های خودکار بر اساس رویدادهای سیستم طراحی شده است. 
                این اعلان‌ها فقط برای اهداف تراکنشی هستند و نباید برای تبلیغات استفاده شوند.
            </p>
        </div>

        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">رویکرد مبتنی بر قالب</h4>
            <p style="color: #555; line-height: 1.8; margin: 0;">
                تمام اعلان‌ها باید از قالب‌های از پیش تعریف شده استفاده کنند. این رویکرد اطمینان می‌دهد که 
                محتوای اعلان‌ها کنترل شده و مطابق با مقررات است.
            </p>
        </div>

        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
            <h4 style="color: #333; margin-bottom: 1rem;">وابستگی به تایید</h4>
            <p style="color: #555; line-height: 1.8; margin: 0;">
                قالب‌ها باید توسط ادمین تایید شوند قبل از اینکه بتوانند در API استفاده شوند. 
                این یک لایه حاکمیتی مهم برای اطمینان از انطباق است.
            </p>
        </div>
    </div>

    <!-- Section 2: Template Lifecycle -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">2. چرخه حیات قالب</h2>
        
        <div style="background: #e8f5e9; padding: 2rem; border-radius: 8px; border-right: 4px solid #28a745;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
                <span style="padding: 0.5rem 1rem; background: #6c757d; color: white; border-radius: 4px; font-weight: 600;">1. پیش‌نویس</span>
                <span style="font-size: 1.5rem;">→</span>
                <span style="padding: 0.5rem 1rem; background: #ffc107; color: white; border-radius: 4px; font-weight: 600;">2. در انتظار تایید</span>
                <span style="font-size: 1.5rem;">→</span>
                <span style="padding: 0.5rem 1rem; background: #28a745; color: white; border-radius: 4px; font-weight: 600;">3. تایید شده</span>
                <span style="font-size: 1.5rem;">→</span>
                <span style="padding: 0.5rem 1rem; background: #007bff; color: white; border-radius: 4px; font-weight: 600;">4. قابل استفاده در API</span>
            </div>
            <p style="color: #555; line-height: 1.8; margin: 0;">
                قالب ابتدا به صورت پیش‌نویس ایجاد می‌شود. پس از ارسال، وضعیت به "در انتظار تایید" تغییر می‌کند. 
                پس از تایید ادمین، قالب می‌تواند در فراخوانی‌های API استفاده شود.
            </p>
        </div>
    </div>

    <!-- Section 3: Send Notification API -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">3. API ارسال اعلان (شبیه‌سازی)</h2>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <p style="color: #666; margin-bottom: 1rem; font-size: 0.9rem;">
                <strong>نکته:</strong> این یک شبیه‌سازی است و در پروتوتایپ واقعی ارسال نمی‌شود.
            </p>
            
            <div style="background: #282c34; color: #abb2bf; padding: 1.5rem; border-radius: 6px; font-family: 'Courier New', monospace; overflow-x: auto;">
                <div style="margin-bottom: 0.5rem; color: #61afef;">POST</div>
                <div style="color: #98c379;">/api/v1/notifications/send</div>
            </div>
        </div>

        <div style="background: #282c34; color: #abb2bf; padding: 1.5rem; border-radius: 6px; font-family: 'Courier New', monospace; overflow-x: auto; margin-bottom: 1.5rem;">
            <div style="margin-bottom: 1rem; color: #61afef;">مثال 1: قالب OTP</div>
            <pre style="margin: 0; white-space: pre-wrap;">{
  <span style="color: #e06c75;">"template_id"</span>: <span style="color: #98c379;">"tpl_123456"</span>,
  <span style="color: #e06c75;">"recipient"</span>: <span style="color: #98c379;">"09xxxxxxxxx"</span>,
  <span style="color: #e06c75;">"variables"</span>: {
    <span style="color: #e06c75;">"otp_code"</span>: <span style="color: #98c379;">"123456"</span>
  }
}</pre>
        </div>

        <div style="background: #282c34; color: #abb2bf; padding: 1.5rem; border-radius: 6px; font-family: 'Courier New', monospace; overflow-x: auto; margin-bottom: 1.5rem;">
            <div style="margin-bottom: 1rem; color: #61afef;">مثال 2: قالب WALLET</div>
            <pre style="margin: 0; white-space: pre-wrap;">{
  <span style="color: #e06c75;">"template_id"</span>: <span style="color: #98c379;">"tpl_789012"</span>,
  <span style="color: #e06c75;">"recipient"</span>: <span style="color: #98c379;">"09xxxxxxxxx"</span>,
  <span style="color: #e06c75;">"variables"</span>: {
    <span style="color: #e06c75;">"amount"</span>: <span style="color: #98c379;">"50000"</span>,
    <span style="color: #e06c75;">"balance"</span>: <span style="color: #98c379;">"150000"</span>
  }
}</pre>
        </div>

        <div style="background: #282c34; color: #abb2bf; padding: 1.5rem; border-radius: 6px; font-family: 'Courier New', monospace; overflow-x: auto; margin-bottom: 1.5rem;">
            <div style="margin-bottom: 1rem; color: #61afef;">مثال 3: قالب ORDER</div>
            <pre style="margin: 0; white-space: pre-wrap;">{
  <span style="color: #e06c75;">"template_id"</span>: <span style="color: #98c379;">"tpl_345678"</span>,
  <span style="color: #e06c75;">"recipient"</span>: <span style="color: #98c379;">"09xxxxxxxxx"</span>,
  <span style="color: #e06c75;">"variables"</span>: {
    <span style="color: #e06c75;">"amount"</span>: <span style="color: #98c379;">"250000"</span>,
    <span style="color: #e06c75;">"order_link"</span>: <span style="color: #98c379;">"http://example.com/orders/12345"</span>
  }
}</pre>
            <div style="margin-top: 0.75rem; color: #e5c07b; font-size: 0.9rem;">
                ⚠️ توجه: order_link باید در فرمت HTTP باشد (نه HTTPS). این لینک در انتهای پیام نمایش داده می‌شود.
            </div>
        </div>

        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px;">
            <h4 style="color: #333; margin-bottom: 1rem;">توضیح فیلدها:</h4>
            <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                <li><strong>template_id:</strong> شناسه یکتای قالب که پس از تایید ادمین دریافت می‌کنید</li>
                <li><strong>recipient:</strong> شماره موبایل گیرنده (فرمت: 09xxxxxxxxx)</li>
                <li><strong>variables:</strong> متغیرهای مورد نیاز قالب:
                    <ul style="padding-right: 1.5rem; margin-top: 0.5rem;">
                        <li><strong>OTP:</strong> otp_code (کد تأیید)</li>
                        <li><strong>WALLET:</strong> amount (مبلغ تراکنش - اختیاری)، balance (موجودی - اختیاری)</li>
                        <li><strong>ORDER:</strong> amount (مبلغ سفارش - اختیاری)، order_link (لینک مشاهده سفارش - اختیاری، باید HTTP باشد)</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!-- Section 4: Template ID Reference -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">4. مرجع Template ID</h2>
        
        @if($approvedTemplates->isEmpty())
            <div style="background: #fff3cd; padding: 1.5rem; border-radius: 8px; text-align: center;">
                <p style="color: #856404; margin: 0;">هیچ قالب تایید شده‌ای وجود ندارد. پس از تایید قالب‌ها توسط ادمین، آن‌ها اینجا نمایش داده می‌شوند.</p>
            </div>
        @else
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    <strong>مهم:</strong> فقط قالب‌های تایید شده می‌توانند در فراخوانی‌های API استفاده شوند.
                </p>
            </div>

            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: white; border-bottom: 2px solid #dee2e6;">
                            <th style="padding: 0.75rem; text-align: right; font-weight: 600; color: #555;">Template ID</th>
                            <th style="padding: 0.75rem; text-align: right; font-weight: 600; color: #555;">نوع</th>
                            <th style="padding: 0.75rem; text-align: right; font-weight: 600; color: #555;">پیش‌نمایش</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($approvedTemplates as $template)
                            <tr style="border-bottom: 1px solid #dee2e6;">
                                <td style="padding: 0.75rem; font-family: monospace; font-weight: 600; color: #007bff;">
                                    {{ $template->template_id }}
                                </td>
                                <td style="padding: 0.75rem;">
                                    <span style="padding: 0.25rem 0.75rem; background: 
                                        @if($template->type === 'OTP') #007bff
                                        @elseif($template->type === 'WALLET') #28a745
                                        @else #ffc107
                                        @endif; color: white; border-radius: 4px; font-size: 0.875rem;">
                                        {{ $template->type }}
                                    </span>
                                </td>
                                <td style="padding: 0.75rem; font-family: monospace; font-size: 0.875rem; white-space: pre-wrap;">
                                    {{ $template->preview }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Section 5: Error Scenarios -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">5. سناریوهای خطا (مفهومی)</h2>
        
        <div style="display: grid; gap: 1rem;">
            <div style="background: #ffebee; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #f44336;">
                <h4 style="color: #c62828; margin-bottom: 0.75rem;">قالب تایید نشده</h4>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    اگر از یک Template ID استفاده کنید که هنوز تایید نشده است، API خطای 400 برمی‌گرداند: 
                    <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">"Template not approved"</code>
                </p>
            </div>

            <div style="background: #ffebee; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #f44336;">
                <h4 style="color: #c62828; margin-bottom: 0.75rem;">متغیرهای اشتباه</h4>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    اگر متغیرهای مورد نیاز قالب را ارسال نکنید یا نام آن‌ها اشتباه باشد، API خطای 400 برمی‌گرداند: 
                    <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">"Missing or invalid variables"</code>
                </p>
            </div>

            <div style="background: #ffebee; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #f44336;">
                <h4 style="color: #c62828; margin-bottom: 0.75rem;">موجودی ناکافی کیف پول (مفهومی)</h4>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    در سیستم واقعی، اگر موجودی کیف پول کاربر برای ارسال اعلان کافی نباشد، API خطای 402 برمی‌گرداند. 
                    این فقط یک مثال مفهومی است و در پروتوتایپ پیاده‌سازی نشده است.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

