<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\RemoveItemRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class RemoveItemController extends Controller
{
    public function __construct(private CartService $cartService) {}

    public function __invoke(RemoveItemRequest $request): JsonResponse
    {
        $this->cartService->removeFromCart(
            $request->user(),
            $request->getProduct()
        );

        return response()->json(['message' => 'Товар удален']);
    }
}
