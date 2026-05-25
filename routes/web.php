<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;
use Stancl\Tenancy\Middleware\PreventAccessFromTenantDomains;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'web',
    PreventAccessFromTenantDomains::class,
])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::prefix('superadmin')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
        Route::post('/tenants', [SuperAdminController::class, 'createTenant'])->name('superadmin.tenants.create');
    });
});
