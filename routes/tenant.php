<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\AuthController;
use App\Http\Controllers\Tenant\MessagingController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenancyServiceProvider out of the box.
|
| Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return redirect()->route('tenant.login');
    });

    Route::get('/login', [AuthController::class, 'showLogin'])->name('tenant.login');
    Route::post('/login', [AuthController::class, 'login'])->name('tenant.login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('tenant.register');
    Route::post('/register', [AuthController::class, 'register'])->name('tenant.register.post');

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('tenant.logout');
        Route::get('/messages', [MessagingController::class, 'index'])->name('tenant.messages.index');
        Route::post('/messages', [MessagingController::class, 'store'])->name('tenant.messages.store');
    });
});
