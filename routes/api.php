<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/admin/subcategory/insert', [SubCategoryController::class,'insertSubCategory'])->name('subcategory.insert')->middleware(AdminMiddleware::class);
