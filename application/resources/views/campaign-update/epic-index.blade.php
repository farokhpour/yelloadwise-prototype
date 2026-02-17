@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <div style="font-size: 5rem; margin-bottom: 1rem;">✏️</div>
        <h1 style="color: #333; margin-bottom: 0.5rem; font-size: 2.5rem;">قابلیت به‌روزرسانی داده‌های کمپین</h1>
        <p style="color: #666; font-size: 1.2rem; max-width: 800px; margin: 0 auto;">
            سیستم به‌روزرسانی داده‌های کمپین توسط ادمین با دو فرم جداگانه برای مدیریت قیمت، تخفیف و اطلاعات هدف
        </p>
    </div>

    <!-- Purpose Section -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem; border-radius: 12px; color: white; margin-bottom: 3rem;">
        <h2 style="margin-bottom: 1.5rem; text-align: center;">🎯 هدف سیستم</h2>
        <p style="line-height: 2; text-align: center; font-size: 1.1rem; max-width: 900px; margin: 0 auto;">
            این سیستم امکان به‌روزرسانی داده‌های کمپین توسط ادمین را از طریق دو فرم جداگانه فراهم می‌کند. 
            فرم اول برای مدیریت قیمت، درصد تخفیف و گزینه مفاصا حساب و فرم دوم برای تعیین هدف و تاریخ شروع کمپین طراحی شده است.
        </p>
    </div>

    <!-- How It Works -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">⚙️ نحوه کار سیستم</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            <div style="background: #fff9c4; padding: 2rem; border-radius: 8px; border-right: 4px solid #fbc02d;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">1️⃣</div>
                <h3 style="color: #f57f17; margin-bottom: 1rem; text-align: center;">فرم اول: قیمت یک اقدام و تخفیف</h3>
                <p style="color: #555; line-height: 1.8; text-align: center; margin-bottom: 1rem;">
                    ادمین می‌تواند قیمت کمپین، درصد تخفیف و گزینه مفاصا حساب را تنظیم کند.
                </p>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; text-align: right; font-size: 0.95rem;">
                    <li><strong>قیمت:</strong> تعیین قیمت یک اقدام(روز، ارسال، کلیک) </li>
                    <li><strong>درصد تخفیف:</strong> اعمال تخفیف از 0 تا 100 درصد </li>
                    <li><strong>مفاصا حساب:</strong> فعال یا غیرفعال کردن گزینه مفاصا حساب</li>
                </ul>
                <div style="background: rgba(255,255,255,0.7); padding: 1rem; border-radius: 6px; margin-top: 1rem;">
                    <p style="color: #555; font-size: 0.9rem; margin: 0; line-height: 1.8;">
                        ✅ تنها محدودیت این فرم این است که کمپین نباید پرداخت شده باشد و با به‌روزرسانی آن، فاکتور مجدد با پارامترهای جدید ایجاد می‌شود.
                    </p>
                </div>
            </div>

            <div style="background: #e3f2fd; padding: 2rem; border-radius: 8px; border-right: 4px solid #2196f3;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">2️⃣</div>
                <h3 style="color: #1565c0; margin-bottom: 1rem; text-align: center;">فرم دوم: هدف و تاریخ</h3>
                <p style="color: #555; line-height: 1.8; text-align: center; margin-bottom: 1rem;">
                    ادمین می‌تواند هدف کمپین و تاریخ شروع اجرای آن را مشخص کند.
                </p>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; text-align: right; font-size: 0.95rem;">
                    <li><strong>هدف:</strong> تعداد روز یا تعداد پیامک کمپین</li>
                    <li><strong>تاریخ شروع:</strong> انتخاب تاریخ شروع اجرای کمپین</li>
                </ul>
                <div style="background: rgba(255,255,255,0.7); padding: 1rem; border-radius: 6px; margin-top: 1rem;">
                    <p style="color: #1565c0; font-size: 0.85rem; margin: 0 0 0.5rem 0; font-weight: 600;">⚠️ محدودیت‌ها بر اساس وضعیت کمپین:</p>
                    <ul style="color: #555; font-size: 0.85rem; margin: 0; padding-right: 1.5rem; line-height: 1.9;">
                        <li><strong>🔴 تمام شده:</strong> امکان تغییر وجود ندارد</li>
                        <li><strong>🟢 در انتظار اجرا:</strong> بدون محدودیت</li>
                        <li><strong>🟡 در حال اجرا (پرداخت نشده):</strong> افزایش هدف بدون محدودیت قابل انجام است، کاهش هدف فقط در صورتی که تعداد روز های دارای گزارش از تعداد هدف جدید کم تر باشد، تغییر تاریخ شروع به قبل از تاریخ شروع فعلی وجود ندارد و به جلو بردن آن فقط در صورتی امکان پذیر است که در تاریخ های بعدی گزارش کمپین وجود</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Forms Section -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">📋 فرم‌های به‌روزرسانی</h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
            <!-- Form 1 Card -->
            <div style="background: #f8f9fa; padding: 2rem; border-radius: 12px; border: 2px solid #dee2e6;">
                <h3 style="color: #333; margin-bottom: 1rem; text-align: center;">📊 فرم اول</h3>
                <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h4 style="color: #555; margin-bottom: 1rem;">فیلدهای فرم:</h4>
                    <ul style="color: #666; line-height: 2.5; padding-right: 1.5rem; margin: 0;">
                        <li>💰 <strong>قیمت:</strong> قیمت یک اقدام</li>
                        <li>📉 <strong>درصد تخفیف:</strong> درصد تخفیف</li>
                        <li>✅ <strong>مفاصا حساب:</strong> چک‌باکس (در صورتی که گزینه مفاصا حساب مشتری فعال باشد)</li>
                    </ul>
                </div>
                <a href="{{ route('epics.campaign-update.update-form-1', ['id' => 1]) }}" 
                   style="display: block; padding: 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; text-align: center; transition: all 0.3s;"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    🔗 رفتن به فرم اول
                </a>
                <p style="color: #999; font-size: 0.85rem; text-align: center; margin-top: 0.5rem;">
                    * شناسه کمپین را با شناسه واقعی جایگزین کنید
                </p>
            </div>

            <!-- Form 2 Card -->
            <div style="background: #f8f9fa; padding: 2rem; border-radius: 12px; border: 2px solid #dee2e6;">
                <h3 style="color: #333; margin-bottom: 1rem; text-align: center;">🎯 فرم دوم</h3>
                <div style="background: white; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h4 style="color: #555; margin-bottom: 1rem;">فیلدهای فرم:</h4>
                    <ul style="color: #666; line-height: 2.5; padding-right: 1.5rem; margin: 0;">
                        <li>🎯 <strong>هدف:</strong> تعداد روز یا تعداد پیامک</li>
                        <li>📅 <strong>تاریخ شروع:</strong> تاریخ شروع کمپین</li>
                    </ul>
                </div>
                <a href="{{ route('epics.campaign-update.update-form-2', ['id' => 1]) }}" 
                   style="display: block; padding: 1rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; border-radius: 8px; font-weight: 600; text-align: center; transition: all 0.3s;"
                   onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
                   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                    🔗 رفتن به فرم دوم
                </a>
                <p style="color: #999; font-size: 0.85rem; text-align: center; margin-top: 0.5rem;">
                    * شناسه کمپین را با شناسه واقعی جایگزین کنید
                </p>
            </div>
        </div>
    </div>

    <!-- Note Section -->
    <div style="background: #fff3cd; border: 2px solid #ffc107; padding: 2rem; border-radius: 12px; margin-bottom: 3rem;">
        <div style="display: flex; align-items: start; gap: 1rem;">
            <div style="font-size: 3rem; flex-shrink: 0;">⚠️</div>
            <div>
                <h3 style="color: #856404; margin-bottom: 1rem; font-size: 1.3rem;">توجه مهم</h3>
                <p style="color: #856404; line-height: 2; font-size: 1.05rem; margin: 0;">
                    این یک پروتوتایپ است و داده‌های وارد شده در فرم‌ها در پایگاه داده ذخیره نمی‌شوند. 
                    هدف این سیستم نمایش جریان کار و رابط کاربری فرم‌های به‌روزرسانی کمپین است.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

