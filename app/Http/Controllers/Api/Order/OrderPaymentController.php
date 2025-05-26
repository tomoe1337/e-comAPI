<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderPaymentRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderPaymentController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function __invoke(OrderPaymentRequest $request): JsonResponse
    {
        $order = Order::where('payment_token', $request['token'])->first();

        if (!$order) {
            return response()->json(['error' => 'Заказ не найден'], 404);
        }

        if($order->status == Order::STATUS_PAID) {
            return response()->json(['error' => 'Заказ уже оплачен'], 400);
        }
        $this->orderService->markAsPaid($order);

        return response()->json([
            'message' => 'Заказ успешно оплачен',
            'order_id' => $order->id,
            'new_status' => $order->status,
        ], 200);
    }
}
