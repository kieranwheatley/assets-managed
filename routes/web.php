<?php

use App\Models\HardwareAssets;
use App\Models\SoftwareAssets;
use App\Models\TestAssets;
use App\Models\User;
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
    return view('dashboard',['users' => App\Models\User::all()]);
});

Route::get('/dashboard', function () {
    return view('dashboard',['users' => App\Models\User::all(),'user_count' => User::count(), 'software_count' => SoftwareAssets::count(), 'hardware_count' => HardwareAssets::count()]);
});

Route::get('/users', function () {
    return view('users',['users' => App\Models\User::all()]);
});

Route::get('/assets', function () {
    return view('assets',['assets' => App\Models\Asset::all()]);
});

Route::get('/software', function () {
    return view('software',['software' => SoftwareAssets::all()]);
});

Route::get('/hardware', function () {
    return view('hardware',['hardware' => HardwareAssets::all()]);
});
