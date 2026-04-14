<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class WarrantyCheckRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['required', 'string', 'max:255'],
        ];
    }
}