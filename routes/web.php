<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Admin\AdminController;


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
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
   Route::match(['get','post'],'login','AdminController@login');
   Route::group(['middleware'=>['admin']],function(){
   Route::get('/dashboard','AdminController@dashboard');
   Route::post('/check-current-pwd','AdminController@checkCurrentPassword');
   Route::get('/update-password','AdminController@updatePassword');
   Route::get('/logout','AdminController@logout');

   });
});

//
// Route::get('/dash',function(){
//    return 'Hello world';
// });

// Route::get('admin/dashboard',[AdminController::class,dashboard]);
