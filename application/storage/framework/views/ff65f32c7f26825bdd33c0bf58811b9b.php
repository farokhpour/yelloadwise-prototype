<?php $__env->startSection('content'); ?>
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <h1>Vue.js Wizard Test</h1>
    <p>This page demonstrates selective Vue.js usage for interactive prototypes.</p>
    
    <div id="wizard-app">
        <!-- Vue will replace this content -->
        <div>Loading wizard...</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('vue-components'); ?>
<?php echo app('Illuminate\Foundation\Vite')('resources/js/wizard.js'); ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/wizard.blade.php ENDPATH**/ ?>