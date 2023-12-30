<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\InventoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

//report
Route::get('/Report', [SaleController::class, 'getReport'])->name('report');
Route::post('getOrderFullfill', [SaleController::class, 'getTotalOrderFulfill']);
Route::post('getWeekNowFamous', [SaleController::class, 'getWeekNowFamous']);

//Sale Page
Route::get('/Shop-Order-Dashboard', [SaleController::class, 'getShopOrderPanel'])->name('shop_order_panel');
Route::post('getCountingUnitsByItemId', [SaleController::class, 'getCountingUnitsByItemId']);
Route::post('Sale/Store', [SaleController::class, 'storeShopOrder'])->name('store_shop_order');

//voucher
Route::get('Finished-Order', [SaleController::class, 'getFinishedOrderList'])->name('voucher_lists');
Route::post('/voucher/delete', [SaleController::class, 'deleteVoucher'])->name('vouchers.delete');
Route::get('Shop-Order-Voucher/{voucher_id}', [SaleController::class, 'getShopOrderVoucher'])->name('shop_order_voucher');
Route::post('Finished-Order-DateFilter', [SaleController::class, 'getFilterFinishedOrderList'])->name('filter_finished_lists');

//Inventory
//meal
Route::get('meal', [InventoryController::class, 'getMealList'])->name('meal_list');
Route::post('meal/store', [InventoryController::class, 'storeMeal'])->name('meal_store');
Route::post('meal/update/{id}', [InventoryController::class, 'updateMeal'])->name('meal_update');
//cuisine
Route::get('cuisine-type', [InventoryController::class, 'getCuisineTypeList'])->name('cuisine-type_list');
Route::post('cuisine-type/store', [InventoryController::class, 'storeCuisineType'])->name('cuisine_type_store');
Route::post('cuisine-type/update/{id}', [InventoryController::class, 'updateCuisineType'])->name('cuisine_type_update');
//menu item
Route::get('menu-item', [InventoryController::class, 'getMenuItemList'])->name('menu_item_list');
Route::post('menu-item/store', [InventoryController::class, 'storeMenuItem'])->name('menu_item_store');
Route::post('menu-item/update/{id}', [InventoryController::class, 'updateMenuItem'])->name('menu_item_update');
Route::post('menu-item/delete', [InventoryController::class, 'deleteMenuItem'])->name('menu.delete');
//counting unit
Route::get('Option/{item_id}', [InventoryController::class, 'getOptionList'])->name('option_list');
Route::post('Option/store', [InventoryController::class, 'storeOption'])->name('option_store');
Route::post('Option/update/{id}', [InventoryController::class, 'updateOption'])->name('option_update');
Route::post('Option/delete', [InventoryController::class, 'deleteOption']);
Route::get('option/brake/{id}',[InventoryController::class, 'changeBrake'])->name('brake_status');
Route::get('option/unbrake/{id}',[InventoryController::class, 'changeUnbrake'])->name('unbrake_status');