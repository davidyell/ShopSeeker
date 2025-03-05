<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Enums\ShopType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() instanceof \App\Models\User;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'is_open' => 'required|boolean',
            'store_type' => ['required', Rule::enum(Shoptype::class)],
            'max_delivery_distance' => 'required|integer|min:0.1',
        ];
    }
}
