<?php

namespace App\Http\Requests\Inventory\Product;

use Illuminate\Foundation\Http\FormRequest;

class ExportProductRequest extends FormRequest
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
            'selected' => ['required', 'array'],
            'selected.*' => ['integer', 'exists:products,id'],
        ];
    }
}
