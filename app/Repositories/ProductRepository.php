<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function getAllSorted(string $sortBy, string $sortOrder): Collection
    {
        return Product::orderBy($sortBy, $sortOrder)->get();
    }
}
