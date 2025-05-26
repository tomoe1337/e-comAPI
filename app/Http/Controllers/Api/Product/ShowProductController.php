<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowProductController extends Controller
{
    public function __invoke(Product $product): JsonResponse
    {
        if ($product) {
            return response()->json($product);
        }

        return response()->json(['message' => 'Product not found'], 404);
    }
}
