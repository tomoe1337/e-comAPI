<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\GetUserOrdersRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetUserOrdersController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function __invoke(GetUserOrdersRequest $request): JsonResponse
    {
        $user = Auth::user();
        $status = $request->validated('status');
        $sortOrder = $request->validated('sort_order', 'desc');

        $orders = $this->orderService->getUserOrders($user, $status, $sortOrder);

        return response()->json($orders);
    }
}
