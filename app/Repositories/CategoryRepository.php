<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get all categories
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->category->orderBy('created_at', 'desc')->get();
    }

    /**
     * Create category
     * @param array $attributes
     * @return Category
     */
    public function create(array $attributes): Category
    {
        return $this->category->create($attributes);
    }

    /**
     * Update category
     * @param int $id
     * @param array $attributes
     * @return Category
     */
    public function update(int $id, array $attributes): Category
    {
        $category = $this->category->findOrFail($id);

        $category->fill($attributes);

        $category->save();

        return $category;
    }

    /**
     * Delete category
     * @param int $id
     * @param array $attributes
     * @return Category
     */
    public function delete(int $id): Category
    {
        $category = $this->category->findOrFail($id);

        $category->delete();

        return $category;
    }
}