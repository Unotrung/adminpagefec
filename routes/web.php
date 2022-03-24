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
Route::get('/customer/dtajax', [App\Http\Controllers\CustomerController::class, 'dtajax'])->name('customer.dtajax');
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
Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('team');
Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('user.edit');
Route::post('/users/assign', ['UsersController@assign'])->name('user.assign');


Route::get('/account/show', function(){
    return view('vendor.adminlte.account.show');
});
Route::get('/account/change', function(){
    return view('vendor.adminlte.account.change');
});
//Em
//Users
Route::get('/users/index', 'App\Http\Controllers\UsersController@index')->name('users.index');
Route::group(['middleware' => ['can:create users,delete users']], function (){
    Route::get('/users/create', 'App\Http\Controllers\UsersController@create')->name('users.create');
    Route::get('/users/edit/{id}', 'App\Http\Controllers\UsersController@edit')->name('users.edit');
    Route::post('/users/store', 'App\Http\Controllers\UsersController@store')->name('users.store');
    Route::post('/users/update', 'App\Http\Controllers\UsersController@update')->name('users.update');
 });

// Permissions
Route::group(['middleware' => ['can:full access permissions']], function () {
    Route::get('/permission/index', 'App\Http\Controllers\PermissionsController@index')->name('permission.index');
    Route::get('/permission/add', 'App\Http\Controllers\PermissionsController@create')->name('permission.add');
    Route::get('/permission/edit/{id}','App\Http\Controllers\PermissionsController@edit')->name('permission.edit');
    Route::post('/permission/store', 'App\Http\Controllers\PermissionsController@store')->name('permission.store');
    Route::post('/permission/update', 'App\Http\Controllers\PermissionsController@update')->name('permission.update');
});

//Roles
Route::group(['middleware' => ['can:full access roles']], function (
) {
    Route::get('/roles/add', [App\Http\Controllers\RolesController::class, 'create'])->name('roles.add');
    Route::get('/roles/index', [App\Http\Controllers\RolesController::class, 'index'])->name('roles.index');
    Route::post('/roles/store', [App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update', [App\Http\Controllers\RolesController::class, 'update'])->name('roles.update');
});

//Department
Route::get('/department/index', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
Route::group(['middleware' => ['can:full access roles']], function () {
    Route::get('/department/edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
    Route::get('/department/add', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.add');
    Route::post('/department/update', [App\Http\Controllers\DepartmentController::class, 'update'])->name('department.update');
    Route::post('/department/store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
});

//FAQs
Route::get('/faqs/index', [App\Http\Controllers\FaqController::class, 'index'])->name('FAQs.index');

//Promotions
Route::get('/promotions/index', [App\Http\Controllers\PromotionsController::class, 'index'])->name('promotions.index');

//News
Route::get('/news/index', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');

//Notifications
Route::get('/notifications/index', [App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications.index');

