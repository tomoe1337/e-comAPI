<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Laravel User',
            'email' => 'laravel@mail.ru',
            'password' => bcrypt('Laravel123'),
        ]);

        $products = Product::factory(50)->create();
        $paymentMethods = PaymentMethod::factory(3)->create();

        Order::factory(10)->create([
            'user_id' => $user->id,
        ])->each(function ($order) use ($products, $paymentMethods) {
            $paymentMethod = $paymentMethods->random();
            $status = Arr::random(['pending', 'paid', 'cancelled']);

            $order->update([
                'payment_method_id' => $paymentMethod->id,
                'status' => $status,
                'paid_at' => $status === 'paid' ? now() : null,
                'payment_token' => $status === 'paid' ? Str::random(10) : null,
            ]);

            $orderProducts = $products->random(rand(1, $products->count() > 10 ? 10 : $products->count()));
            $total = 0;
            $orderProducts->each(function ($product) use ($order, &$total) {
                $quantity = rand(1, 3);
                $order->products()->attach($product->id, ['quantity' => $quantity, 'price' => $product->price]);
                $total += $quantity * $product->price;
            });
            $order->update(['total' => $total]);


        });
}

}
