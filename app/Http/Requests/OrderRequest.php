<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'notes' => 'nullable|string',
            'email' => 'required|string|max:255',
            'total_item' => 'required|numeric|',
            'total_price' => 'required|numeric',
        ];
    }
}
