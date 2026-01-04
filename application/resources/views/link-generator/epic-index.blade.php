@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <div style="font-size: 5rem; margin-bottom: 1rem;">🔗</div>
        <h1 style="color: #333; margin-bottom: 0.5rem; font-size: 2.5rem;">تولیدکننده لینک</h1>
        <p style="color: #666; font-size: 1.2rem; max-width: 800px; margin: 0 auto;">
            سیستم تولید و مدیریت لینک‌های تبلیغاتی با پارامترهای UTM و قابلیت پیگیری کلیک‌ها
        </p>
    </div>

    <!-- Purpose Section -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem; border-radius: 12px; color: white; margin-bottom: 3rem;">
        <h2 style="margin-bottom: 1.5rem; text-align: center;">🎯 هدف سیستم</h2>
        <p style="line-height: 2; text-align: center; font-size: 1.1rem; max-width: 900px; margin: 0 auto;">
            این سیستم ابزار مدیریت لینک‌های تبلیغاتی با قابلیت پیگیری و گزارش‌گیری را برای ادمین‌ها فراهم می‌کند. 
            امکان ایجاد لینک‌های کوتاه با پارامترهای UTM، پیگیری کلیک‌ها و مشاهده گزارش‌های تفصیلی در دسترس است.
        </p>
    </div>

    <!-- How It Works -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">⚙️ نحوه کار سیستم</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div style="background: #e8f5e9; padding: 2rem; border-radius: 8px; border-right: 4px solid #28a745;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">1️⃣</div>
                <h3 style="color: #2e7d32; margin-bottom: 1rem; text-align: center;">ایجاد لینک</h3>
                <p style="color: #555; line-height: 1.8; text-align: center;">
                    ادمین لینک فرود (Landing URL) و پارامترهای UTM را وارد می‌کند. می‌تواند لینک را به یک کمپین مرتبط کند (اختیاری).
                </p>
            </div>

            <div style="background: #fff3e0; padding: 2rem; border-radius: 8px; border-right: 4px solid #ff9800;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">2️⃣</div>
                <h3 style="color: #e65100; margin-bottom: 1rem; text-align: center;">تولید لینک</h3>
                <p style="color: #555; line-height: 1.8; text-align: center;">
                    سیستم به صورت خودکار لینک کامل با پارامترهای UTM و لینک کوتاه (http://ylad.ir/{token}) را تولید می‌کند.
                </p>
            </div>

            <div style="background: #e3f2fd; padding: 2rem; border-radius: 8px; border-right: 4px solid #2196f3;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">3️⃣</div>
                <h3 style="color: #1565c0; margin-bottom: 1rem; text-align: center;">پیگیری کلیک‌ها</h3>
                <p style="color: #555; line-height: 1.8; text-align: center;">
                    هر کلیک روی لینک کوتاه یا کامل ثبت و شمارش می‌شود. اطلاعات کلیک‌ها به صورت روزانه ذخیره می‌شود.
                </p>
            </div>

            <div style="background: #f3e5f5; padding: 2rem; border-radius: 8px; border-right: 4px solid #9c27b0;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">4️⃣</div>
                <h3 style="color: #6a1b9a; margin-bottom: 1rem; text-align: center;">گزارش‌گیری</h3>
                <p style="color: #555; line-height: 1.8; text-align: center;">
                    ادمین می‌تواند گزارش تفصیلی با نمودار خطی کلیک‌ها در 30 روز گذشته را مشاهده کند.
                </p>
            </div>
        </div>
    </div>

    <!-- Important Note -->
    <div style="background: #fff3cd; border: 2px solid #ffc107; padding: 2rem; border-radius: 12px; margin-bottom: 3rem;">
        <div style="display: flex; align-items: start; gap: 1rem;">
            <div style="font-size: 3rem; flex-shrink: 0;">⚠️</div>
            <div>
                <h3 style="color: #856404; margin-bottom: 1rem; font-size: 1.3rem;">توجه مهم</h3>
                <p style="color: #856404; line-height: 2; font-size: 1.05rem; margin: 0;">
                    <strong>گزارش‌های لینک‌ها فقط در این بخش (تولیدکننده لینک) در دسترس است.</strong>
                    این گزارش‌ها در پنل ادمین کمپین‌ها یا پنل کاربر کمپین‌ها نمایش داده نمی‌شوند. 
                    اگر لینکی به یک کمپین مرتبط شده باشد، اطلاعات لینک (مانند تعداد کلیک‌ها) در صفحات کمپین قابل مشاهده نیست.
                </p>
                <p style="color: #856404; line-height: 2; font-size: 1.05rem; margin: 1rem 0 0 0;">
                    برای مشاهده گزارش‌های لینک‌ها، باید از بخش "تولیدکننده لینک" استفاده کنید.
                </p>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">✨ ویژگی‌های سیستم</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔗</div>
                <h4 style="color: #333; margin-bottom: 0.5rem;">لینک کوتاه</h4>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">تولید خودکار لینک کوتاه با فرمت http://ylad.ir/{token}</p>
            </div>
            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📊</div>
                <h4 style="color: #333; margin-bottom: 0.5rem;">پارامترهای UTM</h4>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">امکان افزودن چندین پارامتر UTM به لینک</p>
            </div>
            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📈</div>
                <h4 style="color: #333; margin-bottom: 0.5rem;">پیگیری کلیک‌ها</h4>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">ثبت و شمارش خودکار کلیک‌ها</p>
            </div>
            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📉</div>
                <h4 style="color: #333; margin-bottom: 0.5rem;">نمودار کلیک‌ها</h4>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">نمودار خطی کلیک‌ها در 30 روز گذشته</p>
            </div>
            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔗</div>
                <h4 style="color: #333; margin-bottom: 0.5rem;">ارتباط با کمپین</h4>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">امکان مرتبط کردن لینک با کمپین (اختیاری)</p>
            </div>
            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">✏️</div>
                <h4 style="color: #333; margin-bottom: 0.5rem;">ویرایش لینک</h4>
                <p style="color: #666; font-size: 0.9rem; margin: 0;">امکان ویرایش لینک و پارامترهای UTM</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center;">
        <h2 style="color: #333; margin-bottom: 1.5rem;">🚀 شروع کار</h2>
        <p style="color: #666; margin-bottom: 2rem; font-size: 1.1rem;">
            برای شروع استفاده از سیستم تولیدکننده لینک، به صفحه مدیریت لینک‌ها بروید
        </p>
        <a href="{{ route('epics.link-generator.index') }}" 
           style="display: inline-block; padding: 1rem 2rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s;"
           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
            📋 رفتن به صفحه مدیریت لینک‌ها
        </a>
    </div>
</div>
@endsection

