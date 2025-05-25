<?php
declare(strict_types=1);

namespace App\Http\Requests\Cart;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment_method_id' => [
                'required',
                'integer',
                Rule::exists('payment_methods', 'id')
            ]
        ];
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return PaymentMethod::findOrFail($this->input('payment_method_id'));
    }
}
