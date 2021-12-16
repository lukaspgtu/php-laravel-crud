<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CategoryService
{
    protected $categoryRepository;
    
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all categories
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Create category
     * @param array $attributes
     * @return Category
     */
    public function create(array $attributes): Category
    {
        $attributes['image'] = $this->imageUpload($attributes['image']);

        return $this->categoryRepository->create(Arr::only($attributes, [
            'name',
            'image'
        ]));
    }

    /**
     * Update category
     * @param int $id
     * @param array $attributes
     * @return Category
     */
    public function update(int $id, array $attributes): Category
    {
        if (isset($attributes['image'])) {
            $attributes['image'] = $this->imageUpload($attributes['image']);
        }

        return $this->categoryRepository->update($id, Arr::only($attributes, [
            'name',
            'image'
        ]));
    }

    /**
     * Delete category
     * @param int $id
     * @param array $attributes
     * @return Category
     */
    public function delete(int $id): Category
    {
        if (Product::where('category_id', $id)->count() > 0) {
            throw ValidationException::withMessages([
                'products' => 'Unlink all products from this category before deleting it'
            ]);
        }

        return $this->categoryRepository->delete($id);
    }

    /**
     * Image upload
     * @param string $image
     * @return string
     */
    private function imageUpload(string $image)
    {
        $ext = explode('/', $image);
        $ext = explode(';', $ext[1])[0];
        
        $name = uniqid(date('HisYmd'));

        $path = "images/{$name}.{$ext}";

        $base64 = explode(',', $image)[1];

        Storage::put($path, base64_decode($base64));

        return config('url', 'http://localhost:8000') . "/storage/$path";
    }
}