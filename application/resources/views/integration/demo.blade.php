@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="text-align: center; margin-bottom: 2rem;">نمایش نحوه کار سیستم نمایشگر تاکسی دیجیتال</h1>
    <!-- System Architecture Diagram -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">معماری سیستم</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem;">
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🚗</div>
                <h3>نمایشگر تاکسی دیجیتال</h3>
                <p style="color: #666; font-size: 0.9rem;">دستگاه بر اساس route_id خود یک صفحه فرانت از پنل یلوادوایز را درخواست می دهد</p>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🌐</div>
                <h3>مسیر فرانت‌اند</h3>
                <p style="color: #666; font-size: 0.9rem;">ََAPI فراخوانی کمپین بر اساس route_id</p>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">⚙️</div>
                <h3>API بک‌اند</h3>
                <p style="color: #666; font-size: 0.9rem;">بررسی کمپین های در حال اجرا و تطبیق آن ها با پارامتر های ارسالی از route_id و فراخوانی ویدیو از Minio</p>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📦</div>
                <h3>سطل MinIO</h3>
                <p style="color: #666; font-size: 0.9rem;">فایل‌های ویدیو را ذخیره و ارائه می‌دهد</p>
            </div>
        </div>
    </div>

    <!-- Flow Diagram -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">جریان درخواست</h2>
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-top: 2rem; direction: rtl;">
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e0f2f1; border-radius: 8px;">
                <strong>5. نمایش</strong><br>
                <span style="font-size: 0.875rem; color: #666;">نمایش ویدیو روی صفحه وب فراخوانی شده توسط دستگاه و نمایش روی دستگاه</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #f3e5f5; border-radius: 8px;">
                <strong>4. دریافت ویدیو</strong><br>
                <span style="font-size: 0.875rem; color: #666;">بازیابی از MinIO</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #fff3e0; border-radius: 8px;">
                <strong>3. تطبیق کمپین</strong><br>
                <span style="font-size: 0.875rem; color: #666;">یافتن کمپین در حال اجرا برای ماشین بر اساس موقعیت مکانی</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e8f5e9; border-radius: 8px;">
                <strong>2. فراخوانی API</strong><br>
                <span style="font-size: 0.875rem; color: #666;">/api/campaigns?route_id=X</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e3f2fd; border-radius: 8px;">
                <strong>1. دستگاه تاکسی</strong><br>
                <span style="font-size: 0.875rem; color: #666;">فراخوانی صفحه یلوادوایز با route_id و دریافت موقیعت مکانی مودم از API ایراسنل</span>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem; border-radius: 12px; color: white; margin-top: 3rem;">
        <h2 style="margin-bottom: 1.5rem;">نحوه کار سیستم</h2>
        <ol style="line-height: 2; padding-right: 1.5rem; direction: rtl;">
            <li><strong>ایجاد کمپین:</strong> کاربر کمپین را با ویدیو (یابدون ویدیو و بارگذاری ویدیو رو بر عهده ادمین می گذارد) ایجاد می‌کند، موقعیت‌ها را انتخاب می‌کند و پارامترها را تنظیم می‌کند.</li>
            <li><strong>تایید ادمین:</strong> ادمین بررسی می‌کند،در صورت نیاز آن را آپدیت می کند، هزینه را تنظیم و کمپین را تایید می‌کند.</li>
            <li><strong>پرداخت:</strong> کاربر برای کمپین پرداخت می‌کند(امکان رد مرحله ی پرداخت توسط ادمین وجود دارد).</li>
            <li><strong>فعال‌سازی کمپین:</strong> ادمین کمپین را شروع می‌کند و وضعیت را به "در حال اجرا" تغییر می‌دهد.</li>
            <li><strong>روش کار دستگاه:</strong> دستگاه‌های نمایشگر تاکسی دیجیتال صفحه ی یلوادوایز  را با route_id خود فراخوانی می‌کنند.</li>
            <li><strong>تطبیق ویدیو:</strong> بک‌اند کمپین‌های در حال اجرا را که با route_id مطابقت دارند پیدا می‌کند.</li>
            <li><strong>تحویل ویدیو:</strong> بک‌اند ویدیو را از MinIO بازیابی می‌کند و ویدیو را در صفحه ی فراخوانی شده توسط فرانت Steam می کند.</li>
            <li><strong>نمایش:</strong> دستگاه ویدیو را روی صفحه سقف نمایش می‌دهد.</li>
        </ol>
    </div>
</div>
@endsection
