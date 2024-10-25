<?php

use App\Http\Controllers\ActuaController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TipoCasoController;
use App\Http\Controllers\TipoMensajeController;
use App\Http\Controllers\TipoPersonaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SancionController;
use App\Http\Controllers\CasoActuadoController;
use App\Http\Controllers\CasoPersonasController;
use App\Http\Controllers\BusquedaController;
///controller
use App\Http\Controllers\PersonaTipoPersonaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RepspdfController;
use App\Http\Controllers\SancionPersonasController;
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
//CASOS -PERSONAS////
// Asegúrate de tener esta línea

Route::resource('administrador/caso_personas', CasoPersonasController::class);
// Ruta para la búsqueda de personas
Route::get('caso_personas/search/personas', [CasoPersonasController::class, 'searchPersonas'])->name('caso_personas.searchPersonas');
// Ruta para la búsqueda de casos
Route::get('caso_personas/search/casos', [CasoPersonasController::class, 'searchCasos'])->name('caso_personas.searchCasos');
//---------------------------------CASO_ACTUADOS -----------------------------------------------------
route::resource('administrador/caso_actuados', CasoActuadoController::class);
Route::resource('administrador/actuas', ActuaController::class);
Route::resource('actuas', ActuaController::class);
Route::get('/actuas/{actua}/edit', [App\Http\Controllers\ActuaController::class, 'edit'])->name('actuas.edit');
Route::put('/actuas/{actua}', [App\Http\Controllers\ActuaController::class, 'update'])->name('actuas.update');

// Asegúrate de definir las rutas
Route::get('/casos/search', [CasoActuadoController::class, 'search'])->name('casos.search');
Route::get('/search-actuas', [CasoActuadoController::class, 'searchActuas'])->name('actuados.search');

//----------------------------ACTUADOS------------------------------
//SUMARIO-------
route::get('personas/imprimir/{ids}', [RepspdfController::class, 'imprimirPorIds'])->name('personas.imprimirPorIds');
Route::get('/personas/imprimir-todos', [RepspdfController::class, 'imprimirTodossumarios'])->name('personas.imprimirTodossumarios');
//personas excel
Route::get('personas/exportar', [RepspdfController::class, 'exportarsumarios'])->name('personas.exportarsumarios');
//------------------------------CASOS ///impresiones pdf 
Route::get('/casos/imprimir-todos', [RepspdfController::class, 'imprimirTodos'])->name('casos.imprimirTodos');
Route::get('casos/imprimir/{id}', [RepspdfController::class, 'imprimirPorId'])->name('casos.imprimirPorId');
//excel
Route::get('casos/exportar', [RepspdfController::class, 'exportar'])->name('casos.exportar');
// reporte esta distico 
Route::get('reportes/index', [ReporteController::class, 'index']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Cambia seg%C3%BAn tu necesidad
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/personas', PersonaController::class);
Route::resource('/mensajes', MensajeController::class);
Route::resource('/tipo_mensajes', TipoMensajeController::class);
Route::resource('/tipo_personas', TipoPersonaController::class);
// Route::get('/searchCasos', [TipoCasoController::class, 'searchCasos'])->name('casos.search');
// En routes/web.php o routes/api.php
Route::get('tipo_casos/{id}/edit', [TipoCasoController::class, 'edit'])->name('tipo_casos.edit');
Route::put('tipo_casos/{id}', [TipoCasoController::class, 'update'])->name('tipo_casos.update');
Route::get('/casos/search', [TipoCasoController::class, 'searchCasos'])->name('casos.search');
Route::get('/searchTipoCasos', [TipoCasoController::class, 'searchTipoCasos'])->name('tipo_casos.search');
Route::get('/casos/{id}/search-persona', [CasoController::class, 'searchPersona'])->name('caso.searchPersona');

Route::get('/casos/buscar-personas', [CasoController::class, 'buscarPersonas'])->name('casos.buscar.personas');
Route::post('/casos/{id}/add-persona', [CasoController::class, 'addPersona'])->name('caso.addPersona');


Route::resource('/tipo_casos', TipoCasoController::class);
Route::resource('/casos', CasoController::class);
//----------------------------------------------------SANCION -----------------------------
Route::resource('administrador/sancions', SancionController::class);
//Route::resource('/sancions', SancionController::class);
Route::resource('sancions', SancionController::class);
////////////////////////////////////////////////
//SANCION _ PERSONA -------------------------------------------------------------
Route::resource('sancion_personas', SancionPersonasController::class);
//BUSQUEDA 
Route::get('/personas/search', [SancionpersonasController::class, 'searchPersonas'])->name('personas.search');
Route::get('/sanciones/search', [SancionpersonasController::class, 'searchSanciones'])->name('sanciones.search');
Route::get('/sanciones/buscar', [SancionController::class, 'buscar'])->name('sanciones.buscar');
Route::post('sancion_personas/{id}/addSancion', [SancionpersonasController::class, 'addSancion'])->name('sancion_personas.addSancion');
//-----------------------------SANCION----------------------------------------------------------------
//Route::post('/personas/store-via-ajax', [PersonaController::class, 'storeViaAjax'])->name('personas.store.via.ajax');
Route::post('/crearSancion', [SancionpersonasController::class, 'crearSancion'])->name('sancion_personas.crearSancion');
Route::post('sanciones/crear', [SancionpersonasController::class, 'crearSancion'])->name('sanciones.crear');
// En routes/web.php o routes/api.php
Route::get('/personas/buscar', [PersonaController::class, 'buscar'])->name('personas.buscar');
Route::get('/sanciones/buscar', [SancionController::class, 'buscar'])->name('sanciones.buscar');

Route::resource('users', Usercontroller::class)->names('admin.users');
Route::resource('/roles', RoleController::class);
Auth::routes();
Route::resource('/homes', HomeController::class);
//BUSQUEDA AVANZADA
// Route::get('/busqueda', [BusquedaController::class, 'index'])->name('busqueda.index');
Route::get('/busqueda', [BusquedaController::class, 'index'])->name('busqueda.index');


//BUSQUEDA AVANZADA
// Route::post('/busqueda/resultados', [BusquedaController::class, 'buscar'])->name('busqueda.resultados');
Route::post('/busqueda/pdf', [BusquedaController::class, 'buscar'])->name('busquedas.pdf');
Route::post('/busqueda/show', [BusquedaController::class, 'buscar'])->name('busquedas.show');
Route::get('/buscar-persona/{ci}', [CasoController::class, 'buscarPorCI']);

Route::prefix('administrador')->group(function () {
    Route::resource('persona_tipo_personas', PersonaTipoPersonaController::class);

    // Rutas para las búsquedas de personas y tipos de personas
});
Route::get('search/personas', [PersonaTipoPersonaController::class, 'searchPersonas'])->name('search.personas');
Route::get('search/tipo_personas', [PersonaTipoPersonaController::class, 'searchTipoPersonas'])->name('search.tipo_personas');
Route::resource('persona_tipo_personas', PersonaTipoPersonaController::class);

//          -----------ACTUAS---------
