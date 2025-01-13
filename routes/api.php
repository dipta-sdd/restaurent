<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\manageCategory;
use App\Http\Controllers\manageItems;
use App\Http\Controllers\manageTables;
use App\Http\Controllers\managePaymentMethods;
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
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

    // Route::group(['middleware' => ['auth:sanctum', IsAdmin::class], 'prefix' => 'admin'], function () {
    //     Route::post('/category/add', [manageCategory::class, 'addSubCategory']);
    // });
    Route::post('/admin/category', [manageCategory::class, 'addSubCategory']);
    Route::delete('/admin/category/{id}', [manageCategory::class, 'deleteSubCategory']);


    Route::post('/admin/item', [manageItems::class, 'addItem']);
    Route::post('/admin/item/{id}', [manageItems::class, 'editItem']);
    Route::delete('/admin/item/{id}', [manageItems::class, 'deleteItem']);

    Route::post('/admin/variant', [manageItems::class, 'addVariant']);
    Route::post('/admin/variant/{id}', [manageItems::class, 'editVariant']);
    Route::delete('/admin/variant/{id}', [manageItems::class, 'deleteVariant']);

    Route::get('/admin/items', [manageItems::class, 'filterItems']);
    Route::post('/admin/category/{id}', [manageCategory::class, 'editSubCategory']);

    // Table management routes
    Route::post('/admin/table', [manageTables::class, 'addTable']);
    Route::post('/admin/table/{id}', [manageTables::class, 'updateTable']);
    Route::delete('/admin/table/{id}', [manageTables::class, 'deleteTable']);

    // Payment method management routes
    Route::post('/admin/payment-method', [managePaymentMethods::class, 'addPaymentMethod']);
    Route::post('/admin/payment-method/{id}', [managePaymentMethods::class, 'updatePaymentMethod']);
    Route::delete('/admin/payment-method/{id}', [managePaymentMethods::class, 'deletePaymentMethod']);
});


// Route::post('/admin/category/add', [manageCategory::class, 'addSubCategory']);