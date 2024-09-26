<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', "regex:/^[a-zA-Zа-яА-Я0-9'.,;:!?\"\/\\\#$%^()<>_\+\-=\[\]{}@&*|~\s]+$/u"],
            'description' => ['nullable', 'string', 'max:1000', "regex:/^[a-zA-Zа-яА-Я0-9'.,;:!?\"\/\\\#$%^()<>_\+\-=\[\]{}@&*|~\s]+$/u"],
            // 'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            // 'image' => 'required',
        ];
    }
}
