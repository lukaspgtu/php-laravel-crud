<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get all products
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->product->with('category')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Create product
     * @param array $attributes
     * @return Product
     */
    public function create(array $attributes): Product
    {
        $product = $this->product->create($attributes);

        $product->load('category');

        return $product;
    }

    /**
     * Update product
     * @param int $id
     * @param array $attributes
     * @return Product
     */
    public function update(int $id, array $attributes): Product
    {
        $product = $this->product->findOrFail($id);

        $product->fill($attributes);

        $product->save();

        $product->load('category');

        return $product;
    }

    /**
     * Delete product
     * @param int $id
     * @param array $attributes
     * @return Product
     */
    public function delete(int $id): Product
    {
        $product = $this->product->findOrFail($id);

        $product->delete();

        return $product;
    }
}