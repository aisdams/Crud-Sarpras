<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductMasukController;
use App\Http\Controllers\ProductKeluarController;

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
	return view('auth.login');
});

Auth::routes();
Route::get('/home', [HomeController::class,'index'])->name('home');

Route::get('dashboard', function () {
	return view('layouts.master');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('categories',CategoryController::class);
	Route::get('/apiCategories', [CategoryController::class,'apiCategories'])->name('api.categories');
	Route::get('/exportCategoriesAll', [CategoryController::class, 'exportCategoriesAll'])->name('exportPDF.categoriesAll');
	Route::get('/exportCategoriesAllExcel', [CategoryController::class, 'exportExcel'])->name('exportExcel.categoriesAll');

	Route::resource('customers',CustomerController::class);
	Route::get('/apiCustomers', [CustomerController::class,'apiCustomers'])->name('api.customers');
	Route::post('/importCustomers', 'CustomerController@ImportExcel')->name('import.customers');
	Route::get('/exportCustomersAll', 'CustomerController@exportCustomersAll')->name('exportPDF.customersAll');
	Route::get('/exportCustomersAllExcel', 'CustomerController@exportExcel')->name('exportExcel.customersAll');

	Route::resource('sales',SaleController::class);
	Route::get('/apiSales', 'SaleController@apiSales')->name('api.sales');
	Route::post('/importSales', 'SaleController@ImportExcel')->name('import.sales');
	Route::get('/exportSalesAll', 'SaleController@exportSalesAll')->name('exportPDF.salesAll');
	Route::get('/exportSalesAllExcel', 'SaleController@exportExcel')->name('exportExcel.salesAll');

	Route::resource('suppliers',SupplierController::class);
	Route::get('/apiSuppliers', 'SupplierController@apiSuppliers')->name('api.suppliers');
	Route::post('/importSuppliers', 'SupplierController@ImportExcel')->name('import.suppliers');
	Route::get('/exportSupplierssAll', 'SupplierController@exportSuppliersAll')->name('exportPDF.suppliersAll');
	Route::get('/exportSuppliersAllExcel', 'SupplierController@exportExcel')->name('exportExcel.suppliersAll');

	Route::resource('products',ProductController::class);
	Route::get('/apiProducts', 'ProductController@apiProducts')->name('api.products');

	Route::resource('productsOut',ProductKeluarController::class);
	Route::get('/apiProductsOut', 'ProductKeluarController@apiProductsOut')->name('api.productsOut');
	Route::get('/exportProductKeluarAll', 'ProductKeluarController@exportProductKeluarAll')->name('exportPDF.productKeluarAll');
	Route::get('/exportProductKeluarAllExcel', 'ProductKeluarController@exportExcel')->name('exportExcel.productKeluarAll');
	Route::get('/exportProductKeluar/{id}', 'ProductKeluarController@exportProductKeluar')->name('exportPDF.productKeluar');

	Route::resource('productsIn',ProductMasukController::class);
	Route::get('/apiProductsIn', 'ProductMasukController@apiProductsIn')->name('api.productsIn');
	Route::get('/exportProductMasukAll', 'ProductMasukController@exportProductMasukAll')->name('exportPDF.productMasukAll');
	Route::get('/exportProductMasukAllExcel', 'ProductMasukController@exportExcel')->name('exportExcel.productMasukAll');
	Route::get('/exportProductMasuk/{id}', 'ProductMasukController@exportProductMasuk')->name('exportPDF.productMasuk');

	Route::resource('user',UserController::class);
	Route::get('/apiUser', 'UserController@apiUsers')->name('api.users');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

