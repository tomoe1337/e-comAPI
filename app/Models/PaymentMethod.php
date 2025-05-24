<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public const SLUG_CREDIT_CARD = 'credit-card';
    public const SLUG_PAYPAL = 'paypal';

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getPaymentUrl(Order $order): string
    {
        return match ($this->slug) {
            self::SLUG_CREDIT_CARD => route('payment.callback', [
                'order' => $order->id,
                'token' => $order->payment_token,
            ]),
            self::SLUG_PAYPAL => 'https://paypal.com/pay/' . $order->id,
            default => route('payment.callback', ['order' => $order->id]),
        };
    }
}
