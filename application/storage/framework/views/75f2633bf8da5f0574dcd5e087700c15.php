<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1>مدیریت کمپین - ادمین</h1>
    
    <div style="margin-bottom: 2rem;">
        <a href="<?php echo e(route('campaigns.create')); ?>" style="display: inline-block; padding: 0.75rem 1.5rem; background: #007bff; color: white; text-decoration: none; border-radius: 6px;">
            ایجاد کمپین جدید
        </a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">شناسه</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">نام</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">وضعیت</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">روزها</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">ماشین‌ها</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">هزینه/روز</th>
                <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 1rem;"><?php echo e($campaign->id); ?></td>
                    <td style="padding: 1rem;"><?php echo e($campaign->name); ?></td>
                    <td style="padding: 1rem;">
                        <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: 
                            <?php if($campaign->status === 'draft'): ?> #6c757d
                            <?php elseif($campaign->status === 'waiting_admin_approval'): ?> #ffc107
                            <?php elseif($campaign->status === 'waiting_payment'): ?> #17a2b8
                            <?php elseif($campaign->status === 'waiting_to_run'): ?> #007bff
                            <?php elseif($campaign->status === 'running'): ?> #28a745
                            <?php else: ?> #dc3545
                            <?php endif; ?>; color: white; font-size: 0.875rem;">
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
                    <td style="padding: 1rem;" class="ltr">$<?php echo e(number_format($campaign->cost_per_day ?? 0, 2)); ?></td>
                    <td style="padding: 1rem;">
                        <a href="<?php echo e(route('admin.campaigns.edit', $campaign->id)); ?>" 
                           style="padding: 0.5rem 1rem; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-size: 0.875rem;">
                            ویرایش
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" style="padding: 2rem; text-align: center; color: #666;">
                        کمپینی یافت نشد.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/campaigns/index.blade.php ENDPATH**/ ?>