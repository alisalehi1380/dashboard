<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    public const EMAIL = 'email';
    public const MOBILE = 'mobile';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';
    
    protected $fillable = [
        self::FIRST_NAME,
        self::LAST_NAME,
        self::NATIONAL_ID,
        self::EMAIL,
        self::PASSWORD,
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];
}
