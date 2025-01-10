<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogsController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteMembresiaController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\AsistenciaController;


//Route::get('/', function () {
//    return view('auth.login');
//});

Route::post('/register', [AuthController::class, 'register'])->name('registro');
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['check_role:Administrador']], function () {
        // Rutas accesibles solo para administradores

        //USERS
        Route::get('/users/create', [AuthController::class, 'create'])->name('users.create');
        Route::post('/users', [AuthController::class, 'store'])->name('users.store');
        Route::get('/users', [AuthController::class, 'index'])->name('users.index');
        Route::get('/user/edit/{id}', [AuthController::class, 'edit'])->name('users.edit');
        Route::put('/user/{id}', [AuthController::class, 'update'])->name('users.update');

        Route::patch('/user/{id}/inactivar',  [AuthController::class, 'inactivar'])->name('users.inactivar');
        Route::patch('/user/{id}/activar',  [AuthController::class, 'activar'])->name('users.activar');


        Route::get('/catalogs/membresias/create', [CatalogsController::class, 'create_membresia'])->name('membresias.create');
        Route::post('/catalogs/membresias', [CatalogsController::class, 'store_membresia'])->name('membresias.store');
        Route::get('/catalogs/membresias', [CatalogsController::class, 'index_membresia'])->name('membresias.index');
        Route::get('/catalogs/membresias/edit/{id}', [CatalogsController::class, 'edit_membresia'])->name('membresias.edit');
        Route::put('/catalogs/membresias/{id}', [CatalogsController::class, 'update_membresia'])->name('membresias.update');

        // Ruta para el listado de pagos
        Route::get('/pagos', [ClienteMembresiaController::class, 'indexPagos'])->name('pagos.index');
        // Ruta para la vista de generación de reportes de pagos
        Route::get('/pagos/reportes', [ClienteMembresiaController::class, 'reportesPagos'])->name('pagos.reportes');
        // Ruta para generar el reporte de pagos en PDF o Excel
        Route::post('/pagos/reportes/export', [ClienteMembresiaController::class, 'generarReportePagos'])->name('pagos.reporte.export');
        Route::get('/pagos/{id}', [ClienteMembresiaController::class, 'mostrarPago'])->name('pagos.show');
        Route::get('/pagos/{id}/factura', [ClienteMembresiaController::class, 'generarFactura'])->name('pagos.factura');

        Route::get('/afluencia-diaria', [AsistenciaController::class, 'obtenerAfluenciaDiaria'])->name('asistencias.grafica');

    });
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');//middleware('role:Administrador');


    //RUTAS CLIENTES
    Route::get('/cliente/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/cliente', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/captura-huella/{id}', [ClienteController::class, 'showCapturaHuella'])->name('clientes.showCapturaHuella');
    Route::get('/cliente/consultas', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/cliente/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/cliente/edit/{cliente}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/cliente/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::patch('/cliente/{id}/delete',  [ClienteController::class, 'inactivar'])->name('clientes.inactivar');
    Route::patch('/clientes/reactivar/{id}', [ClienteController::class, 'reactivar'])->name('clientes.reactivar');
    Route::patch('/clientes/toggleEstado/{id}', [ClienteController::class, 'toggleEstado'])->name('clientes.toggleEstado');
    Route::post('/clientes/capturarHuella/{id}', [ClienteController::class, 'capturarHuella'])->name('clientes.capturarHuella');
    Route::post('/enrolar-huella-temp', [ClienteController::class, 'enrolarHuellaTemp']);



    
    // Rutas para Pagos o Suscripciones
    Route::get('/suscripciones', [ClienteMembresiaController::class, 'index'])->name('suscripciones.index');
    Route::get('/suscripciones/create', [ClienteMembresiaController::class, 'create'])->name('suscripciones.create');
    Route::post('/suscripciones', [ClienteMembresiaController::class, 'store'])->name('suscripciones.store');
    Route::patch('/suscripciones/suspender/{id}', [ClienteMembresiaController::class, 'suspender'])->name('suscripciones.suspender');

    


    
    // routes/web.php
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    // routes/web.php
    Route::get('/notificaciones/get', [NotificacionController::class, 'getNotificaciones'])->name('notificaciones.get');
    // Ruta para procesar la asistencia
    Route::get('/asistencia', [NotificacionController::class, 'asist'])->name('notificaciones.asist');

    
    





    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'destroy'])->name('logout');
});


