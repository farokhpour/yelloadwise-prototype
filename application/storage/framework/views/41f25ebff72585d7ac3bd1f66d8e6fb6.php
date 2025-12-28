<?php $__env->startSection('content'); ?>
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; color: #0066cc; margin-bottom: 1rem;">سیستم پروتوتایپ</h1>
        <p style="font-size: 1.2rem; color: #666;">سازماندهی ویژگی‌ها بر اساس اپیک</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
        <?php $__currentLoopData = $epics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $epic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('epics.show', $epic['id'])); ?>" 
               style="text-decoration: none; display: block;">
                <div style="background: white; border: 2px solid #dee2e6; border-radius: 12px; padding: 2rem; transition: all 0.3s; height: 100%; display: flex; flex-direction: column;"
                     onmouseover="this.style.borderColor='#007bff'; this.style.boxShadow='0 4px 12px rgba(0,123,255,0.2)';"
                     onmouseout="this.style.borderColor='#dee2e6'; this.style.boxShadow='none';">
                    <div style="font-size: 4rem; margin-bottom: 1rem; text-align: center;">
                        <?php echo e($epic['icon']); ?>

                    </div>
                    <h2 style="color: #333; margin-bottom: 1rem; text-align: center;">
                        <?php echo e($epic['name']); ?>

                    </h2>
                    <p style="color: #666; margin-bottom: 1.5rem; flex-grow: 1;">
                        <?php echo e($epic['description']); ?>

                    </p>
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                        <span style="padding: 0.25rem 0.75rem; background: #28a745; color: white; border-radius: 4px; font-size: 0.875rem; font-weight: 600;">
                            <?php echo e($epic['status'] === 'active' ? 'نمایش' : ucfirst($epic['status'])); ?>

                        </span>
                        <span style="color: #666; font-size: 0.875rem;">
                            <?php echo e($epic['routes_count']); ?> مسیر
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if(count($epics) === 0): ?>
        <div style="text-align: center; padding: 3rem; background: #f8f9fa; border-radius: 8px;">
            <p style="color: #666; font-size: 1.1rem;">هنوز اپیکی در دسترس نیست.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/home.blade.php ENDPATH**/ ?>