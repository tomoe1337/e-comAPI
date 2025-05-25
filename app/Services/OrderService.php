<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository
    ) {}

    public function createOrder(User $user, array $orderData): Order
    {
        return $this->orderRepository->createFromCart($user, $orderData);
    }

    public function getOrder(int $id): ?Order
    {
        return $this->orderRepository->findById($id);
    }

    public function getUserOrders(User $user, ?string $status = null, string $sortOrder = 'desc'): LengthAwarePaginator
    {
        return $this->orderRepository->getUserOrders($user, [
            'status' => $status,
            'sort' => ['by' => 'created_at', 'order' => $sortOrder]
        ]);
    }

    public function markAsPaid(Order $order): bool
    {
        return $this->orderRepository->updateStatus($order, 'paid');
    }
}
