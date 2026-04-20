<?php

namespace App\Http\Requests\Dealer;

use App\Enums\WarrantyItemPosition;
use App\Models\Product;
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
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['nullable', 'integer', Rule::exists('products', 'id')],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            $selectedPositions = (array) $this->input('item_positions', []);
            $productIds = (array) $this->input('product_ids', []);
            $activeProductIds = Product::query()->active()->pluck('id')->all();

            foreach ($selectedPositions as $position) {
                $productId = (int) ($productIds[$position] ?? 0);

                if ($productId === 0) {
                    $validator->errors()->add("product_ids.$position", "Produk untuk {$position} wajib dipilih.");
                    continue;
                }

                if (! in_array($productId, $activeProductIds, true)) {
                    $validator->errors()->add("product_ids.$position", "Produk untuk {$position} harus berstatus aktif.");
                }
            }
        });
    }
}