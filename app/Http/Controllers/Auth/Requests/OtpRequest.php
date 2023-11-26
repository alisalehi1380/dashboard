<?php

namespace App\Http\Controllers\Auth\Requests;

use App\Http\Controllers\Auth\Requests\Rules\Phone;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
{
    public const OTP = 'otp';
    public const MOBILE = 'mobile';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            self::OTP    => 'nullable|required_if:key,value|digits:4',
            self::MOBILE => ['nullable', 'required_if:key,value', 'numeric', new Phone(), 'exists:users' . ',' . User::MOBILE],
        ];
    }
}
