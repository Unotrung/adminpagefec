<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Middleware;
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
if(env("ROUTER_ENV") != 'dev'){
    URL::forceScheme('https');
}
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
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee');
Route::get('/employee/dtajax', [App\Http\Controllers\EmployeeController::class, 'dtajax'])->name('employee.dtajax');
Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
Route::get('/employee/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
//Users
// Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('team');
// Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('user.edit');
// Route::post('/users/assign', ['UsersController@assign'])->name('user.assign');
Route::group(['middleware' => ['role:super admin']], function (){
    Route::post('/users/assignrole', [App\Http\Controllers\UsersController::class, 'assignRole'])->name('user.assignrole');
    Route::post('/users/removerole', [App\Http\Controllers\UsersController::class, 'removeRole'])->name('user.removerole');
});

Route::post('/modules/givepermission', [App\Http\Controllers\ModuleController::class, 'givePermissionTo'])->name('modules.givepermission');
Route::post('/modules/getAllPermissions', [App\Http\Controllers\ModuleController::class, 'getAllPermissions'])->name('modules.getAllPermissions');
Route::get('/account/show', function(){
    return view('vendor.adminlte.account.show');
});
Route::get('/account/change', function(){
    return view('vendor.adminlte.account.change');
});
//Configuration
Route::get('/configuration/index', [App\Http\Controllers\ConfigurationController::class, 'index'])->name('configuration.index');
Route::get('/configuration/add', [App\Http\Controllers\ConfigurationController::class, 'create'])->name('configuration.add');
Route::post('/configuration/store', [App\Http\Controllers\ConfigurationController::class, 'store'])->name('configuration.store');
Route::post('/configuration/index/status/update', [App\Http\Controllers\ConfigurationController::class, 'updateStatus'])->name('configuration.update.status');
Route::post('/configuration/index/status/approval', [App\Http\Controllers\ConfigurationController::class, 'approvalStatus'])->name('configuration.update.approval');
Route::post('/configuration/index/status/reject', [App\Http\Controllers\ConfigurationController::class, 'rejectStatus'])->name('configuration.update.reject');
//BNPL
Route::group(['middleware' => ['role:System Admin|Website Admin|super admin']], function (){
    Route::group(['middleware' => ['permission:bnpl-update']], function () {
        // Route::get('/bnpl/edit', [App\Http\Controllers\BnplController::class, 'edit'])->name('bnpl.edit');
        Route::get('/bnpl/edit/{id}', [App\Http\Controllers\BnplController::class, 'edit'])->name('bnpl.edit');
    });
    Route::group(['middleware' => ['permission:bnpl-view']], function () {
        Route::get('/bnpl', [App\Http\Controllers\BnplController::class, 'index'])->name('bnpl');
        Route::get('/bnpl/dtajax', [App\Http\Controllers\BnplController::class, 'dtajax'])->name('bnpl.dtajax');
    });
});

//Customer
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function (){
    Route::group(['middleware' => ['permission:customers-update']], function () {
        Route::get('/customer/add', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.add');
        Route::post('/customer/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
    });
    Route::group(['middleware' => ['permission:customers-view']], function () {
        Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
        //Route::get('/customer/show', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show');
        Route::get('/customer/show/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show');
        Route::get('/customer/show/{id}/{bnpl}', [App\Http\Controllers\CustomerController::class, 'show'])->name('customer.show2');
        Route::get('/customer/dtajax', [App\Http\Controllers\CustomerController::class, 'dtajax'])->name('customer.dtajax');
    });
});



//Users
// Route::get('/users/index', 'App\Http\Controllers\UsersController@index')->name('users.index');
// Route::group(['middleware' => ['can:create users,delete users']], function (){
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin','permission:users-update']], function () {
    //Route::get('/users/edit', [App\Http\Controllers\UsersController::class,'edit'])->name('users.edit');
    Route::get('/users/edit/{id}', [App\Http\Controllers\UsersController::class,'edit'])->name('users.edit');
    Route::post('/users/store', [App\Http\Controllers\UsersController::class,'store'])->name('users.store');
    Route::post('/users/update', [App\Http\Controllers\UsersController::class,'update'])->name('users.update');
        
});
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin','permission:users-view']], function () {
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
    //Route::get('/users/show', [App\Http\Controllers\UsersController::class,'show'])->name('users.show');
    Route::get('/users/show/{id}', [App\Http\Controllers\UsersController::class,'show'])->name('users.show');
    Route::get('/users/dtajax', [App\Http\Controllers\UsersController::class, 'dtajax'])->name('users.dtajax');
    Route::get('/users/create', [App\Http\Controllers\UsersController::class,'create'])->name('users.create');
});

