<?php

namespace App\Http\Controllers\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public const NATIONAL_ID = 'national_id';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::NATIONAL_ID,
        ];
    }
}
