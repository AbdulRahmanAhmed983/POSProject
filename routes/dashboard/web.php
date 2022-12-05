<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\productController;

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

Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect','localizationRedirect','localeViewPath']],
function(){


Route::prefix('dashboard')->name('dashboard.')->group(function(){
   Route::get('/index',[DashboardController::class,'index'])->name('index');

     ############## Start user Routes  ###############
            Route::resource('users',UserController::class)->except(['show']);
    ############## End user Routes  ###############

     ############## Start category Routes  ###############
     Route::resource('categories',CategoryController::class)->except(['show']);
     ############## End category Routes  ###############
 
     ############## Start Product Routes  ###############
     Route::resource('products',productController::class)->except(['show']);
     ############## End Product Routes  ###############
 




      });
});
