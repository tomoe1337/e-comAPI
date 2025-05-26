<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository
    )
    {
    }

    public function createOrder(Cart $cart, User $user, int $paymentMethodId): Order
    {

        $order = $this->orderRepository->createFromCart([
            'user_id' => $user->id,
            'payment_method_id' => $paymentMethodId,
            'total' => $cart->total
        ]);

        $products = [];
        foreach ($cart->products as $product) {
            $products[$product->id] = [
                'quantity' => $product->pivot->quantity,
                'price' => $product->price
            ];
        }

        $this->orderRepository->attachProducts($order, $products);

        return $order;
    }

    public function getOrder(int $id): ?Order
    {
        return $this->orderRepository->findById($id);
    }

    public function getUserOrders(User $user, ?string $status = null, string $sortOrder = 'desc'): LengthAwarePaginator
    {
        return $this->orderRepository->getUserOrders($user, ['status' => $status], $sortOrder);
    }

    public function markAsPaid(Order $order): bool
    {

        return $this->orderRepository->updateStatus($order, 'paid');
    }
}
