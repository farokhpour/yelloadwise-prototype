<?php $__env->startSection('content'); ?>
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <!-- Header -->
    <div style="margin-bottom: 2rem;">
        <a href="<?php echo e(route('home')); ?>" style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none;">
            ← بازگشت به اپیک‌ها
        </a>
        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
            <span style="font-size: 3rem;"><?php echo e($epic['icon']); ?></span>
            <h1 style="margin: 0; color: #333;"><?php echo e($epic['name']); ?></h1>
        </div>
    </div>

    <!-- How It Works Section -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
        <h2 style="color: #007bff; margin-bottom: 1rem; border-bottom: 2px solid #007bff; padding-bottom: 0.5rem;">نحوه کار</h2>
        <ol style="color: #555; line-height: 2; padding-right: 1.5rem; direction: rtl;">
            <?php $__currentLoopData = $epic['how_it_works']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li style="margin-bottom: 0.5rem;"><?php echo e($step); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
    </div>


    <!-- Pages Section -->
    <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #007bff; margin-bottom: 1.5rem; border-bottom: 2px solid #007bff; padding-bottom: 0.5rem;">صفحات موجود</h2>

        <!-- User Pages -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #28a745; margin-bottom: 1rem; font-size: 1.3rem;">👤 صفحات کاربر</h3>
            <div style="display: grid; gap: 1rem;">
                <?php $__currentLoopData = $epic['pages']['user']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="border: 1px solid #dee2e6; border-radius: 8px; padding: 1.5rem; background: #f8f9fa; transition: all 0.3s;" 
                         onmouseover="this.style.borderColor='#28a745'; this.style.boxShadow='0 2px 8px rgba(40,167,69,0.2)';"
                         onmouseout="this.style.borderColor='#dee2e6'; this.style.boxShadow='none';">
                        <h4 style="margin: 0 0 0.5rem 0; color: #333;"><?php echo e($page['name']); ?></h4>
                        <p style="margin: 0 0 0.75rem 0; color: #666; font-size: 0.95rem; line-height: 1.6;"><?php echo e($page['description']); ?></p>
                        <p style="margin: 0 0 1rem 0; padding: 0.5rem 1rem; background: #e9ecef; border-radius: 4px; font-size: 0.875rem; color: #495057;">
                            <strong>نمای کلی:</strong> <?php echo e($page['overview']); ?>

                        </p>
                        <div style="display: flex; align-items: center; gap: 1rem; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                            <a href="<?php echo e($page['url']); ?>" 
                               target="_blank"
                               style="display: inline-block; padding: 0.75rem 1.5rem; background: #28a745; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
                               onmouseover="this.style.background='#218838'; this.style.transform='translateY(-2px)';"
                               onmouseout="this.style.background='#28a745'; this.style.transform='translateY(0)';">
                                🚀 رفتن به صفحه
                            </a>
                            <?php if(isset($page['note'])): ?>
                                <span style="font-size: 0.875rem; color: #ffc107;">⚠️ <?php echo e($page['note']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Admin Pages -->
        <div style="margin-bottom: 2rem;">
            <h3 style="color: #dc3545; margin-bottom: 1rem; font-size: 1.3rem;">🔧 صفحات ادمین</h3>
            <div style="display: grid; gap: 1rem;">
                <?php $__currentLoopData = $epic['pages']['admin']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="border: 1px solid #dee2e6; border-radius: 8px; padding: 1.5rem; background: #f8f9fa; transition: all 0.3s;" 
                         onmouseover="this.style.borderColor='#dc3545'; this.style.boxShadow='0 2px 8px rgba(220,53,69,0.2)';"
                         onmouseout="this.style.borderColor='#dee2e6'; this.style.boxShadow='none';">
                        <h4 style="margin: 0 0 0.5rem 0; color: #333;"><?php echo e($page['name']); ?></h4>
                        <p style="margin: 0 0 0.75rem 0; color: #666; font-size: 0.95rem; line-height: 1.6;"><?php echo e($page['description']); ?></p>
                        <p style="margin: 0 0 1rem 0; padding: 0.5rem 1rem; background: #e9ecef; border-radius: 4px; font-size: 0.875rem; color: #495057;">
                            <strong>نمای کلی:</strong> <?php echo e($page['overview']); ?>

                        </p>
                        <div style="display: flex; align-items: center; gap: 1rem; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                            <a href="<?php echo e($page['url']); ?>" 
                               target="_blank"
                               style="display: inline-block; padding: 0.75rem 1.5rem; background: #dc3545; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
                               onmouseover="this.style.background='#c82333'; this.style.transform='translateY(-2px)';"
                               onmouseout="this.style.background='#dc3545'; this.style.transform='translateY(0)';">
                                🚀 رفتن به صفحه
                            </a>
                            <?php if(isset($page['note'])): ?>
                                <span style="font-size: 0.875rem; color: #ffc107;">⚠️ <?php echo e($page['note']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Integration Pages -->
        <?php if(isset($epic['pages']['integration']) && count($epic['pages']['integration']) > 0): ?>
            <div>
                <h3 style="color: #6f42c1; margin-bottom: 1rem; font-size: 1.3rem;">🔌 صفحات یکپارچه‌سازی</h3>
                <div style="display: grid; gap: 1rem;">
                    <?php $__currentLoopData = $epic['pages']['integration']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div style="border: 1px solid #dee2e6; border-radius: 8px; padding: 1.5rem; background: #f8f9fa; transition: all 0.3s;" 
                             onmouseover="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 2px 8px rgba(111,66,193,0.2)';"
                             onmouseout="this.style.borderColor='#dee2e6'; this.style.boxShadow='none';">
                            <h4 style="margin: 0 0 0.5rem 0; color: #333;"><?php echo e($page['name']); ?></h4>
                            <p style="margin: 0 0 0.75rem 0; color: #666; font-size: 0.95rem; line-height: 1.6;"><?php echo e($page['description']); ?></p>
                            <p style="margin: 0 0 1rem 0; padding: 0.5rem 1rem; background: #e9ecef; border-radius: 4px; font-size: 0.875rem; color: #495057;">
                                <strong>نمای کلی:</strong> <?php echo e($page['overview']); ?>

                            </p>
                            <div style="display: flex; align-items: center; gap: 1rem; padding-top: 1rem; border-top: 1px solid #dee2e6;">
                                <a href="<?php echo e($page['url']); ?>" 
                                   target="_blank"
                                   style="display: inline-block; padding: 0.75rem 1.5rem; background: #6f42c1; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: all 0.3s;"
                                   onmouseover="this.style.background='#5a32a3'; this.style.transform='translateY(-2px)';"
                                   onmouseout="this.style.background='#6f42c1'; this.style.transform='translateY(0)';">
                                    🚀 رفتن به صفحه
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/epics/show.blade.php ENDPATH**/ ?>