<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CertificationController as AdminCertificationController;
use App\Http\Controllers\CertificationSearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Página pública
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('home');

/*
|--------------------------------------------------------------------------
| Búsqueda pública de certificaciones
|--------------------------------------------------------------------------
*/

Route::get(
    '/buscar-certificaciones',
    CertificationSearchController::class
)
    ->middleware('throttle:30,1')
    ->name('certifications.search');

/*
|--------------------------------------------------------------------------
| Inicio de sesión del administrador
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin',
    [
        AdminAuthController::class,
        'create',
    ]
)->name('login');

Route::post(
    '/admin/iniciar-sesion',
    [
        AdminAuthController::class,
        'store',
    ]
)
    ->middleware('throttle:10,1')
    ->name('admin.login.store');

/*
|--------------------------------------------------------------------------
| Panel de administración
|--------------------------------------------------------------------------
|
| Estas rutas requieren:
|
| 1. Que exista una sesión iniciada.
| 2. Que el usuario tenga is_admin = 1.
|
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware([
        'auth',
        'can:access-admin',
    ])
    ->group(function (): void {

        /*
        |--------------------------------------------------------------------------
        | Panel
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/panel-de-control',
            [
                AdminCertificationController::class,
                'index',
            ]
        )->name('panel');

        /*
        |--------------------------------------------------------------------------
        | Crear certificación
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/certificaciones',
            [
                AdminCertificationController::class,
                'store',
            ]
        )->name('certifications.store');

        /*
        |--------------------------------------------------------------------------
        | Actualizar certificación
        |--------------------------------------------------------------------------
        */

        Route::put(
            '/certificaciones/{certification}',
            [
                AdminCertificationController::class,
                'update',
            ]
        )->name('certifications.update');

        /*
        |--------------------------------------------------------------------------
        | Eliminar certificación
        |--------------------------------------------------------------------------
        */

        Route::delete(
            '/certificaciones/{certification}',
            [
                AdminCertificationController::class,
                'destroy',
            ]
        )->name('certifications.destroy');

        /*
        |--------------------------------------------------------------------------
        | Cerrar sesión
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/cerrar-sesion',
            [
                AdminAuthController::class,
                'destroy',
            ]
        )->name('logout');
    });