// Permissions
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function () {
    Route::group(['middleware' => ['permission:permission-update']], function () {
        Route::get('/permission/add', [App\Http\Controllers\PermissionsController::class,'create'])->name('permission.add');
        // Route::get('/permission/edit',[App\Http\Controllers\PermissionsController::class,'edit'])->name('permission.edit');
        Route::get('/permission/edit/{id}',[App\Http\Controllers\PermissionsController::class,'edit'])->name('permission.edit');
        Route::post('/permission/store', [App\Http\Controllers\PermissionsController::class,'store'])->name('permission.store');
        Route::post('/permission/update', [App\Http\Controllers\PermissionsController::class,'update'])->name('permission.update');
    });
    Route::group(['middleware' => ['permission:permission-view']], function () {
        Route::get('/permission/index', [App\Http\Controllers\PermissionsController::class,'index'])->name('permission.index');
        Route::get('/permission/dtajax', [App\Http\Controllers\PermissionsController::class, 'dtajax'])->name('permission.dtajax');
        Route::post('/permission/delete', [App\Http\Controllers\PermissionsController::class, 'destroy'])->name('permission.delete');
    });
});

//Roles
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function () {
    Route::group(['middleware' => ['permission:roles-update']], function () {
        Route::get('/roles/add', [App\Http\Controllers\RolesController::class, 'create'])->name('roles.add');
        Route::get('/roles/edit/{id}', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
        // Route::get('/roles/edit/editajax', [App\Http\Controllers\RolesController::class, 'editajax'])->name('roles.edit.editajax');
        // Route::get('/roles/edit', [App\Http\Controllers\RolesController::class, 'edit'])->name('roles.edit');
        Route::post('/roles/store', [App\Http\Controllers\RolesController::class, 'store'])->name('roles.store');
        Route::post('/roles/update', [App\Http\Controllers\RolesController::class, 'update'])->name('roles.update');
    });
    Route::group(['middleware' => ['permission:roles-view']], function () {
        Route::get('/roles/index', [App\Http\Controllers\RolesController::class, 'index'])->name('roles.index');
        Route::get('/roles/dtajax', [App\Http\Controllers\RolesController::class, 'dtajax'])->name('roles.dtajax');
    });
});

