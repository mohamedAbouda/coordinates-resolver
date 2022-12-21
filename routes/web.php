<?php

use App\Http\Controllers\CoordinatesResolverController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coordinates', [CoordinatesResolverController::class, 'getCoordinates']);
Route::post('/fetch/coordinates', [CoordinatesResolverController::class, 'fetchCoordinates'])->name('fetch.coordinates');
