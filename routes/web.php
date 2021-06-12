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

Route::get('/', 'DisplayCustomerController@index')->name('customer.index');
Route::get('services', 'DisplayCustomerController@services')->name('customer.services');
Route::get('service/{slug}', 'DisplayCustomerController@service')->name('customer.service');




Route::middleware(['AuthCustomer:auth'])->group(function () {
	Route::prefix('customer')->group(function () {
		// đăng nhập
		Route::get('/login', 'DisplayCustomerController@login')->name('customer.login');
		Route::post('/login', 'AuthCustomerController@login')->name('customer.login');

		// đăng kí
		Route::get('/register', 'DisplayCustomerController@register')->name('customer.register');
		Route::post('/register', 'AuthCustomerController@create')->name('customer.register');
		


	});
});

Route::middleware(['AuthCustomer:customer'])->group(function () {
	Route::prefix('customer')->group(function () {
		Route::post('logout', 'AuthCustomerController@logout')->name('customer.logout');

		Route::get('history', 'DisplayCustomerController@history')->name('customer.history');


		// đặt lịch online
		Route::get('booking', 'DisplayCustomerController@booking')->name('customer.booking');
		Route::post('booking', 'DisplayCustomerController@booking_store')->name('customer.booking');

		// chốt đơn online
		Route::get('checkout', 'DisplayCustomerController@checkout')->name('customer.checkout');


	});
});

// Thanh toán online qua API
Route::post('payment', 'PaymentController@create_pay')->name('customer.create_pay');
Route::get('return-vnpay', 'PaymentController@return_pay')->name('customer.return_vnpay');


Route::middleware(['AuthAdmin:auth'])->group(function () {
	Route::prefix('admin')->group(function () {
		// đăng nhập
		Route::get('/login', 'DisplayAdminController@login')->name('admin.login');
		Route::post('/login', 'AuthAdminController@login')->name('admin.login');
	});
});
Route::post('logout', 'AuthAdminController@logout')->name('admin.logout');
Route::middleware(['AuthAdmin:admin'])->group(function () {
	Route::prefix('admin')->group(function () {
		
		Route::get('/', 'DisplayAdminController@dashboard')->name('admin.dashboard');

		Route::prefix('services')->group(function () {
			Route::get('/', 'Admin\ServicesController@index')->name('admin.services.index');
			Route::post('/create', 'Admin\ServicesController@store')->name('admin.services.store');
		});

		Route::prefix('room')->group(function () {
			Route::get('/', 'Admin\RoomController@index')->name('admin.room.index');
			Route::post('/create', 'Admin\RoomController@store')->name('admin.room.store');
		});

		Route::prefix('customer')->group(function () {
			Route::get('/', 'Admin\CustomerController@index')->name('admin.customer.index');
			Route::post('/create', 'Admin\CustomerController@store')->name('admin.customer.store');
		});


		Route::prefix('bookingvip')->group(function () {
			Route::get('/', 'Admin\BookingvipController@index')->name('admin.bookingvip.index');
			Route::post('/create', 'Admin\BookingvipController@store')->name('admin.bookingvip.store');
		});

	});
});

Route::middleware(['AuthAdmin:manage'])->group(function () {
	Route::prefix('manage')->group(function () {
		
		Route::get('/', 'DisplayAdminController@manager')->name('manage.dashboard');
	});
});