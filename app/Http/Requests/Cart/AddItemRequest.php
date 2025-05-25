<?php
declare(strict_types=1);

namespace App\Http\Requests\Cart;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddItemRequest extends FormRequest
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
            'product_id' => [
                'required',
                'integer',
                Rule::exists('products', 'id')
            ],
            'quantity' => [
                'sometimes',
                'integer',
                'min:1',
                'max:10'
            ]
        ];
    }

    public function getProduct(): Product
    {
        return Product::findOrFail($this->input('product_id'));
    }
}
