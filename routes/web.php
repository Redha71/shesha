<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileConteroller;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\IndexController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|Route::get('/', function () {
    return view('welcome');
});
*/


//admin All Route
Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){
    Route::get('/login',[AdminController::class,'loginForm']);
    Route::post('/login',[AdminController::class,'store'])->name('admin.login');
    
});

Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('admin/dashboard', function () { return view('admin.index');})->name('dashboard');
    //Admin All Routes
    Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
    //Admin Profile
    Route::get('/admin/profile',[AdminProfileConteroller::class,'adminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit',[AdminProfileConteroller::class,'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store',[AdminProfileConteroller::class,'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminProfileConteroller::class,'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/change/password',[AdminProfileConteroller::class,'adminUpdateChangePassword'])->name('admin.update.change.password');
    
});

//User All Route
Route::middleware(['auth:sanctum,web',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/dashboard', function () { 
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('dashboard',compact('user'));})->name('user.dashboard');
    Route::get('/user/profile',[IndexController::class,'userProfile'])->name('user.profile');
    Route::post('/user/profile/store',[IndexController::class,'userProfileStore'])->name('user.profile.store');
    Route::get('/user/change/password',[IndexController::class,'userChangePassword'])->name('user.change.password');
    Route::post('/user/password/update',[IndexController::class,'userPasswordUpdate'])->name('user.password.update');
    Route::get('/user/logout',[IndexController::class,'userLogout'])->name('user.logout');
});
Route::get('/',[IndexController::class,'index'])->name('home');


// Admin Brand All Routes
Route::prefix('brand')->group(function(){
    Route::get('/view',[BrandController::class,'brandView'])->name('all.brand');
    Route::post('/store',[BrandController::class,'brandStore'])->name('brand.store');
    Route::get('/edit/{id}',[BrandController::class,'brandEdit'])->name('brand.edit');
    Route::post('/update',[BrandController::class,'brandUpdate'])->name('brand.update');
    Route::get('/delete/{id}',[BrandController::class,'brandDelete'])->name('brand.delete');
});