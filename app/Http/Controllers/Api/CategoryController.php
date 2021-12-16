<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();

        return response()->json([
            'success'   => true,
            'data'      => $categories
        ]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->create($request->all());

        return response()->json([
            'success'   => true,
            'data'      => $category
        ], 201);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryService->update($id, $request->all());

        return response()->json([
            'success'   => true,
            'data'      => $category
        ]);
    }

    public function delete($id)
    {
        $category = $this->categoryService->delete($id);

        return response()->json([
            'success'   => true,
            'data'      => $category
        ]);
    }
}
