<?php

namespace App\Http\Controllers\Auth\Requests;

use App\Http\Controllers\Auth\Requests\Rules\Phone;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const MOBILE = 'mobile';
    
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            self::FIRST_NAME => 'required|min:2',
            self::LAST_NAME  => 'required|min:2',
            self::MOBILE     => ['required', new Phone(), 'unique:users' . User::MOBILE],
        ];
    }
}
