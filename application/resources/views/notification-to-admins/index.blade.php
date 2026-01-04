@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <div style="font-size: 5rem; margin-bottom: 1rem;">🔔</div>
        <h1 style="color: #333; margin-bottom: 0.5rem; font-size: 2.5rem;">اعلان‌رسانی به ادمین‌ها</h1>
        <p style="color: #666; font-size: 1.2rem; max-width: 800px; margin: 0 auto;">
            مستندات نیازمندی‌های سیستم اعلان‌رسانی برای توسعه‌دهندگان بک‌اند
        </p>
    </div>

    <!-- Important Note -->
    <div style="background: #e3f2fd; border: 2px solid #2196f3; padding: 2rem; border-radius: 12px; margin-bottom: 3rem;">
        <div style="display: flex; align-items: start; gap: 1rem;">
            <div style="font-size: 3rem; flex-shrink: 0;">ℹ️</div>
            <div>
                <h3 style="color: #1565c0; margin-bottom: 1rem; font-size: 1.3rem;">توجه</h3>
                <p style="color: #1565c0; line-height: 2; font-size: 1.05rem; margin: 0;">
                    این صفحه شامل <strong>نیازمندی‌ها و توضیحات</strong> سیستم اعلان‌رسانی است و برای راهنمایی توسعه‌دهندگان بک‌اند طراحی شده است. 
                    این صفحه <strong>پیاده‌سازی واقعی</strong> سیستم اعلان‌رسانی نیست و فقط <strong>مستندات نیازمندی‌ها</strong> را ارائه می‌دهد.
                </p>
            </div>
        </div>
    </div>

    <!-- Admin Types -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">👥 انواع ادمین کمپین</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
            <!-- Admin Without SMS Config -->
            <div style="background: #f8f9fa; padding: 2rem; border-radius: 12px; border: 2px solid #dee2e6;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="font-size: 3rem;">1️⃣</div>
                    <h3 style="color: #333; margin: 0; font-size: 1.5rem;">ادمین کمپین بدون sms_config</h3>
                </div>
                <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">
                    این نوع ادمین <strong>تنظیمات SMS</strong> ندارد و باید اعلان‌های زیر را دریافت کند:
                </p>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li><strong>ایجاد کمپین توسط کاربر:</strong> وقتی کاربر یک کمپین جدید ایجاد می‌کند</li>
                    <li><strong>پرداخت کمپین:</strong> وقتی کاربر برای یک کمپین پرداخت انجام می‌دهد</li>
                    <li><strong>درخواست پرداخت:</strong> وقتی کاربر درخواست پرداخت برای کمپین می‌دهد</li>
                    <li><strong>ایجاد کاربر جدید:</strong> وقتی یک کاربر جدید در سیستم ثبت‌نام می‌کند</li>
                    <li><strong>تکمیل اطلاعات حساب:</strong> وقتی کاربر اطلاعات حساب خود را تکمیل می‌کند و منتظر تایید ادمین است</li>
                </ul>
            </div>

            <!-- Admin With SMS Config -->
            <div style="background: #f8f9fa; padding: 2rem; border-radius: 12px; border: 2px solid #dee2e6;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="font-size: 3rem;">2️⃣</div>
                    <h3 style="color: #333; margin: 0; font-size: 1.5rem;">ادمین کمپین با sms_config</h3>
                </div>
                <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">
                    این نوع ادمین <strong>تنظیمات SMS</strong> دارد و باید اعلان زیر را دریافت کند:
                </p>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li><strong>کمپین آماده اجرا:</strong> وقتی یک کمپین به وضعیت "آماده اجرا" (waiting_to_run) می‌رسد</li>
                    <li style="margin-top: 1rem; padding: 1rem; background: #fff3cd; border-radius: 6px; border-right: 4px solid #ffc107;">
                        <strong>مهم:</strong> این اعلان باید شامل <strong>لینک کمپین</strong> باشد تا ادمین بتواند مستقیماً به صفحه ویرایش کمپین دسترسی داشته باشد
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Notification Details -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">📋 جزئیات اعلان‌ها</h2>
        
        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h3 style="color: #333; margin-bottom: 1rem;">اعلان‌های ادمین بدون sms_config</h3>
            <div style="display: grid; gap: 1.5rem;">
                <div style="background: white; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #007bff;">
                    <h4 style="color: #007bff; margin-bottom: 0.75rem;">1. ایجاد کمپین توسط کاربر</h4>
                    <p style="color: #555; line-height: 1.8; margin: 0;">
                        <strong>رویداد:</strong> کاربر کمپین جدیدی ایجاد می‌کند<br>
                        <strong>اطلاعات مورد نیاز:</strong> شناسه کمپین، نام کمپین، نام کاربر، تاریخ ایجاد
                    </p>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #28a745;">
                    <h4 style="color: #28a745; margin-bottom: 0.75rem;">2. پرداخت کمپین</h4>
                    <p style="color: #555; line-height: 1.8; margin: 0;">
                        <strong>رویداد:</strong> کاربر برای کمپین پرداخت انجام می‌دهد<br>
                        <strong>اطلاعات مورد نیاز:</strong> شناسه کمپین، نام کمپین، مبلغ پرداخت، تاریخ پرداخت
                    </p>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #ffc107;">
                    <h4 style="color: #ffc107; margin-bottom: 0.75rem;">3. درخواست پرداخت</h4>
                    <p style="color: #555; line-height: 1.8; margin: 0;">
                        <strong>رویداد:</strong> کاربر درخواست پرداخت برای کمپین می‌دهد<br>
                        <strong>اطلاعات مورد نیاز:</strong> شناسه کمپین، نام کمپین، نام کاربر، تاریخ درخواست
                    </p>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #17a2b8;">
                    <h4 style="color: #17a2b8; margin-bottom: 0.75rem;">4. ایجاد کاربر جدید</h4>
                    <p style="color: #555; line-height: 1.8; margin: 0;">
                        <strong>رویداد:</strong> کاربر جدید در سیستم ثبت‌نام می‌کند<br>
                        <strong>اطلاعات مورد نیاز:</strong> شناسه کاربر، نام کاربر، ایمیل، تاریخ ثبت‌نام
                    </p>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #6f42c1;">
                    <h4 style="color: #6f42c1; margin-bottom: 0.75rem;">5. تکمیل اطلاعات حساب کاربری</h4>
                    <p style="color: #555; line-height: 1.8; margin: 0;">
                        <strong>رویداد:</strong> کاربر اطلاعات حساب خود را تکمیل می‌کند و منتظر تایید ادمین است<br>
                        <strong>اطلاعات مورد نیاز:</strong> شناسه کاربر، نام کاربر، تاریخ تکمیل اطلاعات، وضعیت انتظار تایید
                    </p>
                </div>
            </div>
        </div>

        <div style="background: #fff3cd; padding: 2rem; border-radius: 8px; border: 2px solid #ffc107;">
            <h3 style="color: #856404; margin-bottom: 1rem;">اعلان ادمین با sms_config</h3>
            <div style="background: white; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #dc3545;">
                <h4 style="color: #dc3545; margin-bottom: 0.75rem;">کمپین آماده اجرا</h4>
                <p style="color: #555; line-height: 1.8; margin-bottom: 1rem;">
                    <strong>رویداد:</strong> کمپین به وضعیت "آماده اجرا" (waiting_to_run) می‌رسد<br>
                    <strong>اطلاعات مورد نیاز:</strong> شناسه کمپین، نام کمپین، تاریخ آماده شدن
                </p>
                <div style="background: #f8f9fa; padding: 1rem; border-radius: 6px; border-right: 3px solid #28a745;">
                    <strong style="color: #28a745;">⚠️ الزامی:</strong> این اعلان باید شامل <strong>لینک مستقیم به صفحه ویرایش کمپین</strong> باشد تا ادمین بتواند مستقیماً به کمپین دسترسی داشته باشد.
                </div>
            </div>
        </div>
    </div>

    <!-- Implementation Notes -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">💡 نکات پیاده‌سازی</h2>
        
        <div style="display: grid; gap: 1.5rem;">
            <div style="background: #e8f5e9; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #28a745;">
                <h4 style="color: #2e7d32; margin-bottom: 0.75rem;">🔍 تشخیص نوع ادمین</h4>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    سیستم باید بر اساس وجود یا عدم وجود <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">sms_config</code> 
                    در پروفایل ادمین، نوع اعلان مناسب را ارسال کند.
                </p>
            </div>

            <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #2196f3;">
                <h4 style="color: #1565c0; margin-bottom: 0.75rem;">📨 روش ارسال اعلان</h4>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    روش ارسال اعلان (ایمیل، SMS، Push Notification، و غیره) باید توسط تیم بک‌اند تعیین شود. 
                    این مستندات فقط نیازمندی‌های محتوا و زمان ارسال را مشخص می‌کند.
                </p>
            </div>

            <div style="background: #fff3e0; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #ff9800;">
                <h4 style="color: #e65100; margin-bottom: 0.75rem;">🔗 لینک‌های اعلان</h4>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    برای اعلان "کمپین آماده اجرا" به ادمین‌های با sms_config، لینک باید مستقیماً به صفحه ویرایش کمپین 
                    (مثال: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">/epic/digital-taxi-rooftop/admin/campaigns/{id}/edit</code>) 
                    اشاره کند.
                </p>
            </div>

            <div style="background: #f3e5f5; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #9c27b0;">
                <h4 style="color: #6a1b9a; margin-bottom: 0.75rem;">⏱️ زمان ارسال</h4>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    اعلان‌ها باید بلافاصله پس از وقوع رویداد ارسال شوند. هیچ تاخیر یا زمان‌بندی خاصی برای ارسال اعلان‌ها در نظر گرفته نشده است.
                </p>
            </div>
        </div>
    </div>

    <!-- Summary -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem; border-radius: 12px; color: white;">
        <h2 style="margin-bottom: 1.5rem; text-align: center;">📝 خلاصه نیازمندی‌ها</h2>
        <div style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 8px; backdrop-filter: blur(10px);">
            <ul style="line-height: 2.5; padding-right: 1.5rem; margin: 0;">
                <li>سیستم باید دو نوع ادمین کمپین را تشخیص دهد: با sms_config و بدون sms_config</li>
                <li>ادمین‌های بدون sms_config باید 5 نوع اعلان دریافت کنند (ایجاد کمپین، پرداخت، درخواست پرداخت، ایجاد کاربر، تکمیل اطلاعات)</li>
                <li>ادمین‌های با sms_config باید اعلان "کمپین آماده اجرا" با لینک کمپین دریافت کنند</li>
                <li>اعلان‌ها باید بلافاصله پس از وقوع رویداد ارسال شوند</li>
                <li>اعلان "کمپین آماده اجرا" باید شامل لینک مستقیم به صفحه ویرایش کمپین باشد</li>
            </ul>
        </div>
    </div>
</div>
@endsection

