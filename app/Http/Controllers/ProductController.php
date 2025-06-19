<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    function createProduct(Request $request)
    {
        $request->validate([
            "name" => "required",
            "description" => "required",
            "skuNumber" => "required",
            "category" => "required",
            "supplier" => "required",
            "numberAvailable" => "required",
            "price" => "required",
        ]);

        $product = ProductModel::create([
            "name" => $request->name,
            "description" => $request->description,
            "skuNumber" => $request->skuNumber,
            "category" => $request->category,
            "supplier" => $request->supplier,
            "numberAvailable" => $request->numberAvailable,
            "price" => $request->price,
        ]);

        $product = ProductModel::find($product->id);

        if ($product) {
            return response([
                "message" => "success",
                "product" => $product,
                "status" => 200,
            ]);
        } else {
            return response([
                "message" => "error",
                "product" => "product does not exist!",
                "status" => 404,
            ]);
        }
    }

    function getAllProducts()
    {
        $products = ProductModel::all();
        if ($products) {
            return response([
                "message" => "Success",
                "products" => $products,
            ]);
        } else {
            return response([
                "message" => "error",
                "products" => "No products in database",
            ]);
        }
    }

    function getProduct(Request $request)
    {
        $request->validate(["id" => "required"]);
        $product = ProductModel::find($request->id);

        if ($product) {
            return response([
                "message" => "success",
                "products" => $product,
                "status" => 200,
            ]);
        } else {
            return response([
                "message" => "error",
                "products" => "Product does not exis",
                "status" => 404,
            ]);
        }
    }

    function updateProduct(Request $request)
    {
        $request->validate([
            "id" => "required",
            "name" => "required",
            "description" => "required",
            "skuNumber" => "required",
            "category" => "required",
            "supplier" => "required",
            "numberAvailable" => "required",
            "price" => "required",
        ]);

        $product = ProductModel::find($request->id);

        if ($product) {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->skuNumber = $request->skuNumber;
            $product->category = $request->category;
            $product->supplier = $request->supplier;
            $product->numberAvailable = $request->name;
            $product->price = $request->name;
            $product->save();
            return response([
                "message" => "success",
                "products" => $product,
                "status" => 200,
            ]);
        } else {
            return response([
                "message" => "erro",
                "products" => "Product does not exist",
                "status" => 404,
            ]);
        }
    }
}
