<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function createForUser(User $user): Cart
    {
        $cart = new Cart();
        $user->cart()->save($cart);
        return $cart;
    }

    public function getByUser(User $user): ?Cart
    {
        return $user->cart()->with('products')->first();
    }

    public function addProduct(Cart $cart, Product $product, int $quantity = 1): void
    {
        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => $quantity]
        ]);
    }

    public function removeProduct(Cart $cart, Product $product): void
    {
        $cart->products()->detach($product->id);
    }

    public function clear(Cart $cart): void
    {
        $cart->products()->detach();
    }
}
