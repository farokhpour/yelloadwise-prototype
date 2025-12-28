<?php $__env->startSection('content'); ?>
<div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
    <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Laravel Prototyping Framework</h1>
    <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">
        Ready for UI/UX prototyping with Laravel + Blade + Vue.js
    </p>

    <div style="background: #f5f5f5; padding: 2rem; border-radius: 8px; margin-bottom: 2rem;">
        <h2 style="margin-bottom: 1rem;">Architecture</h2>
        <ul style="list-style: none; padding: 0;">
            <li style="padding: 0.5rem 0;">✓ Laravel (Backend + Blade rendering)</li>
            <li style="padding: 0.5rem 0;">✓ Vue.js (Selective use for wizards/interactive prototypes)</li>
            <li style="padding: 0.5rem 0;">✓ Vite (Asset building with hot reload)</li>
            <li style="padding: 0.5rem 0;">✓ Docker (nginx, php-fpm, mysql, redis, nodejs)</li>
        </ul>
    </div>

    <div style="background: #e8f4f8; padding: 2rem; border-radius: 8px;">
        <h2 style="margin-bottom: 1rem;">Getting Started</h2>
        <p style="margin-bottom: 1rem;">
            Start the frontend watcher: <code style="background: #fff; padding: 0.25rem 0.5rem; border-radius: 4px;">docker-compose exec nodejs npm run watch</code>
        </p>
        <p>
            Access the application at: <a href="http://localhost:8080" style="color: #0066cc;">http://localhost:8080</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>