<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'items'=>"required|array|min:1",
            'items.*.product_id'=>'required|integer|exists:products,id',
            'items.*.quantity'=>"required|integer",
            'items.*.unitPrice'=>"required|numeric",
            'items.*.total'=>"required|numeric",
            'customer_id'=>"required|integer|exists:customers,id",
            'total'=>"required|numeric",
        ];

    }
}
