<?php

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



Route::post('/import_excel/import', 'LeadsController@import');

Route::resource('leads', 'LeadsController');
Route::post('leads/update', 'LeadsController@update')->name('leads.update');
Route::get('leads/destroy/{id}', 'LeadsController@destroy');
Route::get('leads/show/{id}', 'LeadsController@show');

Route::resource('shippings', 'ShippingController');
Route::post('shippings/update', 'ShippingController@update')->name('shippings.update');
Route::get('shippings/destroy/{id}', 'ShippingController@destroy');
Route::get('shippings/show/{id}', 'ShippingController@show');

Auth::routes();
Route::get('/', 'HomeController@index')->name('leads');
Route::get('/home', 'HomeController@home')->name('home');


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function (){
    Route::resource('/users','UsersController');
});

Route::get('/export_excel/excel', 'ExportExcelController@leadexcel')->name('export_excel.leadexcel');
Route::get('/export_excel/excel1', 'ExportExcelController@shippingexcel')->name('export_excel.shippingexcel');


