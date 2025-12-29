<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>فهرست کمپین‌های من</h1>
        <a href="<?php echo e(route('epic.digital-taxi-rooftop.campaign.create')); ?>" 
           style="display: inline-block; padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
            ➕ ایجاد کمپین جدید
        </a>
    </div>

    <?php if(session('success')): ?>
        <div style="background: #d4edda; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; color: #155724; border-left: 4px solid #28a745;">
            <strong>✓ موفق!</strong> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div style="background: #f8d7da; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; color: #721c24;">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa;">
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">شناسه</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">نام کمپین</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">وضعیت</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">روزها</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">ماشین‌ها</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">تاریخ ایجاد</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                        onmouseover="this.style.background='#f8f9fa';"
                        onmouseout="this.style.background='white';">
                        <td style="padding: 1rem;"><?php echo e($campaign->id); ?></td>
                        <td style="padding: 1rem; font-weight: 500;"><?php echo e($campaign->name); ?></td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: 
                                <?php if($campaign->status === 'draft'): ?> #6c757d
                                <?php elseif($campaign->status === 'waiting_admin_approval'): ?> #ffc107
                                <?php elseif($campaign->status === 'waiting_payment'): ?> #17a2b8
                                <?php elseif($campaign->status === 'waiting_to_run'): ?> #007bff
                                <?php elseif($campaign->status === 'running'): ?> #28a745
                                <?php else: ?> #dc3545
                                <?php endif; ?>; color: white; font-size: 0.875rem; font-weight: 600;">
                                <?php if($campaign->status === 'draft'): ?> پیش‌نویس
                                <?php elseif($campaign->status === 'waiting_admin_approval'): ?> در انتظار تایید ادمین
                                <?php elseif($campaign->status === 'waiting_payment'): ?> در انتظار پرداخت
                                <?php elseif($campaign->status === 'waiting_to_run'): ?> آماده اجرا
                                <?php elseif($campaign->status === 'running'): ?> در حال اجرا
                                <?php elseif($campaign->status === 'completed'): ?> تکمیل شده
                                <?php else: ?> لغو شده
                                <?php endif; ?>
                            </span>
                        </td>
                        <td style="padding: 1rem;"><?php echo e($campaign->days); ?></td>
                        <td style="padding: 1rem;"><?php echo e($campaign->cars); ?></td>
                        <td style="padding: 1rem;"><?php echo e($campaign->created_at->format('Y-m-d H:i')); ?></td>
                        <td style="padding: 1rem;">
                            <a href="<?php echo e(route('epic.digital-taxi-rooftop.campaign.show', $campaign->id)); ?>" 
                               style="display: inline-block; padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem; font-weight: 500; transition: all 0.3s;"
                               onmouseover="this.style.background='#0056b3'; this.style.transform='translateY(-2px)';"
                               onmouseout="this.style.background='#007bff'; this.style.transform='translateY(0)';">
                                👁️ مشاهده
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" style="padding: 3rem; text-align: center; color: #666;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                            <p style="font-size: 1.1rem; margin-bottom: 1rem;">هیچ کمپینی یافت نشد</p>
                            <a href="<?php echo e(route('epic.digital-taxi-rooftop.campaign.create')); ?>" 
                               style="display: inline-block; padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px; font-weight: 600;">
                                ایجاد اولین کمپین
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($campaigns->count() > 0): ?>
        <div style="margin-top: 2rem; padding: 1rem; background: #e7f3ff; border-radius: 8px; border-right: 4px solid #007bff;">
            <p style="margin: 0; color: #004085;">
                <strong>💡 نکته:</strong> برای ایجاد کمپین جدید، روی دکمه "ایجاد کمپین جدید" در بالا کلیک کنید.
            </p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/campaigns/index.blade.php ENDPATH**/ ?>