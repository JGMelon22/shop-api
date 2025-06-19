<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;

Route::get("/user", function (Request $request) {
    return $request->user();
})->middleware("auth:sanctum");

Route::post("/product", [ProductController::class, "createProduct"]);
Route::get("/products", [ProductController::class, "getAllProducts"]);
Route::get("/product", [ProductController::class, "getProduct"]);
