@php
    $isInDigitalTaxiRoute = request()->is('epics/digital-taxi-rooftop*') || request()->routeIs('epic.digital-taxi-rooftop.*');
    $isInFiltersRoute = request()->is('epics/filters*') || request()->routeIs('epics.filters.*');
    $isInDashboardRoute = request()->is('epics/dashboard*') || request()->routeIs('epics.dashboard.*');
    $isInReportRoute = request()->is('epics/report*') || request()->routeIs('epics.report.*');
    $isInLinkGeneratorRoute = request()->is('epics/link-generator*') || request()->routeIs('epics.link-generator.*');
    $isInNotificationRoute = request()->is('epics/notifications*') || request()->routeIs('epics.notifications.*');
@endphp

<header style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 0; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 2rem;">
    <nav style="max-width: 1400px; margin: 0 auto; padding: 0 2rem;">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
            <!-- Logo/Brand -->
            <!-- Navigation Links -->
            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('home') }}" 
                   style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                   onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                   onmouseout="this.style.background='transparent';">
                    🏠 صفحه اصلی
                </a>
                
                @if($isInDigitalTaxiRoute)
                    <a href="{{ route('epic.digital-taxi-rooftop.campaign.index') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        📊 فهرست کمپین‌های من
                    </a>
                    
                    <a href="{{ route('epic.digital-taxi-rooftop.admin.campaigns.index') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        🔧 مدیریت ادمین
                    </a>
                    
                    <a href="{{ route('epic.digital-taxi-rooftop.regulator.campaigns.index') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        ⚖️ مجوز دهنده
                    </a>
                    
                    <a href="{{ route('epic.digital-taxi-rooftop.devices.index') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        📱 ثبت دستگاه‌ها
                    </a>
                    
                    <a href="{{ route('epic.digital-taxi-rooftop.devices.dashboard') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        📺 داشبورد دستگاه‌ها
                    </a>
                    
                    <a href="{{ route('epic.digital-taxi-rooftop.default-videos.index') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        🎬 ویدیوهای پیش‌فرض
                    </a>
                    
                    <a href="{{ route('epic.digital-taxi-rooftop.integration.demo') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        🔌 روش کار سیستم
                    </a>
                @endif
                
                @if($isInFiltersRoute)
                    <a href="{{ route('epics.filters.user.campaigns') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        📊 جدول کمپین‌های کاربر
                    </a>
                    
                    <a href="{{ route('epics.filters.admin.campaigns') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        🔧 جدول کمپین‌های ادمین
                    </a>
                    
                    <a href="{{ route('epics.filters.admin.customers') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        👥 جدول مشتریان ادمین
                    </a>
                @endif
                
                @if($isInDashboardRoute)
                    <a href="{{ route('epics.dashboard.user') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        👤 داشبورد کاربر
                    </a>
                    
                    <a href="{{ route('epics.dashboard.admin') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        🔧 داشبورد ادمین
                    </a>
                @endif
                
                @if($isInReportRoute)
                    <a href="{{ route('epics.report.admin') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        📋 گزارش‌های ادمین
                    </a>
                @endif
                
                @if($isInLinkGeneratorRoute)
                    <a href="{{ route('epics.link-generator.index') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        🔗 فهرست لینک‌ها
                    </a>
                @endif
                
                @if($isInNotificationRoute)
                    <a href="{{ route('epics.notifications.user.templates.index') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        📝 قالب‌های من
                    </a>
                    
                    <a href="{{ route('epics.notifications.user.templates.create') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        ➕ ایجاد قالب جدید
                    </a>
                    
                    <a href="{{ route('epics.notifications.admin.templates.index') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        🔧 بررسی قالب‌ها (ادمین)
                    </a>
                    
                    <a href="{{ route('epics.notifications.user.api-docs') }}" 
                       style="padding: 0.5rem 1rem; color: white; text-decoration: none; border-radius: 6px; transition: all 0.3s; font-weight: 500;"
                       onmouseover="this.style.background='rgba(255,255,255,0.2)';"
                       onmouseout="this.style.background='transparent';">
                        📚 مستندات API
                    </a>
                @endif
            </div>
        </div>
    </nav>
</header>

