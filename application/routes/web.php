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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/epics/{epicId}', [EpicController::class, 'show'])->name('epics.show');

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

    // Integration Demo
    Route::get('/integration/demo', [IntegrationDemoController::class, 'index'])->name('integration.demo');
});

// Filters Epic Routes
Route::prefix('epics/filters')->name('epics.filters.')->group(function () {
    Route::get('/user/campaigns', [UserCampaignsController::class, 'index'])->name('user.campaigns');
    Route::get('/admin/campaigns', [AdminCampaignsController::class, 'index'])->name('admin.campaigns');
    Route::get('/admin/customers', [AdminCustomersController::class, 'index'])->name('admin.customers');
});

// API Routes (for digital taxi rooftop devices)
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/video', [IntegrationDemoController::class, 'apiGetVideo'])->name('video');
});
