<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;
    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'paid', 'cancelled']);
        $paidAt = null;
        $paymentToken = Str::random(10);;

        if ($status === 'paid') {
            $paidAt = $this->faker->dateTimeThisYear();
        }

        return [
            'user_id' => User::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'status' => $status,
            'total' => $this->faker->randomFloat(2, 10, 1000),
            'paid_at' => $paidAt,
            'payment_token' => $paymentToken,
        ];
    }
}
