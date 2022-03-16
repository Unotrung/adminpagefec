<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
Route::get('/bnpl', [App\Http\Controllers\BnplController::class, 'index'])->name('bnpl');
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::get('/employee/dtajax', [App\Http\Controllers\EmployeeController::class, 'dtajax'])->name('employee.dtajax');
Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::get('/bnpl/edit/{id}', [App\Http\Controllers\BnplController::class, 'edit'])->name('bnpl.bnpledit');
Route::get('/employee/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
// Route::get('/employee/show', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
Route::get('/employee/show/{id}', [App\Http\Controllers\EmployeeController::class, 'show'])->name('employee.show');
Route::get('/users', [App\Http\Controllers\TeamController::class, 'index'])->name('team');
Route::get('/account/show', function(){
    return view('vendor.adminlte.account.show');
});
Route::get('/account/change', function(){
    return view('vendor.adminlte.account.change');
});
// Permissions
Route::get('/permission/index', [App\Http\Controllers\PermissionsController::class, 'index'])->name('permission.index');
Route::get('/permission/add', [App\Http\Controllers\PermissionsController::class, 'create'])->name('permission.add');
Route::get('/permission/edit/{id}', [App\Http\Controllers\PermissionsController::class, 'edit'])->name('permission.edit');
Route::post('/permission/store', [App\Http\Controllers\PermissionsController::class, 'store'])->name('permission.store');
Route::post('/permission/update', [App\Http\Controllers\PermissionsController::class, 'update'])->name('permission.update');

//Roles
Route::get('/roles/index', [App\Http\Controllers\RolesController::class, 'index'])->name('roles.index');
Route::get('/roles/add', [App\Http\Controllers\RolesController::class, 'create'])->name('roles.add');
Route::get('/roles/edit/{id}', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
Route::post('/roles/store', [App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
Route::post('/roles/update', [App\Http\Controllers\RolesController::class, 'update'])->name('roles.update');

//Department
Route::get('/department/index', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
Route::get('/department/add', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.add');
Route::get('/department/edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
Route::post('/department/store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
Route::post('/department/update', [App\Http\Controllers\DepartmentController::class, 'update'])->name('department.update');

