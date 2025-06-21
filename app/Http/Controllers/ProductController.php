<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;
use Illuminate\Http\Request;
use App\Models\ProductModel;

#[OA\Info(title: 'My First API', version: '0.1')]
class ProductController extends Controller
{
    #[OA\Post(path: '/api/product', operationId: 'createProduct')]
    #[OA\Response(response: '201', description: 'Product created')]
    #[OA\Response(response: '422', description: 'Validation error')]
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

    #[OA\Get(path: '/api/products', operationId: 'getAllProducts')]
    #[OA\Response(response: '200', description: 'List of all products')]
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

    #[OA\Get(path: '/api/product', operationId: 'getProduct')]
    #[OA\Parameter(name: 'id', in: 'query', required: true, schema: new OA\Schema(type: 'integer'))]
    #[OA\Response(response: '200', description: 'Product found')]
    #[OA\Response(response: '404', description: 'Product not found')]
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

    #[OA\Put(path: '/api/product', operationId: 'updateProduct')]
    #[OA\Response(response: '200', description: 'Product updated')]
    #[OA\Response(response: '404', description: 'Product not found')]
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

    #[OA\Delete(path: '/api/product', operationId: 'deleteProduct')]
    #[OA\Response(response: '200', description: 'Product deleted')]
    #[OA\Response(response: '404', description: 'Product not found')]
    function deleteProduct(Request $request)
    {
        $request->validate(["id" => "required"]);
        $product = ProductModel::find($request->id);

        if ($product) {
            $product->delete();
            return response([
                "message" => "success",
                "products" => "Product has been deleted successfully!",
                "status" => 200,
            ]);
        } else {
            return response([
                "message" => "error",
                "products" => "Product does not exist!",
                "status" => 404,
            ]);
        }
    }
}