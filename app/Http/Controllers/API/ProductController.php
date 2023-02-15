<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response(['products' => ProductResource::collection($products)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'sku' => 'required|max:255',
            'upc' => 'required|max:255',
        ]);

        if($validator->fails()){
            //return response(['error' => $validator->errors(), 'Validation Error']);
            return $this->sendError('Validation Error', ['error'=>$validator->errors()]);
        }

        $product = Product::create($data);

        return response(['product' => new ProductResource($product), 'message' => 'Product created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response(['product' => new ProductResource($product)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'sku' => 'required|max:255',
            'upc' => 'required|max:255',
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $product->update($data);

        return response(['product' => new ProductResource($product), 'message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(['message' => 'Product deleted successfully']);
    }
}