<?php

namespace App\Repositories\Interfaces;

use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function createFromCart(User $user, array $orderData): Order;
    public function findById(int $id): ?Order;
    public function getUserOrders(User $user, array $filters = [], array $sort = []): LengthAwarePaginator;
    public function updateStatus(Order $order, string $status): bool;
}
