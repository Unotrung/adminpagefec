<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('vendor.page');
// })->middleware(['auth'])->name('page');
// Route::get('/', [PostController::class, 'home'])->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';

$use = Auth::user();

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:web');;
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
Route::post('/customer/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/dtajax', [App\Http\Controllers\CustomerController::class, 'dtajax'])->name('customer.dtajax');
Route::get('/customer/add', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.add');
Route::get('/bnpl', [App\Http\Controllers\BnplController::class, 'index'])->name('bnpl');
Route::get('/bnpl/dtajax', [App\Http\Controllers\BnplController::class, 'dtajax'])->name('bnpl.dtajax');
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::get('/employee/dtajax', [App\Http\Controllers\EmployeeController::class, 'dtajax'])->name('employee.dtajax');
Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::get('/bnpl/edit/{id}', [App\Http\Controllers\BnplController::class, 'edit'])->name('bnpl.edit');
Route::get('/bnpl/edit', [App\Http\Controllers\BnplController::class, 'edit'])->name('bnpl.edit');
Route::get('/employee/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::get('/customer/show', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show');
Route::get('/customer/show/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show');

//Users
// Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('team');
// Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('user.edit');
// Route::post('/users/assign', ['UsersController@assign'])->name('user.assign');


Route::get('/account/show', function(){
    return view('vendor.adminlte.account.show');
});
Route::get('/account/change', function(){
    return view('vendor.adminlte.account.change');
});

//Users
Route::group([], function (){
    Route::get('/users/index', 'App\Http\Controllers\UsersController@index')->name('users.index');
    Route::get('/users/create', 'App\Http\Controllers\UsersController@create')->name('users.create');
    Route::get('/users/edit', 'App\Http\Controllers\UsersController@edit')->name('users.edit');
    Route::get('/users/edit/{id}', 'App\Http\Controllers\UsersController@edit')->name('users.edit');
    Route::post('/users/store', 'App\Http\Controllers\UsersController@store')->name('users.store');
    Route::post('/users/update', 'App\Http\Controllers\UsersController@update')->name('users.update');
    Route::get('/users/show', 'App\Http\Controllers\UsersController@show')->name('users.show');
    Route::get('/users/show/{id}', 'App\Http\Controllers\UsersController@show')->name('users.show');
    Route::get('/users/dtajax', [App\Http\Controllers\UsersController::class, 'dtajax'])->name('users.dtajax');
    Route::get('/users/delete/{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->name('users.delete');
 });

// Permissions
Route::group([], function () {
    Route::get('/permission/index', 'App\Http\Controllers\PermissionsController@index')->name('permission.index');
    Route::get('/permission/add', 'App\Http\Controllers\PermissionsController@create')->name('permission.add');
    Route::get('/permission/edit','App\Http\Controllers\PermissionsController@edit')->name('permission.edit');
    Route::get('/permission/edit/{id}','App\Http\Controllers\PermissionsController@edit')->name('permission.edit');
    Route::post('/permission/store', 'App\Http\Controllers\PermissionsController@store')->name('permission.store');
    Route::get('/permission/dtajax', [App\Http\Controllers\PermissionsController::class, 'dtajax'])->name('permission.dtajax');
    Route::post('/permission/update', 'App\Http\Controllers\PermissionsController@update')->name('permission.update');
    Route::get('/permission/delete/{id}', [App\Http\Controllers\PermissionsController::class, 'destroy'])->name('permission.delete');
});

//Roles
Route::group([], function (
) {
    Route::get('/roles/add', [App\Http\Controllers\RolesController::class, 'create'])->name('roles.add');
    Route::get('/roles/index', [App\Http\Controllers\RolesController::class, 'index'])->name('roles.index');
    Route::post('/roles/store', [App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update', [App\Http\Controllers\RolesController::class, 'update'])->name('roles.update');
    Route::get('/roles/dtajax', [App\Http\Controllers\RolesController::class, 'dtajax'])->name('roles.dtajax');
    Route::get('/roles/delete/{id}', [App\Http\Controllers\RolesController::class, 'destroy'])->name('roles.delete');
});

//Department
Route::group([], function () {
    Route::get('/department/index', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
    Route::get('/department/edit', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
    Route::get('/department/edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
    Route::get('/department/add', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.add');
    Route::get('/department/show', 'App\Http\Controllers\DepartmentController@show')->name('department.show');
    Route::get('/department/show/{id}', 'App\Http\Controllers\DepartmentController@show')->name('department.show');
    Route::post('/department/update', [App\Http\Controllers\DepartmentController::class, 'update'])->name('department.update');
    Route::post('/department/store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
    Route::get('/department/dtajax', [App\Http\Controllers\DepartmentController::class, 'dtajax'])->name('department.dtajax');
    Route::get('/department/delete/{id}', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('department.delete');
});

//FAQs
Route::group([], function () {
    Route::get('/faqs/index', [App\Http\Controllers\FaqController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/edit', [App\Http\Controllers\FaqController::class, 'edit'])->name('faqs.edit');
    Route::get('/faqs/edit/{id}', [App\Http\Controllers\FaqController::class, 'edit'])->name('faqs.edit');
    Route::get('/faqs/add', [App\Http\Controllers\FaqController::class, 'create'])->name('faqs.add');
    Route::post('/faqs/update', [App\Http\Controllers\FaqController::class, 'update'])->name('faqs.update');
    Route::post('/faqs/store', [App\Http\Controllers\FaqController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/dtajax', [App\Http\Controllers\FaqController::class, 'dtajax'])->name('faqs.dtajax');
    Route::get('/faqs/delete/{id}', [App\Http\Controllers\FaqController::class, 'destroy'])->name('faqs.delete');
});
//Promotions
Route::group([], function () {
    Route::get('/promotions/index', [App\Http\Controllers\PromotionsController::class, 'index'])->name('promotions.index');
    Route::get('/promotions/edit', [App\Http\Controllers\PromotionsController::class, 'edit'])->name('promotions.edit');
    Route::get('/promotions/edit/{id}', [App\Http\Controllers\PromotionsController::class, 'edit'])->name('promotions.edit');
    Route::get('/promotions/add', [App\Http\Controllers\PromotionsController::class, 'create'])->name('promotions.add');
    Route::post('/promotions/update', [App\Http\Controllers\PromotionsController::class, 'update'])->name('promotions.update');
    Route::post('/promotions/store', [App\Http\Controllers\PromotionsController::class, 'store'])->name('promotions.store');
    Route::get('/promotions/show', [App\Http\Controllers\PromotionsController::class, 'show'])->name('promotions.show');
    Route::get('/promotions/delete/{id}', [App\Http\Controllers\PromotionsController::class, 'destroy'])->name('promotions.delete');
    Route::get('/promotions/show/{id}', [App\Http\Controllers\PromotionsController::class, 'show'])->name('promotions.show');
    Route::get('/promotions/dtajax', [App\Http\Controllers\PromotionsController::class, 'dtajax'])->name('promotions.dtajax');
});
//News
Route::get('/news/index', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
Route::get('/news/add', [App\Http\Controllers\NewsController::class, 'create'])->name('news.add');
Route::post('/news/store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
Route::get('/news/dtajax', [App\Http\Controllers\NewsController::class, 'dtajax'])->name('news.dtajax');
Route::get('/news/show', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/news/show/{id}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
Route::get('/news/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
Route::get('/news/edit/{id}', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
Route::post('/news/update', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
Route::get('/news/delete/{id}', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.delete');
//Notifications
Route::get('/notifications/index', [App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications.index');
Route::get('/notifications/add', [App\Http\Controllers\NotificationsController::class, 'create'])->name('notifications.add');
Route::post('/notifications/store', [App\Http\Controllers\NotificationsController::class, 'store'])->name('notifications.store');
Route::get('/notifications/dtajax', [App\Http\Controllers\NotificationsController::class, 'dtajax'])->name('notifications.dtajax');
Route::get('/notifications/show', [App\Http\Controllers\NotificationsController::class, 'show'])->name('notifications.show');
Route::get('/notifications/show/{id}', [App\Http\Controllers\NotificationsController::class, 'show'])->name('notifications.show');
Route::get('/notifications/edit', [App\Http\Controllers\NotificationsController::class, 'edit'])->name('notifications.edit');
Route::get('/notifications/edit/{id}', [App\Http\Controllers\NotificationsController::class, 'edit'])->name('notifications.edit');
Route::post('/notifications/update', [App\Http\Controllers\NotificationsController::class, 'update'])->name('notifications.update');
Route::get('/notifications/delete/{id}', [App\Http\Controllers\NotificationsController::class, 'destroy'])->name('notifications.delete');

