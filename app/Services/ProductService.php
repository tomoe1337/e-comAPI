<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function getProduct(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    public function getProducts(?string $sortBy, ?string $sortOrder ): Collection
    {
        if ($sortBy === null) {
            $sortBy = 'price';
        }

        if ($sortOrder === null) {
            $sortOrder = 'asc';
        }
        return $this->productRepository->getAllSorted($sortBy, $sortOrder);
    }
}
