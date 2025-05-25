<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Repositories\CartRepository;

class CartService
{
    public function __construct(
        private CartRepository $cartRepository
    ) {}

    public function addToCart(User $user, Product $product, int $quantity = 1): void
    {
        $cart = $this->cartRepository->getByUser($user);

        $this->cartRepository->addProduct($cart, $product, $quantity);
    }

    public function removeFromCart(User $user, Product $product): void
    {
        if ($cart = $this->cartRepository->getByUser($user)) {
            $this->cartRepository->removeProduct($cart, $product);
        }
    }

    public function getByUser(User $user): ?Cart
    {
        return $user->cart()->with('products')->first();
    }

    public function clear(User $user): void
    {
        $user->cart?->products()->detach();
    }
}
