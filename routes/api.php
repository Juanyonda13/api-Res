<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//mostrar productos en la base de datos
Route::get('/products',[ProductController::class,'index']);
//registrarse con token
Route::post('/registers',[AuthController::class,'register']);
//iniciar sesión 
Route::post('/login',[AuthController::class,'login']);
//cerrar sesión 
Route::get('/logout',[AuthController::class,'logout']);
//Proteccion de rutas de Sanctum
Route::middleware('auth:sanctum')->group(function(){
    
});