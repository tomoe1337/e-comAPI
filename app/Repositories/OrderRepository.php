<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    public function createFromCart(User $user, array $orderData): Order
    {
        return Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $orderData['payment_method_id'],
            'status' => 'pending',
            'total' => $orderData['total']
        ]);
    }

    public function findById(int $id): ?Order
    {
        return Order::with(['products', 'paymentMethod'])->find($id);
    }

    public function getUserOrders(User $user, array $filters = [], array $sort = []): LengthAwarePaginator
    {
        return $user->orders()
            ->with(['products', 'paymentMethod'])
            ->when($filters['status'] ?? false, fn($q, $status) => $q->where('status', $status))
            ->orderBy($sort['by'] ?? 'created_at', $sort['order'] ?? 'desc')
            ->paginate(15);
    }

    public function updateStatus(Order $order, string $status): bool
    {
        return $order->update(['status' => $status]);
    }
}
