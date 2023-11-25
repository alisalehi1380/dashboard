<?php

namespace App\Http\Controllers\Auth\Requests;

use App\Http\Controllers\Auth\Requests\Rules\Phone;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public const MOBILE = 'mobile';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::MOBILE => ['required', 'numeric', new Phone(), 'exists:user' . ',' . User::MOBILE],
        ];
    }
}
