<?php

namespace App\Http\Controllers\Auth\Requests\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Phone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!str_starts_with($value, '09')) {
            $fail('شماره موبایل را با 09 وارد کنید');
        } elseif (strlen($value) !== 11) {
            $fail('تعداد ارقام شماره موبایل صحیح نیست');
        }
    }
}
