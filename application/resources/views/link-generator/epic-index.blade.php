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
            <div style="background: #fff9c4; padding: 2rem; border-radius: 8px; border-right: 4px solid #fbc02d;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">1️⃣</div>
                <h3 style="color: #f57f17; margin-bottom: 1rem; text-align: center;">به‌روزرسانی لینک در کمپین</h3>
                <p style="color: #555; line-height: 1.8; text-align: center;">
                    در صفحه جزئیات کمپین، ادمین می‌تواند لینک را به‌روزرسانی یا بازتولید کند. این قابلیت در تمام مراحل کمپین در دسترس است.
                </p>
            </div>

            <div style="background: #fce4ec; padding: 2rem; border-radius: 8px; border-right: 4px solid #e91e63;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">2️⃣</div>
                <h3 style="color: #c2185b; margin-bottom: 1rem; text-align: center;">لینک‌های مخفی</h3>
                <p style="color: #555; line-height: 1.8; text-align: center;">
                    در تب "لینک‌های مخفی" (فقط ادمین)، ادمین می‌تواند چندین لینک مخفی با همان ورودی‌ها ایجاد کند. سیستم لینک‌های ylad.ir/{token} تولید می‌کند.
                </p>
            </div>

            <div style="background: #e3f2fd; padding: 2rem; border-radius: 8px; border-right: 4px solid #2196f3;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">3️⃣</div>
                <h3 style="color: #1565c0; margin-bottom: 1rem; text-align: center;">گزارش بر اساس لینک‌ها</h3>
                <p style="color: #555; line-height: 1.8; text-align: center;">
                    در تب "گزارش" کمپین، در زیر نمودار کلیک‌ها، جدولی نمایش داده می‌شود که شامل لینک‌ها و تعداد کلیک‌های هر لینک است.
                </p>
            </div>

            <div style="background: #f3e5f5; padding: 2rem; border-radius: 8px; border-right: 4px solid #9c27b0;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem; text-align: center;">4️⃣</div>
                <h3 style="color: #6a1b9a; margin-bottom: 1rem; text-align: center;">گزارش لینک‌های مخفی</h3>
                <p style="color: #555; line-height: 1.8; text-align: center;">
                    با کلیک روی هر لینک مخفی در تب "لینک‌های مخفی"، نمودار کلیک‌های روزانه نمایش داده می‌شود (محور X: تاریخ، محور Y: تعداد کلیک‌ها).
                </p>
            </div>
        </div>
    </div>


    <!-- New Features Section -->
    <div style="background: #e3f2fd; border: 2px solid #2196f3; padding: 2rem; border-radius: 12px; margin-bottom: 3rem;">
        <h2 style="color: #1565c0; margin-bottom: 1.5rem; text-align: center;">🆕 ویژگی‌های جدید</h2>
        
        <div style="background: white; padding: 2rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <h3 style="color: #333; margin-bottom: 1rem;">1️⃣ به‌روزرسانی و بازتولید لینک در جزئیات کمپین</h3>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                در صفحه جزئیات کمپین (مانند کمپین‌های نمایشگر تاکسی دیجیتال و سایر کمپین‌ها)، ادمین می‌تواند:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>به‌روزرسانی لینک:</strong> ادمین می‌تواند لینک موجود را ویرایش کند</li>
                <li><strong>بازتولید لینک:</strong> ادمین می‌تواند یک لینک جدید با همان پارامترها یا پارامترهای جدید تولید کند</li>
                <li><strong>در هر مرحله:</strong> این قابلیت در تمام مراحل کمپین (در انتظار تایید، در حال اجرا، تکمیل شده) در دسترس است</li>
            </ul>
            <p style="color: #666; font-size: 0.9rem; margin-top: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 6px;">
                <strong>نکته:</strong> این ویژگی فقط در پنل ادمین و در صفحه جزئیات کمپین در دسترس است. 
                در این پروتوتایپ، فقط توضیحات این قابلیت نمایش داده می‌شود و فرم یا لیست کمپین‌ها پیاده‌سازی نشده است.
            </p>
        </div>

        <div style="background: white; padding: 2rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <h3 style="color: #333; margin-bottom: 1rem;">2️⃣ جدول لینک‌ها و کلیک‌ها در گزارش کمپین</h3>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                در تب "گزارش" کمپین، در زیر نمودار کلیک‌ها:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>بخش گزارش موجود:</strong> نمودار کلیک‌های روزانه (as_is report) در بالا نمایش داده می‌شود</li>
                <li><strong>جدول جدید:</strong> در زیر نمودار، جدولی نمایش داده می‌شود که شامل:</li>
                <ul style="padding-right: 1.5rem; margin-top: 0.5rem;">
                    <li>لینک‌های مرتبط با کمپین</li>
                    <li>تعداد کلیک‌های هر لینک</li>
                </ul>
            </ul>
            <p style="color: #666; font-size: 0.9rem; margin-top: 1rem; padding: 1rem; background: #f8f9fa; border-radius: 6px;">
                <strong>نکته:</strong> این جدول فقط در پروتوتایپ نمایش داده می‌شود و داده‌های واقعی در تولید از سیستم لینک‌ها استخراج خواهد شد.
            </p>
        </div>

        <div style="background: white; padding: 2rem; border-radius: 8px;">
            <h3 style="color: #333; margin-bottom: 1rem;">3️⃣ تب "لینک‌های مخفی" (فقط ادمین)</h3>
            <p style="color: #555; line-height: 2; margin-bottom: 1rem;">
                در صفحه جزئیات کمپین، یک تب جدید به نام "لینک‌های مخفی" اضافه شده است که:
            </p>
            <ul style="color: #555; line-height: 2.5; padding-right: 2rem; margin: 0;">
                <li><strong>فقط برای ادمین:</strong> این تب فقط در پنل ادمین نمایش داده می‌شود</li>
                <li><strong>مستقل از لینک اصلی:</strong> این لینک‌ها هیچ ارتباطی با لینک اصلی کمپین ندارند</li>
                <li><strong>ایجاد چندین لینک:</strong> ادمین می‌تواند چندین لینک مخفی با همان ورودی‌ها (landing و UTM) ایجاد کند</li>
                <li><strong>فرمت لینک:</strong> سیستم به صورت خودکار لینک‌های <code style="background: #f8f9fa; padding: 0.25rem 0.5rem; border-radius: 4px;">ylad.ir/{token}</code> تولید می‌کند</li>
                <li><strong>جدول لینک‌ها:</strong> در این تب، جدولی نمایش داده می‌شود شامل:</li>
                <ul style="padding-right: 1.5rem; margin-top: 0.5rem;">
                    <li>لینک ylad.ir</li>
                    <li>لینک فرود (landing)</li>
                    <li>تعداد کلیک‌ها</li>
                </ul>
                <li><strong>جزئیات لینک:</strong> با کلیک روی هر لینک، نمودار کلیک‌های روزانه نمایش داده می‌شود:</li>
                <ul style="padding-right: 1.5rem; margin-top: 0.5rem;">
                    <li>محور X: تاریخ</li>
                    <li>محور Y: تعداد کلیک‌ها</li>
                </ul>
            </ul>
        </div>
    </div>

    <!-- Hidden Links Tab Mockup -->
    <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 2rem; text-align: center;">🔒 نمونه تب "لینک‌های مخفی" (فقط ادمین)</h2>
        
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; border-right: 4px solid #6c757d;">
            <p style="color: #495057; line-height: 2; margin: 0;">
                <strong>📍 محل نمایش:</strong> این تب در صفحه جزئیات کمپین (در پنل ادمین) به عنوان تب چهارم نمایش داده می‌شود.
                این تب فقط برای ادمین قابل مشاهده است و کاربران عادی آن را نمی‌بینند.
            </p>
        </div>

        <!-- Mock Tab Structure -->
        <div style="background: white; border: 2px solid #dee2e6; border-radius: 8px; overflow: hidden;">
            <!-- Tab Header -->
            <div style="display: flex; border-bottom: 2px solid #dee2e6; background: #f8f9fa;">
                <div style="padding: 1rem 2rem; border-bottom: 3px solid transparent; font-weight: 600; color: #666;">نمای کلی</div>
                <div style="padding: 1rem 2rem; border-bottom: 3px solid transparent; font-weight: 600; color: #666;">فاکتور</div>
                <div style="padding: 1rem 2rem; border-bottom: 3px solid transparent; font-weight: 600; color: #666;">گزارش</div>
                <div style="padding: 1rem 2rem; border-bottom: 3px solid #007bff; font-weight: 600; color: #007bff; background: white;">🔒 لینک‌های مخفی</div>
            </div>

            <!-- Tab Content -->
            <div style="padding: 2rem;">
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: #333; margin-bottom: 1rem;">ایجاد لینک مخفی جدید</h3>
                    <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border: 1px dashed #dee2e6;">
                        <p style="color: #666; margin: 0; font-size: 0.9rem;">
                            <strong>فرم ایجاد لینک:</strong> ادمین می‌تواند لینک فرود (landing URL) و پارامترهای UTM را وارد کند.
                            سیستم به صورت خودکار لینک <code style="background: white; padding: 0.25rem 0.5rem; border-radius: 4px;">ylad.ir/{token}</code> تولید می‌کند.
                        </p>
                        <p style="color: #666; margin: 1rem 0 0 0; font-size: 0.9rem;">
                            <strong>نکته:</strong> ادمین می‌تواند چندین لینک مخفی با همان ورودی‌ها ایجاد کند. هر لینک token منحصر به فرد خود را دارد.
                        </p>
                        <div style="margin-top: 1.5rem; text-align: center;">
                            <button onclick="alert('یک لینک جدید در فرم در حال تولید است')" 
                                    style="padding: 0.75rem 2rem; background: #28a745; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s;"
                                    onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                                    onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
                                ➕ تولید لینک
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 style="color: #333; margin-bottom: 1rem;">جدول لینک‌های مخفی</h3>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                            <thead>
                                <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                    <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">لینک ylad.ir</th>
                                    <th style="padding: 1rem; text-align: right; font-weight: 600; color: #555;">لینک فرود</th>
                                    <th style="padding: 1rem; text-align: center; font-weight: 600; color: #555;">تعداد کلیک‌ها</th>
                                    <th style="padding: 1rem; text-align: center; font-weight: 600; color: #555;">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $mockHiddenLinks = [
                                        ['token' => 'abc12345', 'landing' => 'https://example.com/landing?utm_source=test', 'clicks' => 125],
                                        ['token' => 'xyz67890', 'landing' => 'https://example.com/landing?utm_source=social', 'clicks' => 89],
                                        ['token' => 'def45678', 'landing' => 'https://example.com/landing?utm_campaign=summer', 'clicks' => 203],
                                    ];
                                @endphp
                                @foreach($mockHiddenLinks as $hiddenLink)
                                    <tr style="border-bottom: 1px solid #dee2e6;">
                                        <td style="padding: 1rem;">
                                            <a href="http://ylad.ir/{{ $hiddenLink['token'] }}" target="_blank" 
                                               style="color: #28a745; text-decoration: none; font-family: monospace; font-size: 0.875rem; font-weight: 600;">
                                                ylad.ir/{{ $hiddenLink['token'] }}
                                            </a>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <a href="{{ $hiddenLink['landing'] }}" target="_blank" 
                                               style="color: #007bff; text-decoration: none; font-family: monospace; font-size: 0.875rem; word-break: break-all;">
                                                {{ Str::limit($hiddenLink['landing'], 50) }}
                                            </a>
                                        </td>
                                        <td style="padding: 1rem; text-align: center; font-weight: 600; color: #28a745;">
                                            {{ number_format($hiddenLink['clicks']) }}
                                        </td>
                                        <td style="padding: 1rem; text-align: center;">
                                            <button onclick="alert('نمایش نمودار کلیک‌های روزانه برای این لینک')" 
                                                    style="padding: 0.5rem 1rem; background: #17a2b8; color: white; border: none; border-radius: 4px; font-size: 0.875rem; cursor: pointer;">
                                                📊 جزئیات
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p style="text-align: center; color: #666; margin-top: 1rem; font-size: 0.875rem; padding: 1rem; background: #f8f9fa; border-radius: 6px;">
                        * با کلیک روی "جزئیات"، نمودار کلیک‌های روزانه نمایش داده می‌شود (محور X: تاریخ، محور Y: تعداد کلیک‌ها)
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

