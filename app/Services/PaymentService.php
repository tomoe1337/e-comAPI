<?php

namespace App\Services;

use App\Models\Order;

class PaymentService
{
    public function generatePaymentLink(Order $order): string
    {
        $paymentMethodSlug = $order->paymentMethod->slug;

        return route('payment.process', [
            'method_slug' => $paymentMethodSlug,
            'token' => $order->payment_token
        ]);
    }
}
