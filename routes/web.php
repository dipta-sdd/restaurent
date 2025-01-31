<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\manageCategory;
use App\Http\Controllers\manageItems;
use App\Http\Controllers\manageUsers;
use App\Http\Controllers\PosController;
use App\Http\Controllers\manageTables;
use App\Http\Controllers\managePaymentMethods;
use App\Http\Middleware\IsActive;
use App\Http\Middleware\IsAdmin;
use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

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

Route::get('/login', function () {
    return view('/login');
})->name('login');

Route::get('/signup', function () {
    return view('/signup');
});
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu.html', [MenuController::class, 'index']);
Route::get('/orderSummary', [OrderController::class, 'showOrderSummary'])->name('orderSummary');
Route::get('/orderconfirmation/{orderId}', [OrderController::class, 'showOrderConfirmation'])->name('orderConfirmation');
// add here
Route::get('/previousorder', [OrderController::class, 'previousOrders'])->name('previousorder');
Route::get('/orderconfirmation', function () {
    return view('/orderconfirmation');
});

Route::get('/verification', function (AuthController $authController) {
    return $authController->verification(request());
});
Route::get('/table_reservation', function () {
    return view('table_reservation');
});

Route::middleware([IsActive::class])->group(function () {
    Route::get('/', function () {
        return view(
            'home'
        );
    });
    Route::get('/dashboard', function () {
        return view(
            'admin.tmp_admin'
        );
    });

    Route::get('/forget_password', function () {
        return view('/forget_pass');
    });
    Route::get('/profile', function () {
        return view('/about');
    });

    Route::group(['middleware' => ['auth:sanctum', IsAdmin::class], 'prefix' => 'admin'], function () {
        Route::get('/categories', function (manageCategory $manageCategory) {
            return $manageCategory->adminCategory();
        });
        Route::get('/dashboard', function () {
            return view('admin.tmp_admin');
        });
        Route::get('/dashboard2', function () {
            return view('admin.tmp_admin2');
        });
        Route::get('/items', function (manageItems $manageItems) {
            return $manageItems->adminItems();
        });
        Route::get('/pos', function (PosController $posController) {
            return $posController->pos();
        });
        Route::get('/pos2', function (PosController $posController) {
            return $posController->pos2();
        });

        Route::get('/item/{id}', [manageItems::class, 'showItem']);
        Route::get('/users', [manageUsers::class, 'adminUsers']);
        Route::get('/users/add', [manageUsers::class, 'adminUsers']);

        // Add new admin order routes
        Route::get('/orders', [OrderController::class, 'adminOrders']);
        Route::get('/orders/{orderId}', [OrderController::class, 'adminOrderDetails']);
        Route::get('/tables', [manageTables::class, 'adminTables']);
        Route::get('/payment-methods', [managePaymentMethods::class, 'adminPaymentMethods']);
    });
});

// Add API route for updating order status
Route::post('/api/admin/orders/{orderId}/status', [OrderController::class, 'updateOrderStatus'])
    ->middleware(['auth:sanctum', IsAdmin::class]);
