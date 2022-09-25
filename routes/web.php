<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\MasterControllers;
use App\Http\Controllers\SalesControllers;
use App\Http\Controllers\PaymentControllers;
use App\Http\Controllers\CourierControllers;
use App\Http\Controllers\ProductControllers;

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
    Route::get('/',[HomeControllers::class,'index']);
    Route::get('/invoice',[HomeControllers::class,'listInvoice']);
    Route::post('/invoice/save',[HomeControllers::class,'saveInvoice']);
    Route::post('/invoice/form',[HomeControllers::class,'formInvoice']);
    Route::post('/invoice/update',[HomeControllers::class,'updateInvoice']);
    Route::post('/invoice/detail',[HomeControllers::class,'detailInvoice']);
    Route::post('/invoice/detail/save',[HomeControllers::class, 'detailSave']);



/**
*
* List Product 
*
*/

    Route::get('/product',[ProductControllers::class,'getProduct']);
    Route::post('/save-product',[ProductControllers::class,'saveProduct']);




    /***
     * 
     * Sales CRUD
     */
    Route::get('/sales',[SalesControllers::class,'getSales']);
    Route::post('/save-sales',[SalesControllers::class,'saveSales']);
    Route::post('/delete-sales',[SalesControllers::class,'deleteSales']);
    Route::get('/sales/{id}',[SalesControllers::class,'edit']);
    Route::post('/sales/update',[SalesControllers::class,'update']);


    /***
     * 
     * Payment CRUD
     */
    Route::get('/payment',[PaymentControllers::class,'getPayment']);
    Route::post('/save-payment',[PaymentControllers::class,'savePayment']);
    Route::post('/delete-payment',[PaymentControllers::class,'deletePayment']);
    Route::get('/payment/{id}',[PaymentControllers::class,'edit']);
    Route::post('/payment/update',[PaymentControllers::class,'update']);


    /***
     * 
     * Courier CRUD
     */
    Route::get('/courier',[CourierControllers::class,'getcourier']);
    Route::post('/save-courier',[CourierControllers::class,'saveCourier']);
    Route::post('/delete-courier',[CourierControllers::class,'deleteCourier']);
    Route::get('/courier/{id}',[CourierControllers::class,'edit']);
    Route::post('/courier/update',[CourierControllers::class,'update']);





