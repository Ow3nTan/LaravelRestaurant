<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WebsiteSettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderFoodController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



Route::post('contact', [ContactController::class, 'send']);
Route::get('logout', [LoginController::class, 'logout']);
Route::view('tableReserve', 'table-reservation');

// /* Admin Routes */
// Route::group(['middleware' => ['auth', 'admin']], function () {
//     Route::view('dashboard', '/admin/dashboard');
//     Route::view('menu_category', '/admin/menu_category');
//     Route::post('/ajax-files/menu_categories_ajax', [MenuCategoryController::class, 'handleAjaxRequest']);
//     Route::post('/ajax-files/dashboard_ajax', [DashboardController::class, 'handleAjaxRequest']);
// });

/* Admin Routes */

    Route::view('dashboard', '/admin/dashboard');
    Route::view('menu_category', '/admin/menu_category');
    Route::post('/ajax-files/menu_categories_ajax', [MenuCategoryController::class, 'handleAjaxRequest']);
    Route::post('/ajax-files/dashboard_ajax', [DashboardController::class, 'handleAjaxRequest']);
    


//order_food
Route::post('storeOrder',[OrderFoodController::class,'store']);
Route::get('order_food',[OrderFoodController::class,'index']);


Route::view('order_food','order-food');

Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
Route::post('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
// Route::post('/gallery/add', [GalleryController::class, 'addImage'])->name('gallery.addImage');
Route::post('/gallery/add', [GalleryController::class, 'store'])->name('gallery.store');
Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

Route::get('/client', [ClientsController::class, 'index'])->name('clients.index');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/users', [UsersController::class, 'index'])->name('users.index');
//     Route::get('/users/{user_id}/edit', [UsersController::class, 'edit'])->name('users.edit');
//     Route::post('/users/{user_id}/edit', [UsersController::class, 'update'])->name('users.update');
// });

Route::get('/users', [UsersController::class, 'index'])->name('users.index');
// Route::get('/users/{user_id}/edit', [UsersController::class, 'edit'])->name('users.edit');
// Route::post('/users/{user_id}/edit', [UsersController::class, 'update'])->name('users.update');

Route::any('/test-catchall', function () {
    return "This is a test route to catch all methods.";
});