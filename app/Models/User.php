<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const NATIONAL_ID = 'national_id';
    public const MOBILE_VERIFIED_AT = 'mobile_verified_at';
    public const MOBILE = 'mobile';
    public const OTP = 'otp';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';

    protected $fillable = [
        self::FIRST_NAME,
        self::LAST_NAME,
        self::NATIONAL_ID,
        self::MOBILE_VERIFIED_AT,
        self::OTP,
        self::PASSWORD,
    ];

    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', //todo persian date
        self::PASSWORD      => 'hashed',
    ];
}
