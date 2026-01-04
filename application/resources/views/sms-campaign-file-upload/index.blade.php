@extends('layouts.app')

@section('content')
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <div style="font-size: 5rem; margin-bottom: 1rem;">📄</div>
        <h1 style="color: #333; margin-bottom: 0.5rem; font-size: 2.5rem;">کمپین پیامک با آپلود فایل</h1>
        <p style="color: #666; font-size: 1.2rem; max-width: 800px; margin: 0 auto;">
            سیستم ایجاد کمپین پیامک با امکان آپلود فایل لیست شماره‌ها
        </p>
    </div>

    <!-- What is happening here -->
    <div style="background: #e3f2fd; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; border-right: 4px solid #2196f3;">
        <h3 style="color: #1565c0; margin-bottom: 1rem; font-size: 1.3rem;">📖 چه اتفاقی اینجا می‌افتد؟</h3>
        <p style="color: #1565c0; line-height: 2; font-size: 1.05rem; margin: 0;">
            این صفحه الزامات و جزئیات مربوط به سیستم کمپین پیامک با آپلود فایل را برای توسعه‌دهندگان بک‌اند توضیح می‌دهد. 
            این یک صفحه مستندسازی است و شامل هیچ ویژگی قابل تعاملی نیست. هدف این صفحه ارائه راهنمای کامل برای پیاده‌سازی 
            این ویژگی در سیستم است.
        </p>
    </div>

    <!-- Why this design exists -->
    <div style="background: #fff3e0; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; border-right: 4px solid #ff9800;">
        <h3 style="color: #e65100; margin-bottom: 1rem; font-size: 1.3rem;">🎯 چرا این طراحی وجود دارد؟</h3>
        <p style="color: #e65100; line-height: 2; font-size: 1.05rem; margin: 0;">
            این ویژگی برای کاربرانی طراحی شده است که لیست آماده شماره‌های موبایل را دارند و می‌خواهند به جای استفاده از 
            فیلترهای پنل، مستقیماً فایل خود را آپلود کنند. این روش برای کمپین‌های هدفمند با لیست مشخص از شماره‌ها مناسب است.
        </p>
    </div>

    <!-- User Journey -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">👤 مسیر کاربر</h2>
        
        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">مرحله 1: انتخاب روش ایجاد کمپین</h4>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                کاربر می‌تواند بین دو روش انتخاب کند:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>استفاده از فیلترهای پنل:</strong> روش سنتی که کاربر از فیلترهای موجود در پنل استفاده می‌کند</li>
                <li><strong>آپلود فایل:</strong> کاربر فایل لیست شماره‌ها را آپلود می‌کند</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">مرحله 2: آپلود فایل (اگر انتخاب شده باشد)</h4>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                اگر کاربر آپلود فایل را انتخاب کند:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>تمام فیلترهای پنل غیرفعال می‌شوند:</strong> هیچ فیلتری نمایش داده نمی‌شود</li>
                <li><strong>فقط گزینه آپلود فایل نمایش داده می‌شود:</strong> کاربر می‌تواند فایل را انتخاب و آپلود کند</li>
                <li><strong>فرمت فایل:</strong> باید فرمت‌های استاندارد (CSV, TXT, Excel) را پشتیبانی کند</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">مرحله 3: پردازش فایل و نمایش نتایج</h4>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                پس از آپلود فایل:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>فراخوانی API:</strong> کلاینت یک endpoint را فراخوانی می‌کند</li>
                <li><strong>فریز کردن UI:</strong> رابط کاربری در حالت loading قرار می‌گیرد (نمایش spinner یا loading indicator)</li>
                <li><strong>پردازش در بک‌اند:</strong> سیستم فایل را پردازش می‌کند و شماره‌ها را اعتبارسنجی می‌کند</li>
                <li><strong>زمان پردازش:</strong> ممکن است چند ثانیه تا چند دقیقه طول بکشد (بسته به حجم فایل)</li>
                <li><strong>نمایش نتایج:</strong> پس از پردازش، تعداد شماره‌های معتبر برای ارسال پیامک نمایش داده می‌شود</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">مرحله 4: ادامه فرآیند ایجاد کمپین</h4>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                پس از نمایش تعداد شماره‌های معتبر:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>بخش جانبی:</strong> در بخش کناری (sidebar) یک فیلد نمایش داده می‌شود</li>
                <li><strong>متن فیلد:</strong> "چند پیامک می‌خواهید ارسال کنید؟"</li>
                <li><strong>نوع فیلد:</strong> یک input غیرفعال (disabled) که تعداد شماره‌های معتبر سیستم را نمایش می‌دهد</li>
                <li><strong>سایر بخش‌ها:</strong> بقیه بخش‌های فرم کمپین (متن پیام، زمان ارسال، و غیره) بدون تغییر باقی می‌مانند</li>
            </ul>
        </div>

        <div style="background: #e8f5e9; padding: 2rem; border-radius: 8px; border-right: 4px solid #28a745;">
            <h4 style="color: #2e7d32; margin-bottom: 1rem;">✅ نکات مهم:</h4>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>کاربر نمی‌تواند تعداد را تغییر دهد - این مقدار از تعداد شماره‌های معتبر در فایل محاسبه می‌شود</li>
                <li>سیستم باید شماره‌های تکراری را حذف کند</li>
                <li>سیستم باید شماره‌های نامعتبر را رد کند</li>
                <li>فرمت شماره‌ها باید استاندارد باشد (مثلاً 09xxxxxxxxx)</li>
            </ul>
        </div>
    </div>

    <!-- Admin Journey -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #dc3545; margin-bottom: 2rem; border-bottom: 2px solid #dc3545; padding-bottom: 0.5rem;">🔧 مسیر ادمین</h2>
        
        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">مرحله 1: مشاهده کمپین (بخش ویرایش فیلترها)</h4>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                در صفحه ویرایش کمپین، در بخش اول (بخشی که ادمین می‌تواند فیلترها را تغییر دهد):
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>این بخش کاملاً حذف می‌شود:</strong> هیچ فیلتری نمایش داده نمی‌شود</li>
                <li><strong>فقط نمایش اطلاعات:</strong> فقط تعداد پیامک‌ها (غیرقابل ویرایش) نمایش داده می‌شود</li>
                <li><strong>نشانگر روش:</strong> باید مشخص شود که این کمپین از طریق آپلود فایل ایجاد شده است</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">مرحله 2: ادامه فرآیند تایید و مدیریت</h4>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                بقیه مراحل فرآیند کمپین بدون تغییر باقی می‌مانند:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>تایید کمپین</li>
                <li>تنظیم قیمت</li>
                <li>فعال‌سازی کمپین</li>
                <li>و سایر مراحل معمول</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">مرحله 3: نمایش جزئیات کمپین</h4>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                در صفحه نمایش جزئیات کمپین:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>به جای فیلترها:</strong> به جای نمایش فیلترهای استفاده شده، نمایش داده می‌شود:</li>
                <ul style="padding-right: 1.5rem; margin-top: 0.5rem;">
                    <li>تعداد پیامک‌ها (غیرقابل ویرایش)</li>
                    <li>نشانگر اینکه این کمپین از طریق آپلود فایل ایجاد شده است</li>
                </ul>
                <li><strong>سایر اطلاعات:</strong> بقیه اطلاعات کمپین (متن پیام، زمان ارسال، وضعیت، و غیره) بدون تغییر نمایش داده می‌شوند</li>
            </ul>
        </div>

        <div style="background: #ffebee; padding: 2rem; border-radius: 8px; border-right: 4px solid #f44336;">
            <h4 style="color: #c62828; margin-bottom: 1rem;">⚠️ محدودیت‌ها:</h4>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>ادمین نمی‌تواند فیلترها را برای کمپین‌های آپلود شده تغییر دهد</li>
                <li>ادمین نمی‌تواند تعداد پیامک‌ها را تغییر دهد</li>
                <li>فایل آپلود شده باید در سیستم ذخیره شود برای مراجعه بعدی</li>
            </ul>
        </div>
    </div>

    <!-- Technical Requirements -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">⚙️ الزامات فنی</h2>
        
        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">1. API Endpoint برای پردازش فایل</h4>
            <div style="background: #282c34; color: #abb2bf; padding: 1.5rem; border-radius: 6px; font-family: 'Courier New', monospace; overflow-x: auto; margin-top: 1rem;">
                <div style="margin-bottom: 0.5rem; color: #61afef;">POST</div>
                <div style="color: #98c379;">/api/v1/sms-campaigns/validate-file</div>
            </div>
            <div style="margin-top: 1rem;">
                <p style="color: #555; line-height: 2;"><strong>Request:</strong> multipart/form-data با فایل</p>
                <p style="color: #555; line-height: 2;"><strong>Response:</strong> JSON با تعداد شماره‌های معتبر</p>
            </div>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">2. اعتبارسنجی شماره‌ها</h4>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>بررسی فرمت شماره (مثلاً 09xxxxxxxxx برای ایران)</li>
                <li>حذف شماره‌های تکراری</li>
                <li>بررسی شماره‌های مسدود شده یا غیرفعال</li>
                <li>بررسی محدودیت‌های قانونی (مثلاً عدم ارسال به شماره‌های ثبت‌نام نشده)</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">3. ذخیره‌سازی فایل</h4>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>فایل باید در storage ذخیره شود</li>
                <li>مسیر فایل باید در دیتابیس ثبت شود</li>
                <li>فایل باید با کمپین مرتبط شود</li>
                <li>امنیت فایل باید رعایت شود (دسترسی محدود)</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">4. ساختار دیتابیس</h4>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                جدول کمپین‌ها باید شامل فیلدهای زیر باشد:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>campaign_type:</strong> 'filter' یا 'file_upload'</li>
                <li><strong>file_path:</strong> مسیر فایل آپلود شده (nullable)</li>
                <li><strong>valid_numbers_count:</strong> تعداد شماره‌های معتبر (nullable)</li>
                <li><strong>uploaded_at:</strong> زمان آپلود فایل (nullable)</li>
            </ul>
        </div>
    </div>

    <!-- UI/UX Requirements -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; border-bottom: 2px solid #0066cc; padding-bottom: 0.5rem;">🎨 الزامات UI/UX</h2>
        
        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">1. انتخاب روش</h4>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>استفاده از radio buttons یا toggle switch برای انتخاب بین فیلتر و آپلود فایل</li>
                <li>انتخاب باید واضح و قابل فهم باشد</li>
                <li>توضیحات کوتاه برای هر روش</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">2. حالت Loading</h4>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>نمایش spinner یا progress indicator هنگام پردازش فایل</li>
                <li>غیرفعال کردن تمام دکمه‌ها و فیلدها در حالت loading</li>
                <li>نمایش پیام "در حال پردازش فایل..."</li>
                <li>امکان لغو عملیات (اختیاری)</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
            <h4 style="color: #333; margin-bottom: 1rem;">3. نمایش نتایج</h4>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>نمایش تعداد شماره‌های معتبر به صورت واضح و برجسته</li>
                <li>نمایش تعداد شماره‌های نامعتبر (اختیاری)</li>
                <li>امکان دانلود گزارش شماره‌های نامعتبر (اختیاری)</li>
                <li>فیلد تعداد پیامک باید disabled باشد و مقدار از تعداد معتبر محاسبه شود</li>
            </ul>
        </div>

        <div style="background: #f8f9fa; padding: 2rem; border-radius: 8px;">
            <h4 style="color: #333; margin-bottom: 1rem;">4. نمایش در پنل ادمین</h4>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li>نشانگر واضح که کمپین از طریق آپلود فایل ایجاد شده است</li>
                <li>نمایش تعداد پیامک‌ها به صورت read-only</li>
                <li>حذف کامل بخش فیلترها</li>
                <li>امکان دانلود فایل اصلی (اختیاری)</li>
            </ul>
        </div>
    </div>

    <!-- Error Handling -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #dc3545; margin-bottom: 2rem; border-bottom: 2px solid #dc3545; padding-bottom: 0.5rem;">⚠️ مدیریت خطا</h2>
        
        <div style="display: grid; gap: 1.5rem;">
            <div style="background: #ffebee; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #f44336;">
                <h4 style="color: #c62828; margin-bottom: 0.75rem;">خطاهای فایل</h4>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li>فایل خالی یا بدون شماره</li>
                    <li>فرمت فایل نامعتبر</li>
                    <li>حجم فایل بیش از حد مجاز</li>
                    <li>فایل آسیب‌دیده یا قابل خواندن نیست</li>
                </ul>
            </div>

            <div style="background: #ffebee; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #f44336;">
                <h4 style="color: #c62828; margin-bottom: 0.75rem;">خطاهای پردازش</h4>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li>Timeout در پردازش فایل‌های بزرگ</li>
                    <li>خطا در خواندن فایل</li>
                    <li>خطا در اعتبارسنجی شماره‌ها</li>
                    <li>عدم وجود شماره معتبر در فایل</li>
                </ul>
            </div>

            <div style="background: #fff3cd; padding: 1.5rem; border-radius: 8px; border-right: 4px solid #ffc107;">
                <h4 style="color: #856404; margin-bottom: 0.75rem;">پیام‌های هشدار</h4>
                <ul style="color: #555; line-height: 2; padding-right: 1.5rem; margin: 0;">
                    <li>اگر تعداد شماره‌های معتبر کمتر از حد انتظار باشد، به کاربر هشدار داده شود</li>
                    <li>اگر تعداد شماره‌های تکراری زیاد باشد، اطلاع داده شود</li>
                    <li>اگر تعداد شماره‌های نامعتبر زیاد باشد، گزارش داده شود</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

