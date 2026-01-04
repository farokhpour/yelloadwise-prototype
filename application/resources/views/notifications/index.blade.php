@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <div style="font-size: 5rem; margin-bottom: 1rem;">📱</div>
        <h1 style="color: #333; margin-bottom: 0.5rem; font-size: 2.5rem;">پلتفرم اعلان‌های تراکنشی</h1>
        <p style="color: #666; font-size: 1.2rem; max-width: 800px; margin: 0 auto;">
            پروتوتایپ آموزشی برای نمایش رفتار سیستم، حاکمیت و جریان توسعه‌دهنده
        </p>
    </div>

    <!-- Important Notice -->
    <div style="background: #fff3cd; border: 2px solid #ffc107; padding: 2rem; border-radius: 12px; margin-bottom: 3rem;">
        <div style="display: flex; align-items: start; gap: 1rem;">
            <div style="font-size: 3rem; flex-shrink: 0;">⚠️</div>
            <div>
                <h3 style="color: #856404; margin-bottom: 1rem; font-size: 1.3rem;">محدودیت‌های پروتوتایپ</h3>
                <ul style="color: #856404; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li><strong>بدون احراز هویت:</strong> این پروتوتایپ برای نمایش جریان است، نه امنیت</li>
                    <li><strong>بدون مجوزدهی:</strong> همه دسترسی‌ها باز است</li>
                    <li><strong>بدون اعتبارسنجی واقعی:</strong> اعتبارسنجی‌ها ساده شده‌اند</li>
                    <li><strong>بدون ارسال SMS واقعی:</strong> فقط شبیه‌سازی است</li>
                    <li><strong>هدف:</strong> درک سیستم، حاکمیت و جریان توسعه‌دهنده</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- What is happening here -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">📖 چه اتفاقی اینجا می‌افتد؟</h2>
        <p style="color: #555; line-height: 2; font-size: 1.05rem; margin-bottom: 1.5rem;">
            این یک <strong>پروتوتایپ آموزشی</strong> برای پلتفرم اعلان‌های تراکنشی است. هدف این پروتوتایپ نمایش رفتار سیستم، 
            فرآیندهای حاکمیتی و جریان کار توسعه‌دهندگان است. این سیستم به توسعه‌دهندگان و مدیران محصول کمک می‌کند تا 
            کل سیستم را با یک بار کلیک کردن درک کنند.
        </p>
        <p style="color: #555; line-height: 2; font-size: 1.05rem; margin: 0;">
            هر صفحه شامل توضیحات درون‌خطی است که توضیح می‌دهد چرا چیزی وجود دارد و چگونه کار می‌کند.
        </p>
    </div>

    <!-- Why this design exists -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">🎯 چرا این طراحی وجود دارد؟</h2>
        <p style="color: #555; line-height: 2; font-size: 1.05rem; margin-bottom: 1.5rem;">
            این پروتوتایپ برای <strong>اعتبارسنجی مفهوم</strong> و <strong>هم‌راستایی تیم</strong> طراحی شده است. 
            این یک نمایش UI نیست، بلکه یک <strong>توضیح‌دهنده رفتار سیستم</strong> است.
        </p>
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-top: 1.5rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">اصول طراحی:</h4>
            <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                <li><strong>تمرکز بر درک:</strong> هر صفحه باید توضیح دهد چه اتفاقی می‌افتد و چرا</li>
                <li><strong>جریان واضح:</strong> جداسازی واضح مسیر کاربر و ادمین</li>
                <li><strong>بدون حواس‌پرتی:</strong> UI ساده و تمیز</li>
                <li><strong>برچسب‌گذاری:</strong> اگر چیزی ساده شده است، صریحاً برچسب "ساده شده برای پروتوتایپ" دارد</li>
            </ul>
        </div>
    </div>

    <!-- System Overview -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">🏗️ نمای کلی سیستم</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div style="background: #e8f5e9; padding: 2rem; border-radius: 8px; border-right: 4px solid #28a745;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">👤</div>
                <h3 style="color: #2e7d32; margin-bottom: 1rem; text-align: center;">مسیر کاربر</h3>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li>ایجاد قالب اعلان</li>
                    <li>انتخاب نوع قالب (OTP, WALLET, ORDER)</li>
                    <li>تعریف پارامترهای قالب</li>
                    <li>مشاهده قالب‌های ایجاد شده</li>
                    <li>مشاهده مستندات API</li>
                </ul>
            </div>

            <div style="background: #fff3e0; padding: 2rem; border-radius: 8px; border-right: 4px solid #ff9800;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">🔧</div>
                <h3 style="color: #e65100; margin-bottom: 1rem; text-align: center;">مسیر ادمین</h3>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li>مشاهده قالب‌های در انتظار تایید</li>
                    <li>تایید قالب‌ها</li>
                    <li>برگشت دادن قالب‌ها با نظر</li>
                    <li>حاکمیت و انطباق</li>
                </ul>
            </div>

            <div style="background: #e3f2fd; padding: 2rem; border-radius: 8px; border-right: 4px solid #2196f3;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">📚</div>
                <h3 style="color: #1565c0; margin-bottom: 1rem; text-align: center;">مستندات API</h3>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li>نمای کلی سیستم</li>
                    <li>چرخه حیات قالب</li>
                    <li>مثال‌های API</li>
                    <li>مرجع Template ID</li>
                    <li>سناریوهای خطا</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Template Types -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">📋 انواع قالب‌ها</h2>
        
        <div style="display: grid; gap: 1.5rem;">
            <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; border: 2px solid #dee2e6;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <span style="font-size: 2rem; font-weight: bold; color: #007bff;">OTP</span>
                    <span style="padding: 0.25rem 0.75rem; background: #dc3545; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 600;">
                        فقط تراکنشی - غیر تبلیغاتی
                    </span>
                </div>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    قالب‌های OTP کاملاً کنترل می‌شوند تا از سوء استفاده و مسدود شدن توسط اپراتور جلوگیری شود. 
                    متن قفل شده است و کاربر فقط می‌تواند زمان انقضا و زبان را تنظیم کند.
                </p>
            </div>

            <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; border: 2px solid #dee2e6;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <span style="font-size: 2rem; font-weight: bold; color: #28a745;">WALLET</span>
                    <span style="padding: 0.25rem 0.75rem; background: #dc3545; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 600;">
                        فقط تراکنشی - غیر تبلیغاتی
                    </span>
                </div>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    پیام‌های کیف پول بر اساس رویداد هستند و نمی‌توانند به صورت دستی ارسال شوند. 
                    کاربر می‌تواند نام برند، نوع عملیات و نمایش موجودی را تنظیم کند.
                </p>
            </div>

            <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; border: 2px solid #dee2e6;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <span style="font-size: 2rem; font-weight: bold; color: #ffc107;">ORDER</span>
                    <span style="padding: 0.25rem 0.75rem; background: #dc3545; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 600;">
                        فقط تراکنشی - غیر تبلیغاتی
                    </span>
                </div>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    اعلان‌های سفارش به شدت به مرجع سفارش مرتبط هستند. کاربر می‌تواند رویداد سفارش، 
                    نام برند و نمایش مبلغ را تنظیم کند.
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
        <h2 style="color: #333; margin-bottom: 1.5rem;">🚀 شروع کار</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
            <a href="{{ route('epics.notifications.user.templates.index') }}" 
               style="display: block; padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">👤</div>
                <div>ایجاد قالب (کاربر)</div>
            </a>
            
            <a href="{{ route('epics.notifications.admin.templates.index') }}" 
               style="display: block; padding: 1.5rem; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 12px rgba(240, 147, 251, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🔧</div>
                <div>بررسی قالب (ادمین)</div>
            </a>
            
            <a href="{{ route('epics.notifications.user.api-docs') }}" 
               style="display: block; padding: 1.5rem; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; transition: all 0.3s;"
               onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 4px 12px rgba(79, 172, 254, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📚</div>
                <div>مستندات API</div>
            </a>
        </div>
    </div>
</div>
@endsection

