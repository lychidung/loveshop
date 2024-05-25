<?php

use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\ProductItemsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductCategoriesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function() {
    return Inertia::render('Public');
})->name('public');

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Route cho Products
Route::get('/Admin/Products/Index/{searchProduct?}', [ProductsController::class, 'index'])->name('products.index');
Route::get('/Admin/Products/Create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/Admin/Products/Create/{index}', [ProductsController::class, 'store'])->name('products.store');

Route::get('/Admin/Products/View/{products}', [ProductsController::class, 'view'])->name('products.view');

Route::get('/Admin/Products/Edit/{products}', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('/Admin/Products/Edit/{id}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/Admin/Products/Index/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');

Route::post('/Admin/Products/Edit', [ProductItemsController::class, 'store'])->name('productsitem.store');
Route::post('/Admin/Products/Edit/{id}/{id_product}', [ProductItemsController::class, 'destroy'])->name('productsitem.destroy');


//Route cho Vouchers
Route::get('/Admin/Vouchers/Index/{searchVoucher?}', [VoucherController::class, 'index'])->name('vouchers.index');
Route::get('/Admin/Vouchers/Create', [VoucherController::class, 'create'])->name('vouchers.create');
Route::post('/Admin/Vouchers/Create', [VoucherController::class, 'store'])->name('vouchers.store');

Route::delete('/Admin/Vouchers/Index/{id}', [VoucherController::class, 'destroy'])->name('vouchers.destroy');
Route::get('/Admin/Vouchers/View/{id}', [VoucherController::class, 'view'])->name('vouchers.view');
Route::post('/Admin/Vouchers/Edit/{id}', [VoucherController::class, 'update'])->name('vouchers.update');


//Route cho Orders
Route::get('/Admin/Orders/Index/{searchOrder?}', [OrdersController::class, 'index'])->name('orders.index');
Route::get('/Admin/Orders/View/{id?}', [OrdersController::class, 'view'])->name('orders.view');

Route::get('/Admin/Orders/Index/{id}/{change}', [OrdersController::class, 'changeStatus'])->name('orders.changeStatus');

//Route cho Users
Route::get('/Admin/User/Index/{searchOrder?}', [UsersController::class, 'index'])->name('users.index');

//Route cho Categories
Route::get('/Admin/Categories/Index/{searchProduct?}', [ProductCategoriesController::class, 'index'])->name('categories.index');
Route::get('/Admin/Categories/Create', [ProductCategoriesController::class, 'create'])->name('categories.create');
Route::post('/Admin/Categories/Create/', [ProductCategoriesController::class, 'store'])->name('categories.store');

Route::get('/Admin/Categories/View/{category}', [ProductCategoriesController::class, 'view'])->name('categories.view');

Route::get('/Admin/Categories/Edit/{category}', [ProductCategoriesController::class, 'edit'])->name('categories.edit');
Route::post('/Admin/Categories/Edit/{id}', [ProductCategoriesController::class, 'update'])->name('categories.update');
Route::delete('/Admin/Categories/Index/{id}', [ProductCategoriesController::class, 'destroy'])->name('categories.destroy');

//Route cho Customers
Route::get('/Admin/Customers/Index/{searchCustomer?}', [CustomersController::class, 'index'])->name('customers.index');
Route::get('/Admin/Customers/Create', [CustomersController::class, 'create'])->name('customers.create');
Route::post('/Admin/Customers/Create/', [CustomersController::class, 'store'])->name('customers.store');

Route::get('/Admin/Customers/View/{customer}', [CustomersController::class, 'view'])->name('customers.view');

Route::get('/Admin/Customers/Edit/{customer}', [CustomersController::class, 'edit'])->name('customers.edit');
Route::post('/Admin/Customers/Edit/{id}', [CustomersController::class, 'update'])->name('customers.update');
// Route::delete('/Admin/Customers/Index/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
Route::delete('/Admin/Customers/Index/{id}', [CustomersController::class, 'lock'])->name('customers.lock');
