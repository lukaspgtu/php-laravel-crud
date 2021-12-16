<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    /**
     * Get all categories
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Create category
     * @param array $attributes
     * @return Category
     */
    public function create(array $attributes): Category;

    /**
     * Update category
     * @param int $id
     * @param array $attributes
     * @return Category
     */
    public function update(int $id, array $attributes): Category;

    /**
     * Delete category
     * @param int $id
     * @param array $attributes
     * @return Category
     */
    public function delete(int $id): Category;
}