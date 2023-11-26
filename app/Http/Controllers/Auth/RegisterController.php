<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\RegisterRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = $this->createUser($request);
        Auth::guard()->login($user);

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect(RouteServiceProvider::DASHBOARD);
    }

    private function createUser(Request $request): User
    {
        return User::create([
            User::FIRST_NAME => $request->input(RegisterRequest::FIRST_NAME),
            User::LAST_NAME  => $request->input(RegisterRequest::LAST_NAME),
            User::MOBILE     => $request->input(RegisterRequest::MOBILE),
        ]);
    }
}
