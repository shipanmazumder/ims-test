<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix("product")->name('product.')->group(function () {
    Route::get("/",[ProductController::class,"index"])->name("index");
    Route::post("/store",[ProductController::class,"store"])->name("store");
    Route::get("/products",[ProductController::class,"products"])->name("products");
    Route::get("/edit/{id}",[ProductController::class,"edit"])->name("edit");
    Route::put("/update/{id}",[ProductController::class,"update"])->name("update");
    Route::delete("/delete/{id}",[ProductController::class,"destroy"])->name("delete");
});



