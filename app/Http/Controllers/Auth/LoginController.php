<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $this->guard()->attempt($this->credentials($request), $request->boolean(User::REMEMBER_TOKEN));
        
    }
    
    private function credentials($request)
    {
//        $username = $request->only(LoginRequest::USERNAME);
//        $startOfString = substr($username, 0, 2);
//        return $startOfString == '09' ? User::MOBILE : User::NATIONAL_ID;
}
    
    protected function guard()
    {
        return Auth::guard();
    }
}
