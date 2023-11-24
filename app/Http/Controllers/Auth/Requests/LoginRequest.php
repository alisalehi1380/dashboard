<?php

namespace App\Http\Controllers\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public const USERNAME = 'username';
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            self::USERNAME,
        ];
    }
}
