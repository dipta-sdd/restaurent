<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\manageCategory;
use App\Http\Controllers\manageItems;
use App\Http\Controllers\manageUsers;
use App\Http\Controllers\manageTables;
use App\Http\Controllers\TabaleReservationController;
use App\Http\Controllers\managePaymentMethods;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('signup', [AuthController::class, 'signup']);

Route::middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

    // Profile routes
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    // Route::group(['middleware' => ['auth:sanctum', IsAdmin::class], 'prefix' => 'admin'], function () {
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

    // User management routes
    Route::post('/admin/user', [manageUsers::class, 'addUser']);
    Route::post('/admin/user/{id}', [manageUsers::class, 'updateUser']);
    Route::delete('/admin/user/{id}', [manageUsers::class, 'deleteUser']);
    Route::get('/admin/users', [manageUsers::class, 'filterUsers']);

    Route::get('/menu/items', [MenuController::class, 'getItems']);

    Route::post('/place-order', [OrderController::class, 'placeOrder']);

    // Table management routes
    Route::post('/admin/table', [manageTables::class, 'addTable']);
    Route::post('/admin/table/{id}', [manageTables::class, 'updateTable']);
    Route::delete('/admin/table/{id}', [manageTables::class, 'deleteTable']);

    Route::post('/tables/search', [TabaleReservationController::class, 'searchTables']);

    // Payment method management routes
    Route::post('/admin/payment-method', [managePaymentMethods::class, 'addPaymentMethod']);
    Route::post('/admin/payment-method/{id}', [managePaymentMethods::class, 'updatePaymentMethod']);
    Route::delete('/admin/payment-method/{id}', [managePaymentMethods::class, 'deletePaymentMethod']);
});


// Route::post('/admin/category/add', [manageCategory::class, 'addSubCategory']);