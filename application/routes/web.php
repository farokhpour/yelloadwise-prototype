<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WizardController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\AdminCampaignController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\IntegrationDemoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EpicController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Filters\UserCampaignsController;
use App\Http\Controllers\Filters\AdminCampaignsController;
use App\Http\Controllers\Filters\AdminCustomersController;
use App\Http\Controllers\Dashboard\UserDashboardController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Report\AdminReportController;
use App\Http\Controllers\RegulatorCampaignController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceDashboardController;
use App\Http\Controllers\DefaultVideoController;
use App\Http\Controllers\LinkGeneratorController;
use App\Http\Controllers\NotificationToAdminsController;
use App\Http\Controllers\NotificationEpicController;
use App\Http\Controllers\NotificationTemplateController;
use App\Http\Controllers\AdminNotificationTemplateController;
use App\Http\Controllers\NotificationApiDocsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Link Generator Epic Routes
Route::prefix('epics/link-generator')->name('epics.link-generator.')->group(function () {
    Route::get('/', [LinkGeneratorController::class, 'epicIndex'])->name('epic-index');
    Route::get('/admin', [LinkGeneratorController::class, 'index'])->name('index');
    Route::get('/create', [LinkGeneratorController::class, 'create'])->name('create');
    Route::post('/', [LinkGeneratorController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [LinkGeneratorController::class, 'edit'])->name('edit');
    Route::put('/{id}', [LinkGeneratorController::class, 'update'])->name('update');
    Route::get('/{id}/report', [LinkGeneratorController::class, 'report'])->name('report');
});

// Notification to Admins Epic Routes
Route::prefix('epics/notification-to-admins')->name('epics.notification-to-admins.')->group(function () {
    Route::get('/', [NotificationToAdminsController::class, 'index'])->name('index');
});

// Notifications Epic Routes
Route::prefix('epics/notifications')->name('epics.notifications.')->group(function () {
    Route::get('/', [NotificationEpicController::class, 'index'])->name('index');
    
    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/templates', [NotificationTemplateController::class, 'index'])->name('templates.index');
        Route::get('/templates/create', [NotificationTemplateController::class, 'create'])->name('templates.create');
        Route::post('/templates', [NotificationTemplateController::class, 'store'])->name('templates.store');
        Route::get('/api-docs', [NotificationApiDocsController::class, 'index'])->name('api-docs');
    });
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/templates', [AdminNotificationTemplateController::class, 'index'])->name('templates.index');
        Route::post('/templates/{id}/approve', [AdminNotificationTemplateController::class, 'approve'])->name('templates.approve');
        Route::post('/templates/{id}/return', [AdminNotificationTemplateController::class, 'return'])->name('templates.return');
    });
});

Route::get('/epics/{epicId}', [EpicController::class, 'show'])->name('epics.show');

// Short link redirect route (must be at the end to avoid conflicts)
Route::get('/{token}', [LinkGeneratorController::class, 'redirect'])->name('link.redirect')->where('token', '[A-Za-z0-9]{8}');

Route::get('/wizard', [WizardController::class, 'index'])->name('wizard');

// Digital Taxi Rooftop Epic Routes
Route::prefix('epic/digital-taxi-rooftop')->name('epic.digital-taxi-rooftop.')->group(function () {
    // Campaign Routes (User)
    Route::prefix('campaign')->name('campaign.')->group(function () {
        Route::get('/', [CampaignController::class, 'index'])->name('index');
        Route::get('/create', [CampaignController::class, 'create'])->name('create');
        Route::post('/', [CampaignController::class, 'store'])->name('store');
        Route::get('/{id}', [CampaignController::class, 'show'])->name('show');
        Route::get('/{id}/payment', [CampaignController::class, 'payment'])->name('payment');
        Route::post('/{id}/payment', [CampaignController::class, 'processPayment'])->name('payment.process');
        Route::get('/{id}/invoice', [InvoiceController::class, 'show'])->name('invoice');
    });

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/campaigns', [AdminCampaignController::class, 'index'])->name('campaigns.index');
        Route::get('/campaigns/{id}/edit', [AdminCampaignController::class, 'edit'])->name('campaigns.edit');
        Route::put('/campaigns/{id}', [AdminCampaignController::class, 'update'])->name('campaigns.update');
        Route::get('/campaigns/{id}/download-video', [AdminCampaignController::class, 'downloadVideo'])->name('campaigns.download-video');
        Route::post('/campaigns/{id}/approve', [AdminCampaignController::class, 'approve'])->name('campaigns.approve');
        Route::post('/campaigns/{id}/run', [AdminCampaignController::class, 'run'])->name('campaigns.run');
    });

    // Regulator Routes
    Route::prefix('regulator')->name('regulator.')->group(function () {
        Route::get('/campaigns', [RegulatorCampaignController::class, 'index'])->name('campaigns.index');
        Route::get('/campaigns/{id}', [RegulatorCampaignController::class, 'show'])->name('campaigns.show');
        Route::post('/campaigns/{id}/approve', [RegulatorCampaignController::class, 'approve'])->name('campaigns.approve');
        Route::post('/campaigns/{id}/reject', [RegulatorCampaignController::class, 'reject'])->name('campaigns.reject');
        Route::get('/campaigns/{id}/download-video', [RegulatorCampaignController::class, 'downloadVideo'])->name('campaigns.download-video');
    });

    // Device Declaration Routes
    Route::prefix('devices')->name('devices.')->group(function () {
        Route::get('/', [DeviceController::class, 'index'])->name('index');
        Route::get('/create', [DeviceController::class, 'create'])->name('create');
        Route::post('/', [DeviceController::class, 'store'])->name('store');
        Route::get('/dashboard', [DeviceDashboardController::class, 'index'])->name('dashboard');
    });

    // Default Videos Routes
    Route::prefix('default-videos')->name('default-videos.')->group(function () {
        Route::get('/', [DefaultVideoController::class, 'index'])->name('index');
        Route::get('/create', [DefaultVideoController::class, 'create'])->name('create');
        Route::post('/', [DefaultVideoController::class, 'store'])->name('store');
        Route::delete('/{id}', [DefaultVideoController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/download', [DefaultVideoController::class, 'download'])->name('download');
    });

    // Integration Demo
    Route::get('/integration/demo', [IntegrationDemoController::class, 'index'])->name('integration.demo');
});

// Filters Epic Routes
Route::prefix('epics/filters')->name('epics.filters.')->group(function () {
    Route::get('/user/campaigns', [UserCampaignsController::class, 'index'])->name('user.campaigns');
    Route::get('/admin/campaigns', [AdminCampaignsController::class, 'index'])->name('admin.campaigns');
    Route::get('/admin/customers', [AdminCustomersController::class, 'index'])->name('admin.customers');
});

// Dashboard Epic Routes
Route::prefix('epics/dashboard')->name('epics.dashboard.')->group(function () {
    Route::get('/user', [UserDashboardController::class, 'index'])->name('user');
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin');
});

// Report Epic Routes
Route::prefix('epics/report')->name('epics.report.')->group(function () {
    Route::get('/admin', [AdminReportController::class, 'index'])->name('admin');
    Route::get('/export', [AdminReportController::class, 'export'])->name('export');
});

// API Routes (for digital taxi rooftop devices)
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/campaigns', [IntegrationDemoController::class, 'apiGetVideo'])->name('campaigns');
    Route::get('/video', [IntegrationDemoController::class, 'apiGetVideo'])->name('video'); // Legacy route for backward compatibility
});
