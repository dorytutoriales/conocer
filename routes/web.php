<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CertificationController as AdminCertificationController;
use App\Http\Controllers\CertificationSearchController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/buscar-certificaciones', CertificationSearchController::class)
    ->middleware('throttle:30,1')
    ->name('certifications.search');

/*
|--------------------------------------------------------------------------
| Inicio de sesión administrador
|--------------------------------------------------------------------------
|
| El nombre "login" es importante para que el middleware auth de Laravel
| pueda redirigir automáticamente a esta ruta cuando una sesión haya
| expirado o un usuario no autenticado intente ingresar al panel.
|
*/

Route::get('/admin', [AdminAuthController::class, 'create'])
    ->name('login');

Route::post('/admin/iniciar-sesion', [AdminAuthController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('admin.login.store');

/*
|--------------------------------------------------------------------------
| Rutas protegidas del administrador
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware([
        'auth',
        EnsureUserIsAdmin::class,
    ])
    ->group(function () {
        Route::get('/panel-de-control', [AdminCertificationController::class, 'index'])
            ->name('panel');

        Route::post('/certificaciones', [AdminCertificationController::class, 'store'])
            ->name('certifications.store');

        Route::put('/certificaciones/{certification}', [AdminCertificationController::class, 'update'])
            ->name('certifications.update');

        Route::delete('/certificaciones/{certification}', [AdminCertificationController::class, 'destroy'])
            ->name('certifications.destroy');

        Route::post('/cerrar-sesion', [AdminAuthController::class, 'destroy'])
            ->name('logout');
    });