<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ShowAllRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShowProductsListController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }
    public function __invoke(ShowAllRequest $request): JsonResponse
    {
        $request->validated();

        $products = $this->productService->getProducts($request['sort_by'], $request['sort_order']);

        return response()->json($products);

    }
}
