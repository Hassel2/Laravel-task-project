<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use App\Models\User;

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

/* Route::middleware('auth:passport')->get('/user', function (Request $request) { */
/*     return $request->user(); */
/* }); */

Route::group(['prefix' => 'user'], function() {
    Route::get('/', function() {
        return response()->json(request()->user());
    })->middleware('auth:api');
});

Route::get('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'register']);
Route::get('/tasks_show', [TaskController::class, 'show'])->middleware('auth:api');
Route::get('/task/{id}', [TaskController::class, 'find'])->middleware('auth:api');
Route::post('/task_create', [TaskController::class, 'create']);
Route::post('/task_update/{id}', [TaskController::class, 'update']);
Route::delete('/task_delete/{id}', [TaskController::class, 'delete']);
