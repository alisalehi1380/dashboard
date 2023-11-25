<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
//        $user =  User::create([
//
//        ]);

//        $this->guard()->login($user);

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect(RouteServiceProvider::DASHBOARD);
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
