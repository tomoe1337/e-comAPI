<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class OrderRepository implements OrderRepositoryInterface
{
    public function createFromCart(array $data): Order
    {
        return Order::create([
            'user_id' => $data['user_id'],
            'payment_method_id' => $data['payment_method_id'],
            'status' => 'pending',
            'total' => $data['total'],
            'payment_token' => Str::random(32)
        ]);

    }

    public function attachProducts(Order $order, array $products): void
    {
        $order->products()->attach($products);
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
        return $order->update(
            [
                'status' => $status,
                'paid_at' => now(),
            ]
        );
    }
}
