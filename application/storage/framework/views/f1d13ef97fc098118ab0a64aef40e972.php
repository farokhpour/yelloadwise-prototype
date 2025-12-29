<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <h1>جدول مشتریان ادمین با فیلترهای پیشرفته</h1>
    
    <!-- Filters Section -->
    <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <form method="GET" action="<?php echo e(route('epics.filters.admin.customers')); ?>" id="filterForm" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr 1fr auto auto; gap: 1rem; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">نام مشتری</label>
                <input type="text" name="customer_name" id="customer_name" value="<?php echo e(request('customer_name')); ?>" 
                       placeholder="نام شرکت، نام، تلفن..."
                       style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;"
                       onkeypress="if(event.key === 'Enter') { event.preventDefault(); document.getElementById('filterForm').submit(); }">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">ایمیل</label>
                <input type="text" name="customer_email" id="customer_email" value="<?php echo e(request('customer_email')); ?>" 
                       placeholder="جستجو بر اساس ایمیل..."
                       style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;"
                       onkeypress="if(event.key === 'Enter') { event.preventDefault(); document.getElementById('filterForm').submit(); }">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">شناسه مشتری</label>
                <input type="text" name="customer_id" id="customer_id" value="<?php echo e(request('customer_id')); ?>" 
                       placeholder="کد ملی، کد ملی شرکت..."
                       style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;"
                       onkeypress="if(event.key === 'Enter') { event.preventDefault(); document.getElementById('filterForm').submit(); }">
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">نوع مشتری</label>
                <select name="customer_type" id="customer_type" style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    <option value="">همه انواع</option>
                    <option value="حقیقی" <?php echo e(request('customer_type') === 'حقیقی' ? 'selected' : ''); ?>>حقیقی</option>
                    <option value="حقوقی" <?php echo e(request('customer_type') === 'حقوقی' ? 'selected' : ''); ?>>حقوقی</option>
                </select>
            </div>
            
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">وضعیت مشتری</label>
                <select name="customer_status" id="customer_status" style="width: 100%; padding: 0.75rem; border: 2px solid #ddd; border-radius: 6px;">
                    <option value="">همه وضعیت‌ها</option>
                    <option value="در انتظار تایید" <?php echo e(request('customer_status') === 'در انتظار تایید' ? 'selected' : ''); ?>>در انتظار تایید</option>
                    <option value="تایید شده" <?php echo e(request('customer_status') === 'تایید شده' ? 'selected' : ''); ?>>تایید شده</option>
                    <option value="در انتظار تکمیل اطلاعات" <?php echo e(request('customer_status') === 'در انتظار تکمیل اطلاعات' ? 'selected' : ''); ?>>در انتظار تکمیل اطلاعات</option>
                </select>
            </div>
            
            <div>
                <button type="submit" style="padding: 0.75rem 1.5rem; background: #007bff; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; white-space: nowrap;">
                    🔍 جستجو
                </button>
            </div>
            
            <div>
                <a href="<?php echo e(route('epics.filters.admin.customers')); ?>" 
                   title="حذف فیلترها"
                   style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-size: 1.2rem; transition: all 0.3s;"
                   onmouseover="this.style.background='#5a6268'; this.style.transform='scale(1.1)';"
                   onmouseout="this.style.background='#6c757d'; this.style.transform='scale(1)';">
                    ✕
                </a>
            </div>
        </form>
    </div>

    <!-- Customers Table -->
    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa;">
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">شناسه</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">نام مشتری</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">کد ملی/شناسه</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">نوع</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">وضعیت</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">ایمیل</th>
                    <th style="padding: 1rem; text-align: right; border-bottom: 2px solid #dee2e6;">تلفن</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="border-bottom: 1px solid #dee2e6; transition: background 0.2s;"
                        onmouseover="this.style.background='#f8f9fa';"
                        onmouseout="this.style.background='white';">
                        <td style="padding: 1rem;"><?php echo e($customer['id'] ?? '-'); ?></td>
                        <td style="padding: 1rem; font-weight: 500;">
                            <?php if($customer['type'] === 'حقوقی'): ?>
                                <?php echo e($customer['brand_name'] ?? '-'); ?>

                            <?php else: ?>
                                <?php echo e(($customer['first_name'] ?? '') . ' ' . ($customer['last_name'] ?? '')); ?>

                            <?php endif; ?>
                        </td>
                        <td style="padding: 1rem;">
                            <?php if($customer['type'] === 'حقوقی'): ?>
                                <?php echo e($customer['company_national_id'] ?? '-'); ?>

                            <?php else: ?>
                                <?php echo e($customer['national_id'] ?? '-'); ?>

                            <?php endif; ?>
                        </td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: <?php echo e($customer['type'] === 'حقوقی' ? '#007bff' : '#28a745'); ?>; color: white; font-size: 0.875rem; font-weight: 600;">
                                <?php echo e($customer['type'] ?? '-'); ?>

                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.25rem 0.75rem; border-radius: 4px; background: 
                                <?php if($customer['status'] === 'تایید شده'): ?> #28a745
                                <?php elseif($customer['status'] === 'در انتظار تایید'): ?> #ffc107
                                <?php elseif($customer['status'] === 'در انتظار تکمیل اطلاعات'): ?> #17a2b8
                                <?php else: ?> #6c757d
                                <?php endif; ?>; color: white; font-size: 0.875rem; font-weight: 600;">
                                <?php echo e($customer['status'] ?? '-'); ?>

                            </span>
                        </td>
                        <td style="padding: 1rem;"><?php echo e($customer['email'] ?? '-'); ?></td>
                        <td style="padding: 1rem;"><?php echo e($customer['phone'] ?? '-'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" style="padding: 3rem; text-align: center; color: #666;">
                            <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                            <p style="font-size: 1.1rem;">هیچ مشتری یافت نشد</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/filters/admin/customers.blade.php ENDPATH**/ ?>