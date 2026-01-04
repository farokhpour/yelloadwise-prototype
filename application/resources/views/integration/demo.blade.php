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
            <li><strong>ایجاد کمپین:</strong> کاربر کمپین را با ویدیو (یا بدون ویدیو و بارگذاری ویدیو رو بر عهده ادمین می گذارد) ایجاد می‌کند، موقعیت‌ها را انتخاب می‌کند و پارامترها را تنظیم می‌کند.</li>
            <li><strong>تایید ادمین (مرحله اول):</strong> ادمین بررسی می‌کند، در صورت نیاز آن را آپدیت می کند، هزینه را تنظیم و کمپین را تایید می‌کند. پس از تایید، کمپین به مرحله تایید مجوز دهنده ارسال می‌شود.</li>
            <li><strong>تایید مجوز دهنده (مرحله دوم):</strong> مجوز دهنده کمپین‌های تایید شده توسط ادمین را بررسی می‌کند. مجوز دهنده می‌تواند کمپین را تایید کند (که به مرحله پرداخت می‌رود) یا با نظر به ادمین برگشت دهد.</li>
            <li><strong>پرداخت:</strong> کاربر برای کمپین‌های تایید شده توسط مجوز دهنده پرداخت می‌کند (امکان رد مرحله پرداخت توسط ادمین وجود دارد).</li>
            <li><strong>فعال‌سازی کمپین:</strong> ادمین کمپین را شروع می‌کند و وضعیت را به "در حال اجرا" تغییر می‌دهد.</li>
            <li><strong>روش کار دستگاه:</strong> دستگاه‌های نمایشگر تاکسی دیجیتال صفحه ی یلوادوایز را با route_id خود فراخوانی می‌کنند.</li>
            <li><strong>تطبیق ویدیو:</strong> بک‌اند کمپین‌های در حال اجرا را که با route_id مطابقت دارند پیدا می‌کند. اگر کمپین پیدا شود، سیستم با احتمال 75% ویدیو کمپین و با احتمال 25% یکی از ویدیوهای پیش‌فرض را به صورت تصادفی انتخاب می‌کند. اگر کمپینی پیدا نشود، یکی از ویدیوهای پیش‌فرض به صورت تصادفی نمایش داده می‌شود.</li>
            <li><strong>تحویل ویدیو:</strong> بک‌اند ویدیو را از MinIO (برای کمپین) یا از ویدیوهای پیش‌فرض بازیابی می‌کند و ویدیو را در صفحه ی فراخوانی شده توسط فرانت Stream می کند.</li>
            <li><strong>نمایش:</strong> دستگاه ویدیو را روی صفحه سقف نمایش می‌دهد.</li>
        </ol>
    </div>

    <!-- Device Status Tracking -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-top: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">📡 ردیابی وضعیت دستگاه‌ها</h2>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #007bff;">
            <h3 style="color: #333; margin-bottom: 1rem; font-size: 1.2rem;">نحوه تشخیص آنلاین یا آفلاین بودن دستگاه</h3>
            <p style="color: #555; line-height: 1.8; margin-bottom: 1rem;">
                سیستم از طریق مکانیزم "Heartbeat" (ضربان قلب) وضعیت دستگاه‌ها را ردیابی می‌کند:
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div style="background: #e8f5e9; padding: 1.5rem; border-radius: 8px; border: 1px solid #c8e6c9;">
                <h4 style="color: #2e7d32; margin-bottom: 1rem; font-size: 1.1rem;">🔄 فراخوانی دوره‌ای دستگاه</h4>
                <ul style="color: #555; line-height: 1.8; padding-right: 1.5rem; margin: 0;">
                    <li>دستگاه هر <strong>5 دقیقه</strong> یکبار به سرور فراخوانی می‌کند</li>
                    <li>در هر فراخوانی، دستگاه <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">device_id</code> را به عنوان query parameter ارسال می‌کند</li>
                    <li>مثال: <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">/api/campaigns?route_id=X&device_id=DEV-001</code></li>
                </ul>
            </div>

            <div style="background: #fff3e0; padding: 1.5rem; border-radius: 8px; border: 1px solid #ffcc80;">
                <h4 style="color: #e65100; margin-bottom: 1rem; font-size: 1.1rem;">✅ به‌روزرسانی وضعیت آنلاین</h4>
                <ul style="color: #555; line-height: 1.8; padding-right: 1.5rem; margin: 0;">
                    <li>با دریافت فراخوانی از دستگاه، وضعیت به <strong>"آنلاین"</strong> تغییر می‌کند</li>
                    <li>زمان آخرین آنلاین شدن (<code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">last_status_updated_at</code>) به‌روزرسانی می‌شود</li>
                    <li>هر فراخوانی در جدول <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">device_calls</code> ثبت می‌شود</li>
                </ul>
            </div>

            <div style="background: #ffebee; padding: 1.5rem; border-radius: 8px; border: 1px solid #ffcdd2;">
                <h4 style="color: #c62828; margin-bottom: 1rem; font-size: 1.1rem;">⏱️ تشخیص آفلاین بودن</h4>
                <ul style="color: #555; line-height: 1.8; padding-right: 1.5rem; margin: 0;">
                    <li>اگر دستگاه در <strong>10 دقیقه</strong> فراخوانی نکند، به‌صورت خودکار <strong>"آفلاین"</strong> می‌شود</li>
                    <li>این بررسی توسط یک Task زمان‌بندی شده انجام می‌شود</li>
                    <li>زمان آخرین آنلاین شدن <strong>تغییر نمی‌کند</strong> (نمایش آخرین زمان آنلاین بودن)</li>
                </ul>
            </div>
        </div>

        <div style="background: #e3f2fd; padding: 1.5rem; border-radius: 8px; margin-top: 2rem;">
            <h4 style="color: #1565c0; margin-bottom: 1rem; font-size: 1.1rem;">📊 جدول ثبت فراخوانی‌ها</h4>
            <p style="color: #555; line-height: 1.8; margin-bottom: 0.5rem;">
                هر فراخوانی دستگاه در جدول <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">device_calls</code> ثبت می‌شود و شامل موارد زیر است:
            </p>
            <ul style="color: #555; line-height: 1.8; padding-right: 1.5rem; margin: 0;">
                <li>شناسه دستگاه (device_id)</li>
                <li>route_id و location (از query parameters)</li>
                <li>تمام query parameters (برای بررسی و تحلیل)</li>
                <li>آدرس IP دستگاه</li>
                <li>زمان و تاریخ فراخوانی</li>
            </ul>
        </div>

        <div style="background: #f3e5f5; padding: 1.5rem; border-radius: 8px; margin-top: 1.5rem; border-right: 4px solid #9c27b0;">
            <h4 style="color: #6a1b9a; margin-bottom: 1rem; font-size: 1.1rem;">⚙️ API Endpoint</h4>
            <p style="color: #555; line-height: 1.8; margin-bottom: 0.5rem;">
                <strong>URL:</strong> <code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">/api/campaigns</code>
            </p>
            <p style="color: #555; line-height: 1.8; margin-bottom: 0.5rem;">
                <strong>Query Parameters:</strong>
            </p>
            <ul style="color: #555; line-height: 1.8; padding-right: 1.5rem; margin: 0;">
                <li><code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">route_id</code> (اجباری) - مسیر دستگاه</li>
                <li><code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">device_id</code> (اختیاری اما توصیه می‌شود) - شناسه یکتای دستگاه</li>
                <li><code style="background: white; padding: 0.2rem 0.4rem; border-radius: 3px;">location</code> (اختیاری) - موقعیت مکانی</li>
            </ul>
        </div>
    </div>
</div>
@endsection
