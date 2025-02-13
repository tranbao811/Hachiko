<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SimController;
use App\Http\Controllers\WifiController;
use App\Models\customer_request;

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

// admin
Route::middleware(['auth:admin'])->group(function (): void {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin_accounts', [AdminController::class, 'admin_accounts'])->name('admin.admin_accounts');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AdminController::class, 'admin_showRegisterForm'])->name('admin.admin_showRegisterForm');
    Route::post('/register', [AdminController::class, 'register'])->middleware('check.admin.level')->name('admin.register.submit');
    Route::post('/OrderSim', [AdminController::class, 'create_order_sim'])->name('order_sim.create');
    Route::post('/updateOrderSim/{id}', [AdminController::class, 'update_order_sim'])->name('order_sim.update');
    Route::get('/order/{id}/edit', [AdminController::class, 'edit'])->name('order.edit');
    Route::get('/admin/get-admin-details/{id}', [AdminController::class, 'getAdminDetails']);
    Route::post('/admin/update-admin/{id}', [AdminController::class, 'updateAdmin']);  // Thực hiện cập nhật  

    // WIFI  
    Route::get('/wifi_codinh', [WifiController::class, 'wifi_codinh'])->name('wifi.wifi_codinh');
    Route::post('/create_wifi', [WifiController::class, 'create_wifi'])->name('wifi.create_wificodinh');

    // sim call
    Route::get('/sim_call', [SimController::class, 'sim_call'])->name('sim.sim_call');
    Route::get('/sim_call_storage', [SimController::class, 'sim_call_storage'])->name('sim.sim_call_storage');
    Route::get('/sim_call_customer_request', [SimController::class, 'sim_call_customer_request'])->name('sim.sim_call_customer_request');
    Route::post('/api/save_CsvSimCall', [SimController::class, 'save_CsvSimCall']);
    Route::post('/saveRequestSimCall', [SimController::class, 'saveRequestSimCall']);
    Route::get('/sim_call_transfer', [SimController::class, 'sim_call_transfer'])->name('sim.sim_call_transfer');

    // sim data
    Route::get('/sim_data', [SimController::class, 'sim_data'])->name('sim.sim_data');
    Route::get('/sim_data_storage', [SimController::class, 'sim_data_storage'])->name('sim.sim_data_storage');
    Route::get('/sim_data_customer_request', [SimController::class, 'sim_data_customer_request'])->name('sim.sim_data_customer_request');
    Route::post('/api/save_CsvSimData', [SimController::class, 'save_CsvSimData']);
    Route::post('/saveRequestSimData', [SimController::class, 'saveRequestSimData']);
    Route::get('/sim_data_transfer', [SimController::class, 'sim_data_transfer'])->name('sim.sim_data_transfer');

    // thao tác yêu cầu sim
    Route::post('/confirm-item/{id}', [SimController::class, 'confirm']);
    Route::post('/confirm-item-simdata/{id}', [SimController::class, 'confirm_simdata']);
    Route::post('/cancel-item/{id}', [SimController::class, 'cancelRequest'])->name('cancel.item');
    Route::post('/cancel-item-simdata/{id}', [SimController::class, 'cancelRequest_Simdata'])->name('cancel.item_simdata');
    Route::post('/update-memo/{id}', [SimController::class, 'updateMemo']);

    // csv sim
    Route::get('/get_id_sim_by_phone_number', [SimController::class, 'getIdSimByPhoneNumber']);
    Route::post('/save_request_call', [SimController::class, 'saveRequestCall']);
    Route::get('/get_id_sim_by_phone_number_data', [SimController::class, 'getIdSimByPhoneNumberData']);
    Route::post('/save_request_data', [SimController::class, 'saveRequestData']);

    //check sim
    Route::post('/check-sim', [SimController::class, 'checkSim'])->name('sim.check_sim');
    Route::post('/check-sim-data', [SimController::class, 'checkSim_data'])->name('sim.check_sim_data');
    Route::post('/update-manager', [SimController::class, 'updateManager'])->name('sim.update_manager');
    Route::post('/update-manager-data', [SimController::class, 'updateManager_data'])->name('sim.update_manager_data');
});


Route::get('/admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'login'])->name('admin.login.submit');
