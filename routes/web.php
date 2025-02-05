<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PrintersController;
use App\Http\Controllers\PrintQueueController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TableHasOrderController;
use App\Http\Controllers\TableHasProductController;
use App\Http\Controllers\TableHasServiceController;
use App\Models\printQueue;
use App\Models\tableHasProduct;
use App\Models\tableHasService;
use Illuminate\Support\Facades\Route;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

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


Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('/', function () {

        if(!is_null(auth()->user()->role_id)){
            if(auth()->user()->role_id == 3){
                return redirect(route('admin.employees.index'));
            }else{

                return redirect(route('admin.dashboard'));
            }
        }
        return redirect(route('login'));
    })->name('dashboard');



});

    Route::get('gotable/{table_id}',[TableController::class, 'findTheTable']);
    Route::post('addtocart',[TableHasProductController::class,'store'])->name('addtocart');


    Route::post('orders',[TableHasProductController::class, 'OrderedProducts'])->name('orders');

    Route::post('updateTableProduct',[TableHasProductController::class,'update'])->name('updateTableProduct');

    Route::post('tableOrderStore',[TableHasOrderController::class, 'store'])->name('tableOrderStore');

    Route::post('deleteOrder',[TableHasProductController::class,'deleteProductAndUpdateLimit'])->name('deleteOrder');

    Route::post('bills',[TableController::class,'tableBill'])->name('bills');

    Route::get('/print-order-kitchen',[PrintersController::class,'printOrderKitchen'])->name('print-order-kitchen');

    Route::post('/need-service',[TableHasServiceController::class,'store'])->name('need-service');
    Route::get('/need-service',[TableHasServiceController::class,'index'])->name('need-service-get');
    Route::post('/remove-service/{id}',[TableHasServiceController::class,'destroy'])->name('remove-service');


    Route::post('/print-queue',[PrintQueueController::class,'store'])->name('print-queue');
    Route::get('/print-memo',[PrintQueueController::class,'index'])->name('print-memo');


    Route::get('products', function(){
        return view('products.index');
    });

    Route::get('bill2', function(){
        return view('pages.bill.index');
    });

    Route::get('order', function(){
        return view('pages.order.index');
    });

    Route::get('service', function(){
        return view('pages.service.index');
    });
