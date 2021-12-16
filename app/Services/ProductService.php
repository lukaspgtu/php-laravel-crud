<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    /**
     * Create product
     * @param array $attributes
     * @return Product
     */
    public function create(array $attributes): Product
    {
        $attributes['image'] = $this->imageUpload($attributes['image']);

        return $this->productRepository->create(Arr::only($attributes, [
            'category_id',
            'name',
            'image'
        ]));
    }

    /**
     * Update product
     * @param int $id
     * @param array $attributes
     * @return Product
     */
    public function update(int $id, array $attributes): Product
    {
        if (isset($attributes['image'])) {
            $attributes['image'] = $this->imageUpload($attributes['image']);
        }

        return $this->productRepository->update($id, Arr::only($attributes, [
            'category_id',
            'name',
            'image'
        ]));
    }

    /**
     * Delete product
     * @param int $id
     * @param array $attributes
     * @return Product
     */
    public function delete(int $id): Product
    {
        return $this->productRepository->delete($id);
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