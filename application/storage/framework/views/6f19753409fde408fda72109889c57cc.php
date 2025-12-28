<header style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 0; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 2rem;">
    <nav style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <!-- Logo/Brand -->
            <!-- Navigation Links -->
            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <a href="<?php echo e(route('home')); ?>" 
                   style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                   onmouseout="this.style.background='transparent';">
                    🏠 صفحه اصلی
                </a>
                
                <a href="<?php echo e(route('epics.show', 'digital-taxi-rooftop')); ?>" 
                   style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                   onmouseout="this.style.background='transparent';">
                    📋 اپیک تاکسی دیجیتال
                </a>
                
                <a href="<?php echo e(route('campaigns.index')); ?>" 
                   style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                   onmouseout="this.style.background='transparent';">
                    📊 فهرست کمپین‌های من
                </a>
                
                <a href="<?php echo e(route('admin.campaigns.index')); ?>" 
                   style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                   onmouseout="this.style.background='transparent';">
                    🔧 مدیریت ادمین
                </a>
                
                <a href="<?php echo e(route('integration.demo')); ?>" 
                   style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                   onmouseout="this.style.background='transparent';">
                    🔌 نمایش یکپارچه‌سازی
                </a>
            </div>
        </div>
    </nav>
</header>

<?php /**PATH /var/www/html/resources/views/partials/header.blade.php ENDPATH**/ ?>