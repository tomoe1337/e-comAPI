<?php

namespace App\Repositories\Interfaces;

use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function attachProducts(Order $order, array $products): void;
    public function createFromCart(array $data): Order;
    public function findById(int $id): ?Order;
    public function getUserOrders(User $user, array $filters = [], array $sort = []): LengthAwarePaginator;
    public function updateStatus(Order $order, string $status): bool;
}
