<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CheckoutRequest;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;

class CheckoutController extends Controller
{
    public function __construct(
        private CartService $cartService,
        private OrderService $orderService,
        private PaymentService $paymentService
    ) {}

    public function __invoke(CheckoutRequest $request): JsonResponse
    {
        $user = $request->user();

        $cart = $this->cartService->getByUser($user);

        if (!$cart || $cart->products->isEmpty()) {
            return response()->json(['message' => 'Корзина пуста'], 422);
        }

        $order = $this->orderService->createOrder($cart, $user, $request['payment_method_id']);

        $paymentLink = $this->paymentService->generatePaymentLink($order);

        $this->cartService->clear($user);

        return response()->json([
            'payment_url' => $paymentLink,
            'order_id' => $order->id
        ]);
    }
}
