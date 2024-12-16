<?php

use App\Http\Controllers\manageCategory;
use App\Http\Middleware\IsAdmin;
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
    return view(
        'welcome'
    );
});
Route::get('/dashboard', function () {
    return view(
        'admin.tmp_admin'
    );
});
Route::get('/login', function () {
    return view('/login');
})->name('login');

Route::get('/signup', function () {
    return view('/signup');
});
Route::get('/verification', function () {
    return view('/otp_verification');
});
Route::get('/forget_password', function () {
    return view('/forget_pass');
});

Route::group(['middleware' => ['auth:sanctum', IsAdmin::class], 'prefix' => 'admin'], function () {
    Route::get('/categories', function (manageCategory $manageCategory) {
        return $manageCategory->adminCategory();
    });
    Route::get('/dashboard', function () {
        return view('admin.tmp_admin2');
    });
});