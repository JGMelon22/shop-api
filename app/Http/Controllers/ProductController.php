<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    function CreateProduct(Request $request)
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
        /*we create the record as shown below:*/

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
}
