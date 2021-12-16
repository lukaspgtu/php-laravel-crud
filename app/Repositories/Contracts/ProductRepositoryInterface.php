<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    /**
     * Get all products
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Create product
     * @param array $attributes
     * @return Product
     */
    public function create(array $attributes): Product;

    /**
     * Update product
     * @param int $id
     * @param array $attributes
     * @return Product
     */
    public function update(int $id, array $attributes): Product;

    /**
     * Delete product
     * @param int $id
     * @param array $attributes
     * @return Product
     */
    public function delete(int $id): Product;
}