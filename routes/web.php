<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectBasedOnRole;
use App\Http\Middleware\RestrictHttpMethod;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/register', [UrlController::class,'showRegisterPage'])->name('register');
Route::get('/', [UrlController::class,'redirectUser'])->name('home');
Route::get('/admin/login', [UrlController::class,'showLoginPage'])->name('admin.login');
Route::get('/admin/dashboard', [UrlController::class, 'showDashboardPage'])->name('admin.dashboard')->middleware(AdminMiddleware::class);
Route::get('/user/home', [UrlController::class,'showUserHomePage'])->name('user.home')->middleware(UserMiddleware::class);
Route::get('/admin/categoryPage', [UrlController::class,'showCategoryPage'])->name('admin.categorypage')->middleware(AdminMiddleware::class);
// Route::get('/admin/show/category', [CategoryController::class, 'showCategory'])->name('admin.category')->middleware(AdminMiddleware::class);
Route::get('/admin/category/loadData/{id}', [SubCategoryController::class, 'showAll'])->name('load.subcategory');
// Route::get('/admin/product',[UrlController::class,'showProductPage'])->name('admin.productpage')->middleware(AdminMiddleware::class);
Route::get('admin/product',[ProductController::class,'showProductPage'])->name('admin.productpage');
Route::get('/product/subcategories/{id}',[ProductController::class,'showSubcategory'])->name('product.subcategory');
Route::get('/product/secsubcategories/{id}',[ProductController::class,'showSubcategory'])->name('product.subcategory');
Route::get('/admin/product/show/{id}',[ProductController::class,'showProductList'])->name('admin.product.show')->middleware(AdminMiddleware::class);
Route::get('/product/edit/{id}',[ProductController::class,'editProduct'])->name('admin.product.edit')->middleware(AdminMiddleware::class);
Route::get('/user/category/{category}/{slug}',[UrlController::class,'showShopByCategoryPage'])->name('shopbycategory');
Route::get('/user/category/{category}/{slug}/{id}',[UrlController::class,'buyProductPage'])->name('buyproduct');
Route::get('/cart',[CartController::class,'index'])->name('cart')->middleware(UserMiddleware::class);
Route::get('/address/review/order',[UrlController::class,'showAddressPage'])->name('address')->middleware(UserMiddleware::class);
Route::get('/order/placed',[UrlController::class,'showOrderPage'])->name('placedOrder')->middleware(UserMiddleware::class);

Route::get('/view-testing-page',[CategoryController::class,'showCategory'])->name('testing');
Route::get('/view-testing-page',[UrlController::class,'showTestingPage'])->name('view.testing');



Route::post('/cart/add',[CartController::class,'addToCart'])->name('addToCart')->middleware(UserMiddleware::class);
Route::post('/cart/update',[CartController::class,'updateCart'])->name('update.cart')->middleware(UserMiddleware::class);
Route::post('/login',[UserController::class,'loginCheck'])->name('login.check');
Route::post('/logout', [UserController::class,'logout'])->name('logout')->middleware(RestrictHttpMethod::class);
Route::post('/admin/category/insert', [CategoryController::class,'insertCategory'])->name('category.insert')->middleware(AdminMiddleware::class);
Route::post('/admin/subcategory/insert', [SubCategoryController::class,'insertSubCategory'])->name('subcategory.insert')->middleware(AdminMiddleware::class);
Route::post('/add/products',[ProductController::class, 'insertProduct'])->name('add.product')->middleware(AdminMiddleware::class);
Route::post('/admin/product/update/{id}',[ProductController::class,'updateProduct'])->name('admin.product.update')->middleware(AdminMiddleware::class);
Route::post('/address/add',[AddressController::class,'storeAddress'])->name('address.add')->middleware(UserMiddleware::class);
Route::post('/order/placed',[OrderController::class, 'submitOrder'])->name('orderPlaced')->middleware(UserMiddleware::class);
Route::post('/account/registerd',[CreateUserController::class,'createUser'])->name('register.user');

Route::delete('/admin/subcategory/delete/{id}', [SubCategoryController::class, 'deleteCategory'])->name('category.delete')->middleware(AdminMiddleware::class);
Route::delete('/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete')->middleware(AdminMiddleware::class);
Route::delete('/cart/delete',[CartController::class,'deleteCartItem'])->name('cart.delete')->middleware(UserMiddleware::class);

