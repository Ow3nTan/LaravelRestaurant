<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WebsiteSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('logout', [LoginController::class, 'logout']);
Route::view('tableReserve', 'table-reservation');

Route::view('dashboard', '/admin/dashboard');
Route::view('menu_category', '/admin/menu_category');
Route::post('/ajax-files/menu_categories_ajax', [MenuCategoryController::class, 'handleAjaxRequest']);
Route::post('/ajax-files/dashboard_ajax', [DashboardController::class, 'handleAjaxRequest']);

Route::post('contact',[ContactController::class,'send']);
Route::get('logout',[LoginController::class,'logout']);
Route::view('tableReserve','table-reservation');
Route::view('order_food','order-food');