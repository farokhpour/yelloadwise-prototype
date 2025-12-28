<?php $__env->startSection('content'); ?>
<div style="max-width: 900px; margin: 0 auto; padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="<?php echo e(route('campaigns.show', $campaign->id)); ?>" 
           style="display: inline-block; margin-bottom: 1rem; color: #007bff; text-decoration: none; font-weight: 600;">
            ← Back to Campaign
        </a>
        <h1 style="margin: 0; color: #333;">Invoice</h1>
        <p style="margin: 0.5rem 0 0 0; color: #666;">Campaign: <?php echo e($campaign->name); ?></p>
    </div>

    <?php echo $__env->make('campaigns.partials.invoice', ['campaign' => $campaign], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/invoices/show.blade.php ENDPATH**/ ?>