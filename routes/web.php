<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteComunController;
use App\Http\Controllers\ClienteVIPController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\TipoProveedorController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí definimos todas las rutas de la aplicación.
|
*/

// --------------------- LOGIN MANUAL ---------------------
// Mostrar formulario de login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Procesar login
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/pantallainicial', function () {
    // Aseguramos que solo usuarios logueados puedan acceder
    return view('pantallainicial');
})->middleware('auth')->name('pantalla.inicial');




// ------------------------log out---------------------------------
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');







// ---------------- DASHBOARD Y PERFIL -------------------
// Dashboard protegido por middleware auth y verified
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil protegidas por auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ---------------------------------------------------------
//----------------------USUARIOS----------------------------
// Página de usuarios
Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});
//-------------------------cliente----------------------------------
Route::resource('clientes', ClienteController::class);


//--------------------CLIENTES VIP------------------------------
Route::prefix('clientes_vip')->name('clientes_vip.')->group(function() {
    Route::get('/', [ClienteVIPController::class, 'index'])->name('index');
    Route::get('/{id}/edit', [ClienteVIPController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ClienteVIPController::class, 'update'])->name('update');
    Route::delete('/{id}', [ClienteVIPController::class, 'destroy'])->name('destroy');

    // Ruta para ascender cliente a VIP
    Route::get('/make-vip/{id_cliente}', [ClienteVIPController::class, 'makeVip'])->name('makeVip');
});



//---------------------CLIENTE COMUN------------------------


Route::prefix('clientes_comunes')->name('clientes_comunes.')->group(function() {
    Route::get('/', [ClienteComunController::class, 'index'])->name('index');
    Route::get('/create', [ClienteComunController::class, 'create'])->name('create');
    Route::post('/', [ClienteComunController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ClienteComunController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ClienteComunController::class, 'update'])->name('update');
    Route::delete('/{id}', [ClienteComunController::class, 'destroy'])->name('destroy');
});

//--------------------------------categorias---------------
Route::resource('categorias', CategoriaController::class);

//-----------------------------temporadas--------------
Route::resource('temporadas', TemporadaController::class);

//-------------------------------tipoProveedor--------------------
Route::resource('tipos_proveedor', TipoProveedorController::class);

//---------------------------------proveedor------------------------


Route::prefix('proveedores')->name('proveedores.')->group(function () {
    Route::get('/', [ProveedorController::class, 'index'])->name('index');
    Route::get('/create', [ProveedorController::class, 'create'])->name('create');
    Route::post('/', [ProveedorController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ProveedorController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ProveedorController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProveedorController::class, 'destroy'])->name('destroy');
});


//------------------productos----------------------
Route::prefix('productos')->group(function () {
    Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
});

//--------------------permisos-----------------
Route::get('/permisos', [PermisoController::class, 'index'])->name('permisos.index');

//-------------------------inventarios--------------------
Route::get('/inventario', [InventarioController::class, 'index'])->middleware('auth')->name('inventario.index');
Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');

//----------------------ventas-------------------------------
Route::prefix('ventas')->group(function () {
    Route::get('/', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('/', [VentaController::class, 'store'])->name('ventas.store');
});

//-----------------------------detalle de venta------------------------------
Route::get('detalleventa', [DetalleVentaController::class, 'index'])->name('detalleventa.index');
Route::get('detalleventa/{id}', [DetalleVentaController::class, 'show'])->name('detalleventa.show');

// Si usas Breeze u otro auth predeterminado
//require __DIR__.'/auth.php';
