<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\manageCategory;
use App\Http\Middleware\IsAdmin;

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

Route::post('signup', [AuthController::class, 'signup']);

Route::middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    // Route::group(['middleware' => ['auth:sanctum', IsAdmin::class], 'prefix' => 'admin'], function () {
    //     Route::post('/category/add', [manageCategory::class, 'addSubCategory']);
    // });
    Route::post('/admin/category', [manageCategory::class, 'addSubCategory']);
    Route::post('/admin/category/{id}', [manageCategory::class, 'editSubCategory']);
    Route::delete('/admin/category/{id}', [manageCategory::class, 'deleteSubCategory']);
});

// Route::post('/admin/category/add', [manageCategory::class, 'addSubCategory']);