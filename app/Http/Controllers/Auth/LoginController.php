<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\LoginRequest;
use App\Http\Controllers\Auth\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $this->guard()->attempt($this->credentials($request), true);
        
        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }
            
            return $this->sendLoginResponse($request);
        }
        
        return $this->sendFailedLoginResponse($request);
    }
    
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended(RouteServiceProvider::DASHBOARD);
    }
    
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt([User::MOBILE => $request->input(LoginRequest::MOBILE)], true);
    }
    
    public function logout(Request $request)
    {
        $this->guard()->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
    
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $request->input(LoginRequest::MOBILE) => [trans('auth.failed')],
        ]);
    }
    
    protected function guard()
    {
        return Auth::guard();
    }
    
    public function register(RegisterRequest $request)
    {
    
    }
}
