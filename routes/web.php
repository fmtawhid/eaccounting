<?php

use App\Http\Controllers\Admin\ExpenseHeadController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PurposeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\BranceController;
use App\Http\Controllers\Admin\AccountController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::prefix('panel')->group(function () {
    Auth::routes();
});


Route::prefix('panel')->middleware(['auth', 'checkRole:admin'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    // Route::get('studentD', [HomeController::class, 'studentD'])->name('studentD');

  
    // Role Routes
    Route::middleware(['permission:role_view'])->get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::middleware(['permission:role_add'])->get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::middleware(['permission:role_add'])->post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::middleware(['permission:role_edit'])->get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::middleware(['permission:role_edit'])->put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::middleware(['permission:role_delete'])->delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Permission Routes
    Route::middleware(['permission:permission_view'])->get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::middleware(['permission:permission_add'])->get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::middleware(['permission:permission_add'])->post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::middleware(['permission:permission_edit'])->get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::middleware(['permission:permission_edit'])->put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::middleware(['permission:permission_delete'])->delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // User Routes
    Route::middleware(['permission:user_view'])->get('/users', [UserController::class, 'index'])->name('users.index');
    Route::middleware(['permission:user_add'])->get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::middleware(['permission:user_add'])->post('/users', [UserController::class, 'store'])->name('users.store');
    Route::middleware(['permission:user_edit'])->get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::middleware(['permission:user_edit'])->put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::middleware(['permission:user_delete'])->delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');



    // 🟢 Expense Head Management Routes with Spatie Permissions
    Route::middleware(['permission:expense_head_view'])->get('/expense_heads', [ExpenseHeadController::class, 'index'])->name('expense_heads.index'); // View Expense Head list
    Route::middleware(['permission:expense_head_add'])->get('/expense_heads/create', [ExpenseHeadController::class, 'create'])->name('expense_heads.create'); // Show form to create Expense Head
    Route::middleware(['permission:expense_head_add'])->post('/expense_heads/store', [ExpenseHeadController::class, 'store'])->name('expense_heads.store'); // Store Expense Head data
    Route::middleware(['permission:expense_head_edit'])->get('/expense_heads/{expense_head}/edit', [ExpenseHeadController::class, 'edit'])->name('expense_heads.edit');
    Route::middleware(['permission:expense_head_edit'])->put('/expense_heads/{expense_head}/update', [ExpenseHeadController::class, 'update'])->name('expense_heads.update');
    Route::middleware(['permission:expense_head_delete'])->delete('/expense_heads/{expense_head}/destroy', [ExpenseHeadController::class, 'destroy'])->name('expense_heads.destroy');

    // 🟢 Purpose Management Routes with Spatie Permissions
    Route::middleware(['permission:purpose_view'])->get('/purposes', [PurposeController::class, 'index'])->name('purposes.index'); // View Purpose list
    Route::middleware(['permission:purpose_add'])->get('/purposes/create', [PurposeController::class, 'create'])->name('purposes.create'); // Show form to create Purpose
    Route::middleware(['permission:purpose_add'])->post('/purposes/store', [PurposeController::class, 'store'])->name('purposes.store'); // Store Purpose data
    Route::middleware(['permission:purpose_edit'])->get('/purposes/{purpose}/edit', [PurposeController::class, 'edit'])->name('purposes.edit'); // Show form to edit Purpose
    Route::middleware(['permission:purpose_edit'])->put('/purposes/{purpose}/update', [PurposeController::class, 'update'])->name('purposes.update');
    Route::middleware(['permission:purpose_delete'])->delete('/purposes/{id}/destroy', [PurposeController::class, 'destroy'])->name('purposes.destroy'); // Delete Purpose


    // 🟢 Expense Management Routes with Spatie Permissions
    // Route::middleware(['permission:expense_view|expense_add'])->get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index'); // View Expense list
    // 🟢 Expense Management Routes with Spatie Permissions
    Route::middleware(['permission:expense_add|expense_view'])->get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index'); // View Expense list

    Route::middleware(['permission:expense_add'])->get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create'); // Show form to create Expense
    Route::middleware(['permission:expense_add'])->post('/expenses/store', [ExpenseController::class, 'store'])->name('expenses.store'); // Store Expense data
    Route::middleware(['permission:expense_edit'])->get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit'); // Show form to edit Expense
    Route::middleware(['permission:expense_edit'])->put('/expenses/{expense}/update', [ExpenseController::class, 'update'])->name('expenses.update'); // Update Expense data
    Route::middleware(['permission:expense_delete'])->delete('/expenses/{expense}/destroy', [ExpenseController::class, 'destroy'])->name('expenses.destroy'); // Delete Expense
    Route::get("expense/report", [ExpenseController::class, 'export_report'])->name('expense.report');

    Route::get('/accounts-by-branch/{brance_id}', [ExpenseController::class, 'getAccountsByBrance'])->name('accounts.by.branch');


    // 🟢 Payment Management Routes with Spatie Permissions
    Route::middleware(['permission:payment_view|payment_add'])->get('/payments', [PaymentController::class, 'index'])->name('payments.index'); // View Payment list
    Route::middleware(['permission:payment_add'])->post('/payments/store', [PaymentController::class, 'store'])->name('payments.store'); // Store Payment data
    Route::middleware(['permission:payment_edit'])->get('/payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit'); // Show form to edit Payment
    Route::middleware(['permission:payment_edit'])->put('/payments/{payment}/update', [PaymentController::class, 'update'])->name('payments.update');
    Route::middleware(['permission:payment_delete'])->delete('/payments/{payment}/destroy', [PaymentController::class, 'destroy'])->name('payments.destroy'); // Delete Payment


    Route::get("payments/report", [PaymentController::class, 'payment_report'])->name('payments.report');


    Route::get('expenses/{expense}/attachments', [ExpenseController::class, 'getAttachments'])->name('expenses.attachments');
    Route::get('payments/{payment}/attachments', [PaymentController::class, 'getAttachments'])->name('payments.attachments');


    Route::get('expenses/export/excel', [ExpenseController::class, 'exportExcel'])->name('expenses.export.excel');
    Route::get('expenses/export/pdf', [ExpenseController::class, 'exportPDF'])->name('expenses.export.pdf');


    Route::get('payments/export/excel', [PaymentController::class, 'exportExcel'])->name('payments.export.excel');
    Route::get('payments/export/pdf', [PaymentController::class, 'exportPDF'])->name('payments.export.pdf');


    Route::middleware(['permission:setting_view'])->resource('setting', SettingController::class);

    Route::post('/change-password', [SettingController::class, 'changePassword'])->name('password.change');





    // 🟢 Brance Management Routes with Spatie Permissions
    Route::middleware(['permission:brance_view|brance_add'])->get('/brances', [BranceController::class, 'index'])->name('brances.index');
    Route::middleware(['permission:brance_add'])->post('/brances/store', [BranceController::class, 'store'])->name('brances.store');
    Route::middleware(['permission:brance_edit'])->get('/brances/{brance}/edit', [BranceController::class, 'edit'])->name('brances.edit');
    Route::middleware(['permission:brance_edit'])->put('/brances/{brance}/update', [BranceController::class, 'update'])->name('brances.update');
    Route::middleware(['permission:brance_delete'])->delete('/brances/{brance}/destroy', [BranceController::class, 'destroy'])->name('brances.destroy');
  

    // 🟢 Account Management Routes
    Route::middleware(['permission:account_view|account_add'])->get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::middleware(['permission:account_add'])->get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
    Route::middleware(['permission:account_add'])->post('/accounts/store', [AccountController::class, 'store'])->name('accounts.store');
    Route::middleware(['permission:account_edit'])->get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
    Route::middleware(['permission:account_edit'])->put('/accounts/{account}/update', [AccountController::class, 'update'])->name('accounts.update');
    Route::middleware(['permission:account_delete'])->delete('/accounts/{account}/destroy', [AccountController::class, 'destroy'])->name('accounts.destroy');


});