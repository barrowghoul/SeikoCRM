<?php

use App\Http\Controllers\BranchOfficeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\ProspectController;
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

//Route::resource('diagnostics', DiagnosticController::class)->names('diagnostics');
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users', UserController::class)->names('users');
    Route::get('suspend/{user_id}', [UserController::class, 'suspend'])->name('user.suspend');
    Route::get('activate/{user_id}', [UserController::class, 'activate'])->name('user.activate');
    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('customers', CustomerController::class)->names('customers');
    Route::resource('prospects', ProspectController::class)->names('prospects');
    Route::resource('branches', BranchOfficeController::class)->names('branches');
    Route::resource('diagnostics', DiagnosticController::class)->names('diagnostics')->except('create');
    Route::get('diagnostics/create/{customer_id}', [DiagnosticController::class, 'create'])->name('diagnostics.create');
    Route::get('convert2client/{customer_id}', [BranchOfficeController::class, 'new'])->name('client.new');
    Route::get('approvecustomer/{customer_id}', [CustomerController::class, 'approve'])->name('client.approve');
    Route::get('approveprospect/{prospect_id}', [ProspectController::class, 'approve'])->name('prospect.approve');
    Route::get('approvediagnostic/{diagnostic_id}', [DiagnosticController::class, 'approve'])->name('diagnostic.approve');
    Route::post('rejectprospect', [ProspectController::class, 'reject'])->name('prospect.reject');
    Route::post('contactcustomer', [ProspectController::class, 'contact'])->name('prospect.contact');
    Route::post('reasignprospect', [ProspectController::class, 'reasign'])->name('prospect.reasign');
    Route::post('rejectdiagnostic', [DiagnosticController::class, 'reject'])->name('diagnostic.reject');
});

