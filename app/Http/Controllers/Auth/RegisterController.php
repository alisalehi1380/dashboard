<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    protected string $redirectTo = RouteServiceProvider::HOME;
    
}
