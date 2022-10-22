<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BasicController;

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

// Route::get('/', function () {
//     return view('index');
// });


//Challenge 1
Route::get('/', [BasicController::class, 'index']);
Route::post('/record/save', [BasicController::class, 'save']);
Route::get('/record/remove/{id}', [BasicController::class, 'remove']);

//Challenge 2
Route::get('/addresses/list/{state?}/{city?}', [BasicController::class, 'list_addresses']);
