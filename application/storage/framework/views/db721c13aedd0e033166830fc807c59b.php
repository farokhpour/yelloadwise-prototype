<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1 style="text-align: center; margin-bottom: 2rem;">نمایش یکپارچه‌سازی نمایشگر تاکسی دیجیتال</h1>
    <p style="text-align: center; color: #666; margin-bottom: 3rem;">
        این صفحه نحوه یکپارچه‌سازی سیستم با دستگاه‌های نمایشگر تاکسی دیجیتال را نشان می‌دهد
    </p>

    <!-- System Architecture Diagram -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">معماری سیستم</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 2rem;">
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🚗</div>
                <h3>نمایشگر تاکسی دیجیتال</h3>
                <p style="color: #666; font-size: 0.9rem;">دستگاه بر اساس موقعیت ویدیو درخواست می‌کند</p>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🌐</div>
                <h3>مسیر فرانت‌اند</h3>
                <p style="color: #666; font-size: 0.9rem;">فراخوانی API با route_id را دریافت می‌کند</p>
            </div>
            <div style="text-align: center; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">⚙️</div>
                <h3>API بک‌اند</h3>
                <p style="color: #666; font-size: 0.9rem;">درخواست را پردازش می‌کند و کمپین را تطبیق می‌دهد</p>
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
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; margin-top: 2rem;">
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e3f2fd; border-radius: 8px;">
                <strong>1. دستگاه تاکسی</strong><br>
                <span style="font-size: 0.875rem; color: #666;">ارسال route_id و موقعیت</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e8f5e9; border-radius: 8px;">
                <strong>2. نقطه پایانی API</strong><br>
                <span style="font-size: 0.875rem; color: #666;">/api/video?route_id=X</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #fff3e0; border-radius: 8px;">
                <strong>3. تطبیق کمپین</strong><br>
                <span style="font-size: 0.875rem; color: #666;">یافتن کمپین در حال اجرا برای موقعیت</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #f3e5f5; border-radius: 8px;">
                <strong>4. دریافت ویدیو</strong><br>
                <span style="font-size: 0.875rem; color: #666;">بازیابی از MinIO</span>
            </div>
            <div style="font-size: 2rem; color: #0066cc;">→</div>
            <div style="flex: 1; min-width: 150px; text-align: center; padding: 1rem; background: #e0f2f1; border-radius: 8px;">
                <strong>5. نمایش</strong><br>
                <span style="font-size: 0.875rem; color: #666;">نمایش ویدیو روی سقف</span>
            </div>
        </div>
    </div>

    <!-- Running Campaigns -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">کمپین‌های در حال اجرا</h2>
        <?php if($campaigns->count() > 0): ?>
            <div style="display: grid; gap: 1.5rem; margin-top: 1.5rem;">
                <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="border: 2px solid #dee2e6; border-radius: 8px; padding: 1.5rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                            <div>
                                <strong>کمپین:</strong> <?php echo e($campaign->name); ?><br>
                                <strong>موقعیت‌ها:</strong> <?php echo e(implode('، ', $campaign->locations)); ?>

                            </div>
                            <div>
                                <strong>فایل ویدیو:</strong><br>
                                <code style="background: #f8f9fa; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.875rem;">
                                    <?php echo e($campaign->video_file); ?>

                                </code>
                            </div>
                            <div>
                                <strong>تست API:</strong><br>
                                <a href="/api/video?route_id=<?php echo e($campaign->locations[0] ?? 'route-1'); ?>" 
                                   target="_blank"
                                   style="display: inline-block; padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem; margin-top: 0.5rem;">
                                    تست فراخوانی API
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p style="color: #666; text-align: center; padding: 2rem;">هیچ کمپینی در حال حاضر در حال اجرا نیست.</p>
        <?php endif; ?>
    </div>

    <!-- MinIO Bucket Simulation -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 3rem;">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">سطل MinIO (ذخیره‌سازی ویدیو)</h2>
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; border-left: 4px solid #0066cc;">
            <p style="margin-bottom: 1rem;"><strong>مسیر سطل:</strong> <code>campaigns/videos/</code></p>
            <div style="background: white; padding: 1rem; border-radius: 4px; font-family: monospace; font-size: 0.875rem;">
                <div style="padding: 0.5rem; border-bottom: 1px solid #dee2e6;">
                    📁 campaigns/<br>
                    &nbsp;&nbsp;📁 videos/<br>
                    <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;🎬 <?php echo e(basename($campaign->video_file)); ?><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <p style="margin-top: 1rem; color: #666; font-size: 0.9rem;">
                <strong>یادداشت:</strong> در تولید، ویدیوها در ذخیره‌سازی شی MinIO ذخیره می‌شوند. 
                API بک‌اند URL ویدیوها را از MinIO بازیابی می‌کند و آن‌ها را به دستگاه‌های تاکسی دیجیتال ارائه می‌دهد.
            </p>
        </div>
    </div>

    <!-- API Documentation -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #0066cc; margin-bottom: 1.5rem;">مستندات نقطه پایانی API</h2>
        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <h3 style="margin-bottom: 1rem;">GET /api/video</h3>
            <p><strong>توضیحات:</strong> دستگاه‌های نمایشگر تاکسی دیجیتال این نقطه پایانی را برای دریافت محتوای ویدیو بر اساس موقعیت خود فراخوانی می‌کنند.</p>
            
            <div style="background: white; padding: 1rem; border-radius: 4px; margin: 1rem 0;">
                <strong>پارامترها:</strong>
                <ul style="margin: 0.5rem 0; padding-right: 1.5rem; direction: rtl;">
                    <li><code>route_id</code> (الزامی) - شناسه مسیر (مثال: route-1, route-2)</li>
                    <li><code>location</code> (اختیاری) - داده‌های موقعیت اضافی</li>
                </ul>
            </div>

            <div style="background: white; padding: 1rem; border-radius: 4px; margin: 1rem 0;">
                <strong>پاسخ (موفق):</strong>
                <pre style="background: #f8f9fa; padding: 1rem; border-radius: 4px; overflow-x: auto; font-size: 0.875rem; direction: ltr; text-align: left;">{
  "success": true,
  "campaign_id": 1,
  "campaign_name": "Summer Campaign",
  "video_url": "https://minio.example.com/bucket/video.mp4",
  "link": "https://example.com/landing",
  "utms": {
    "utm_source": "taxi_rooftop",
    "utm_medium": "display"
  }
}</pre>
            </div>

            <div style="background: white; padding: 1rem; border-radius: 4px; margin: 1rem 0;">
                <strong>پاسخ (بدون کمپین):</strong>
                <pre style="background: #f8f9fa; padding: 1rem; border-radius: 4px; overflow-x: auto; font-size: 0.875rem; direction: ltr; text-align: left;">{
  "success": false,
  "message": "No active campaigns for this location"
}</pre>
            </div>

            <div style="margin-top: 1.5rem;">
                <strong>مثال درخواست:</strong>
                <div style="background: white; padding: 1rem; border-radius: 4px; margin-top: 0.5rem;">
                    <code style="font-size: 0.875rem; direction: ltr; text-align: left; display: block;">
                        GET /api/video?route_id=route-1&location=downtown
                    </code>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 3rem; border-radius: 12px; color: white; margin-top: 3rem;">
        <h2 style="margin-bottom: 1.5rem;">نحوه کار سیستم</h2>
        <ol style="line-height: 2; padding-right: 1.5rem; direction: rtl;">
            <li><strong>ایجاد کمپین:</strong> کاربر کمپین را با ویدیو ایجاد می‌کند، موقعیت‌ها را انتخاب می‌کند و پارامترها را تنظیم می‌کند.</li>
            <li><strong>تایید ادمین:</strong> ادمین بررسی می‌کند، هزینه را تنظیم می‌کند و کمپین را تایید می‌کند.</li>
            <li><strong>پرداخت:</strong> کاربر برای کمپین پرداخت می‌کند.</li>
            <li><strong>فعال‌سازی کمپین:</strong> ادمین کمپین را شروع می‌کند و وضعیت را به "در حال اجرا" تغییر می‌دهد.</li>
            <li><strong>یکپارچه‌سازی دستگاه:</strong> دستگاه‌های نمایشگر تاکسی دیجیتال API را با route_id خود فراخوانی می‌کنند.</li>
            <li><strong>تطبیق ویدیو:</strong> بک‌اند کمپین‌های در حال اجرا را که با route_id مطابقت دارند پیدا می‌کند.</li>
            <li><strong>تحویل ویدیو:</strong> بک‌اند ویدیو را از MinIO بازیابی می‌کند و URL را به دستگاه برمی‌گرداند.</li>
            <li><strong>نمایش:</strong> دستگاه ویدیو را روی صفحه سقف نمایش می‌دهد.</li>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/integration/demo.blade.php ENDPATH**/ ?>