<?php

namespace App\Services;

use App\Models\Order;

class PaymentService
{
    public function generatePaymentLink(Order $order): string
    {
        return route('payment.process', [
            'order_id' => $order->id,
            'token' => $order->payment_token
        ]);
    }
}
