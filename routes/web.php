<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FieldWorkerController;
use App\Http\Controllers\ProfileController;
use App\Models\Customer;
use App\Models\FieldWorker;
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
  $pageConfigs = ['myLayout' => 'blank'];
  return view('welcome', ['pageConfigs' => $pageConfigs]);
});

Route::get('/dashboard', function () {

  return view('content.pages.pages-home', [
    'customer_count' => Customer::count(),
    'fieldworkers_count' => FieldWorker::count(),
  ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

  $controller_path = 'App\Http\Controllers';
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::get('/page-2', $controller_path . '\pages\Page2@index')->name('pages-page-2');

  // pages
  Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

  // authentication
  Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
  Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
  Route::resource('customers', CustomerController::class)->names([
    'index' => 'customers',
    'show' => 'customers.show',
    'edit' => 'customers.edit',
    'update' => 'customers.update',
    'destroy' => 'customers.destroy',
    'create' => 'customers.create',
    'store' => 'customers.store',
  ]);
  Route::resource('field-workers', FieldWorkerController::class)->names([
    'index' => 'field-workers',
    'show' => 'field-workers.show',
    'edit' => 'field-workers.edit',
    'update' => 'field-workers.update',
    'destroy' => 'field-workers.destroy',
    'create' => 'field-workers.create',
    'store' => 'field-workers.store',
  ]);
});

require __DIR__ . '/auth.php';
