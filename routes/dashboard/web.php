<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\WelcomController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\productController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\Client\OrderController;

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
   Route::get('/',[WelcomController::class,'index'])->name('welcome');

     ############## Start user Routes  ###############
            Route::resource('users',UserController::class)->except(['show']);
    ############## End user Routes  ###############

     ############## Start category Routes  ###############
     Route::resource('categories',CategoryController::class)->except(['show']);
     ############## End category Routes  ###############
 
     ############## Start Product Routes  ###############
     Route::resource('products',productController::class)->except(['show']);
     ############## End Product Routes  ###############
 
     ############## Start Clients Routes  ###############
     Route::resource('clients',ClientController::class)->except(['show']);
     Route::resource('clients.orders',OrderController::class)->except(['show']);
     ############## End Clients Routes  ###############

 




      });
});
