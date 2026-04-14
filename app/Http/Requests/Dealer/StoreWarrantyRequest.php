<?php

namespace App\Http\Requests\Dealer;

use App\Enums\WarrantyItemPosition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWarrantyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'string', 'email', 'max:255'],
            'car_type' => ['required', 'string', 'max:255'],
            'engine_number' => ['required', 'string', 'max:255'],
            'item_positions' => ['required', 'array', 'min:1'],
            'item_positions.*' => ['required', Rule::in(WarrantyItemPosition::values())],
            'product_names' => ['nullable', 'array'],
            'product_names.*' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            $selectedPositions = (array) $this->input('item_positions', []);
            $productNames = (array) $this->input('product_names', []);

            foreach ($selectedPositions as $position) {
                $productName = trim((string) ($productNames[$position] ?? ''));

                if ($productName === '') {
                    $validator->errors()->add("product_names.$position", "Nama produk untuk {$position} wajib diisi.");
                }
            }
        });
    }
}