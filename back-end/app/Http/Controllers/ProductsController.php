<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

   

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'type_id' => 'required|integer|exists:product_types,id',
            'thumbnail' => 'nullable|string',
            'status' => 'required|boolean',
        ]);
        $product = Product::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'type_id' => $validatedData['type_id'],
            'thumbnail' => $validatedData['thumbnail'],
            'status' => $validatedData['status'],
        ]);

        return response()->json([
            'message' => 'Thêm thành công',
            'product' => $product
        ]);

    }

   
}