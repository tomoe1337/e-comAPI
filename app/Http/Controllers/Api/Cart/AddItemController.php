<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddItemRequest;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class AddItemController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function __invoke(AddItemRequest $request): JsonResponse
    {
        $this->cartService->addToCart(
            $request->user(),
            Product::find($request->input('product_id')),
            $request->input('quantity', 1)
        );

        return response()->json(['message' => 'Товар добавлен в корзину']);
    }
}
