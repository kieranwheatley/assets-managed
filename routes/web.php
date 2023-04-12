<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HardwareAssetsController;
use App\Models\HardwareAssets;
use App\Models\SoftwareAssets;
use App\Models\TestAssets;
use App\Models\User;
use App\Http\Controllers\usersController;
use App\Models\Locations;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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


Route::get('/approval', function () {
    return view ('approval');
})->name('approval')->middleware('auth');



Route::get('/', function () {
    return redirect('/dashboard');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard', ['users' => App\Models\User::all(), 
    'user_count' => User::count(), 
    'software_count' => SoftwareAssets::count(), 
    'hardware_count' => HardwareAssets::count(), 
    'hardware' => HardwareAssets::all(),
    'unencrypted' => HardwareAssets::where('encryption_status', '=', 'Not Encrypted')->count()]);
})->name('home')->middleware('auth');

Route::get('/users', function () {
    return view('users', ['users' => App\Models\User::all()]);
})->name('users')->middleware('auth');

Route::get('/assets', function () {
    return view('assets', ['assets' => App\Models\Asset::all()]);
})->name('assets')->middleware('auth');

Route::get('/software', function () {
    return view('software', ['software' => SoftwareAssets::all()]);
})->name('software')->middleware('auth');

Route::get('/hardware', function () {
    return view('hardware', ['hardware' => HardwareAssets::all()]);
})->name('hardware')->middleware('auth');

Route::get('user-edit/{id}', 'App\Http\Controllers\usersController@edit');

Route::put('update-user/{id}', 'App\Http\Controllers\usersController@update');

Route::get('hardware-edit/{id}', [HardwareAssetsController::class, 'edit']);

Route::put('update-hardware/{id}', [HardwareAssetsController::class, 'update']);

Route::get('hardware/add', [HardwareAssetsController::class, 'create']);

Route::post('insert-hardware', [HardwareAssetsController::class, 'insert']);

Route::get('users/add', [usersController::class, 'add']);

Route::post('insert-user', [usersController::class, 'insert']);

Route::get('hardware-delete/{id}', [HardwareAssetsController::class, 'remove']);

Route::get('/locations', function () {
    return view('locations', ['locations' => App\Models\Locations::all()]);
})->name('locations')->middleware('auth');

Route::get('locations-add', function () {
    return view('locations-add');
})->name('locations-add')->middleware('auth');

Route::post('insert-location', 'App\Http\Controllers\LocationsController@insert');

Route::get('/companies', function () {
    return view('companies', ['companies' => App\Models\Companies::all()]);
})->name('companies')->middleware('auth');

Route::get('companies-add', function () {
    return view('companies-add');
})->name('companies-add')->middleware('auth');

Route::post('insert-company', 'App\Http\Controllers\CompaniesController@insert');
