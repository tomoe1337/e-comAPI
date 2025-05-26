<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class ShowOrderController extends Controller
{
    public function __invoke(Order $order): JsonResponse
    {
        if ($order) {
            return response()->json($order);
        }

        return response()->json(['message' => 'Order not found'], 404);
    }
}