//Department
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function () {
    Route::group(['middleware' => ['permission:department-update']], function () {
        //Route::get('/department/edit', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
        Route::get('/department/edit/{id}', [App\Http\Controllers\DepartmentController::class, 'edit'])->name('department.edit');
        Route::get('/department/add', [App\Http\Controllers\DepartmentController::class, 'create'])->name('department.add');
        Route::post('/department/update', [App\Http\Controllers\DepartmentController::class, 'update'])->name('department.update');
        Route::post('/department/store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
    });
    Route::group(['middleware' => ['permission:department-view']], function () {
        Route::get('/department/index', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
        //Route::get('/department/show', [App\Http\Controllers\DepartmentController::class,'show'])->name('department.show');
        Route::get('/department/show/{id}', [App\Http\Controllers\DepartmentController::class,'show'])->name('department.show');
        Route::get('/department/dtajax', [App\Http\Controllers\DepartmentController::class, 'dtajax'])->name('department.dtajax');
    });
});

//FAQs
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function () {
    Route::group(['middleware' => ['permission:faqs-update']], function () {
        Route::get('/faqs/edit', [App\Http\Controllers\FaqController::class, 'edit'])->name('faqs.edit');
        Route::get('/faqs/edit/{id}', [App\Http\Controllers\FaqController::class, 'edit'])->name('faqs.edit');
        Route::get('/faqs/add', [App\Http\Controllers\FaqController::class, 'create'])->name('faqs.add');
        Route::post('/faqs/update', [App\Http\Controllers\FaqController::class, 'update'])->name('faqs.update');
        Route::post('/faqs/store', [App\Http\Controllers\FaqController::class, 'store'])->name('faqs.store');
    });
    Route::group(['middleware' => ['permission:faqs-view']], function () {
        Route::get('/faqs/index', [App\Http\Controllers\FaqController::class, 'index'])->name('faqs.index');
        Route::get('/faqs/show', [App\Http\Controllers\FaqController::class, 'show'])->name('faqs.show');
        Route::get('/faqs/show/{id}', [App\Http\Controllers\FaqController::class, 'show'])->name('faqs.show');
        Route::get('/faqs/dtajax', [App\Http\Controllers\FaqController::class, 'dtajax'])->name('faqs.dtajax');
    });
});
//Promotions
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function () {
    Route::group(['middleware' => ['permission:promotions-update']], function () {
        //Route::get('/promotions/edit', [App\Http\Controllers\PromotionsController::class, 'edit'])->name('promotions.edit');
        Route::get('/promotions/edit/{id}', [App\Http\Controllers\PromotionsController::class, 'edit'])->name('promotions.edit');
        Route::get('/promotions/add', [App\Http\Controllers\PromotionsController::class, 'create'])->name('promotions.add');
        Route::post('/promotions/update', [App\Http\Controllers\PromotionsController::class, 'update'])->name('promotions.update');
        Route::post('/promotions/store', [App\Http\Controllers\PromotionsController::class, 'store'])->name('promotions.store');
    });
    Route::group(['middleware' => ['permission:promotions-view']], function () {
        Route::get('/promotions/index', [App\Http\Controllers\PromotionsController::class, 'index'])->name('promotions.index');
        //Route::get('/promotions/show', [App\Http\Controllers\PromotionsController::class, 'show'])->name('promotions.show');
        Route::get('/promotions/show/{id}', [App\Http\Controllers\PromotionsController::class, 'show'])->name('promotions.show');
        Route::get('/promotions/dtajax', [App\Http\Controllers\PromotionsController::class, 'dtajax'])->name('promotions.dtajax');
    });
});
//News
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function () {
    Route::group(['middleware' => ['permission:news-update']], function () {
        Route::get('/news/add', [App\Http\Controllers\NewsController::class, 'create'])->name('news.add');
        Route::post('/news/store', [App\Http\Controllers\NewsController::class, 'store'])->name('news.store');
        // Route::get('/news/edit', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
        Route::get('/news/edit/{id}', [App\Http\Controllers\NewsController::class, 'edit'])->name('news.edit');
        Route::post('/news/update', [App\Http\Controllers\NewsController::class, 'update'])->name('news.update');
    });
    Route::group(['middleware' => ['permission:news-view']], function () {
        Route::get('/news/index', [App\Http\Controllers\NewsController::class, 'index'])->name('news.index');
        Route::get('/news/dtajax', [App\Http\Controllers\NewsController::class, 'dtajax'])->name('news.dtajax');
        Route::get('/news/show/{id}', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
        //Route::get('/news/show', [App\Http\Controllers\NewsController::class, 'show'])->name('news.show');
    });
});
//Notifications
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function () {
    Route::group(['middleware' => ['permission:notifications-update']], function () {
        Route::get('/notifications/add', [App\Http\Controllers\NotificationsController::class, 'create'])->name('notifications.add');
        Route::post('/notifications/store', [App\Http\Controllers\NotificationsController::class, 'store'])->name('notifications.store');
        //Route::get('/notifications/edit', [App\Http\Controllers\NotificationsController::class, 'edit'])->name('notifications.edit');
        Route::get('/notifications/edit/{id}', [App\Http\Controllers\NotificationsController::class, 'edit'])->name('notifications.edit');
        Route::post('/notifications/update', [App\Http\Controllers\NotificationsController::class, 'update'])->name('notifications.update');

    });
    Route::group(['middleware' => ['permission:notifications-view']], function () {
        Route::get('/notifications/index', [App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/dtajax', [App\Http\Controllers\NotificationsController::class, 'dtajax'])->name('notifications.dtajax');
        //Route::get('/notifications/show', [App\Http\Controllers\NotificationsController::class, 'show'])->name('notifications.show');
        Route::get('/notifications/show/{id}', [App\Http\Controllers\NotificationsController::class, 'show'])->name('notifications.show');
    });
    
});
//Sending Email
Route::get('sendtxtmail','App\Http\Controllers\MailController@txt_mail')->name('sendtxtmail');
Route::get('sendhtmlmail','App\Http\Controllers\MailController@html_mail');
Route::get('sendattachedemail','App\Http\Controllers\MailController@attached_email');
Route::get('sendemail','App\Http\Controllers\MailController@mailTemplate')->name('sendemail');


//Account
Route::post('/account/update', [App\Http\Controllers\AccountController::class,'update'])->name('account.update');
Route::get('/account/show', [App\Http\Controllers\AccountController::class,'show'])->name('account.show');

//Modules
Route::group(['middleware' => ['role:super admin|System Admin|Website Admin']], function () {
    Route::group(['middleware' => ['permission:modules-update']], function () {
        Route::get('/modules/add', [App\Http\Controllers\ModuleController::class, 'create'])->name('modules.add');
        Route::get('/modules/edit/{id}', [App\Http\Controllers\ModuleController::class, 'edit'])->name('modules.edit');
        //Route::get('/modules/edit', [App\Http\Controllers\ModuleController::class, 'edit'])->name('modules.edit');
        Route::post('/modules/update', [App\Http\Controllers\ModuleController::class, 'update'])->name('modules.update');
        Route::post('/modules/store', [App\Http\Controllers\ModuleController::class, 'store'])->name('modules.store');
        
    });
    Route::group(['middleware' => ['permission:modules-view']], function () {
        Route::get('/modules/dtajax', [App\Http\Controllers\ModuleController::class, 'dtajax'])->name('modules.dtajax');
        Route::get('modules/index',[App\Http\Controllers\ModuleController::class, 'index'])->name('modules.index');
        Route::get('/modules/show/{id}', [App\Http\Controllers\ModuleController::class, 'show'])->name('modules.show');
        //Route::get('/modules/show', [App\Http\Controllers\ModuleController::class, 'show'])->name('modules.show');
    });
});

Route::group(['middleware' => ['role:super admin']], function () {
    Route::group(['middleware' => ['permission:providers-delete']], function () {
        Route::post('/providers/delete', [App\Http\Controllers\ProviderController::class, 'destroy'])->name('providers.delete');
    });
    Route::group(['middleware' => ['permission:notifications-delete']], function () {
        Route::post('/notifications/delete', [App\Http\Controllers\NotificationsController::class, 'destroy'])->name('notifications.delete');
    });
    Route::group(['middleware' => ['permission:news-delete']], function () {
        Route::post('/news/delete', [App\Http\Controllers\NewsController::class, 'destroy'])->name('news.delete');
    });
    Route::group(['middleware' => ['permission:promotions-delete']], function () {
        Route::post('/promotions/delete', [App\Http\Controllers\PromotionsController::class, 'destroy'])->name('promotions.delete');
    });
    Route::group(['middleware' => ['permission:customer-delete']], function () {
        Route::post('/customer/delete', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.delete');
    });
    Route::group(['middleware' => ['permission:faqs-delete']], function () {
        Route::post('/faqs/delete', [App\Http\Controllers\FaqController::class, 'destroy'])->name('faqs.delete');
    });
    Route::group(['middleware' => ['permission:department-delete']], function () {
        Route::get('/department/delete/{id}', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('department.delete');
    });
    Route::group(['middleware' => ['permission:roles-delete']], function () {
        Route::post('/roles/delete', [App\Http\Controllers\RolesController::class, 'destroy'])->name('roles.delete');
    });
    Route::group(['middleware' => ['permission:users-delete']], function () {
        Route::post('/users/delete', [App\Http\Controllers\UsersController::class, 'destroy'])->name('users.delete');
        Route::post('/users/restore', [App\Http\Controllers\UsersController::class, 'restore'])->name('users.restore');
    });
});

//Providers
Route::group(['middleware' => ['role:System Admin|Website Admin|super admin']], function () {
    Route::group(['middleware' => ['permission:providers-view']], function () {
        Route::get('/providers/index', [App\Http\Controllers\ProviderController::class, 'index'])->name('providers.index');
        Route::get('/providers/show', [App\Http\Controllers\ProviderController::class, 'show'])->name('providers.show');
        Route::get('/providers/show/{id}', [App\Http\Controllers\ProviderController::class, 'show'])->name('providers.show');
        Route::get('/providers/dtajax', [App\Http\Controllers\ProviderController::class, 'dtajax'])->name('providers.dtajax');
    });
    Route::group(['middleware' => ['permission:providers-update']], function () {
        Route::get('/providers/add', [App\Http\Controllers\ProviderController::class, 'create'])->name('providers.add');
        Route::post('/providers/store', [App\Http\Controllers\ProviderController::class, 'store'])->name('providers.store');
        Route::get('/providers/edit', [App\Http\Controllers\ProviderController::class, 'edit'])->name('providers.edit');
        Route::get('/providers/edit/{id}', [App\Http\Controllers\ProviderController::class, 'edit'])->name('providers.edit');
        Route::post('/providers/update', [App\Http\Controllers\ProviderController::class, 'update'])->name('providers.update');
    });

});
