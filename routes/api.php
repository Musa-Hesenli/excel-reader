<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifController;

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

Route::post( '/tarifs/all', [ TarifController::class, 'index' ] );

// processing merhelesini route kimi yaratdimki yoxlamaq rahat olsun
Route::post( '/tarifs/process', [ TarifController::class, 'process' ] );
