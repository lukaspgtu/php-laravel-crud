<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll();

        return response()->json([
            'success'   => true,
            'data'      => $products
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->create($request->all());

        return response()->json([
            'success'   => true,
            'data'      => $product
        ], 201);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->productService->update($id, $request->all());

        return response()->json([
            'success'   => true,
            'data'      => $product
        ]);
    }

    public function delete($id)
    {
        $product = $this->productService->delete($id);

        return response()->json([
            'success'   => true,
            'data'      => $product
        ]);
    }
}
