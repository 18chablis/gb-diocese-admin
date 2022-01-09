<?php

use App\Http\Controllers\ParishController;
use App\Http\Controllers\ShepherdController;
use App\Http\Controllers\UserController;
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

Route::group([
    'prefix' => 'v1',
    'as' => 'api.',
], function () {
    Route::group(['middleware' => 'CORS'], function ($router) {
        Route::post('/user-registration', [UserController::class, 'register']);
        Route::post('/user-login', [UserController::class, 'login']);
        Route::get('/user-profile', [UserController::class, 'logout']);
    });

    // These routes will still be secured by Laravel Passport
    Route::group(['middleware' => 'CORS'], function () {
        // User route
        Route::get('/users', [UserController::class, 'getUser']);
        // Parish route
        Route::post('/parish', [ParishController::class, 'store']);
        Route::get('/parishes', [ParishController::class, 'getParishes']);
        Route::delete('/parish/{id}', [ParishController::class, 'deleteParish']);
        // Shepherd route
        Route::post('/shepherd', [ShepherdController::class, 'store']);
        Route::get('/shepherds', [ShepherdController::class, 'getShepherds']);
        Route::delete('/shepherd/{id}', [ShepherdController::class, 'deleteShepherd']);
    });

    // This route will be public
    Route::middleware(['web'])->group(function () {
        // Route::get('/project-details', [ProjectController::class, 'getProjectWithImages']);
    });
});
