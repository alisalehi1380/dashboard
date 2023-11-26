<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\LoginRequest;
use App\Http\Controllers\Auth\Requests\OtpRequest;
use App\Http\Controllers\Auth\Requests\Rules\Phone;
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
        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
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

    public function otp1(OtpRequest $request)
    {
        $user = User::where(User::MOBILE, $request->input(OtpRequest::MOBILE))->first();
        $user->update([User::OTP => $this->generateToken()]);

        session()->put('mobile', $request->input(User::MOBILE));
        return redirect()->route('otp2');
    }

    public function otp2(OtpRequest $request)
    {
        $mobile = session()->get('mobile');
        if ($mobile) {
            $user = User::where(User::MOBILE, $mobile)->where(User::MOBILE_VERIFIED_AT, true)->first();
            $otp = $request->input(OtpRequest::OTP);
            if (!is_null($user) && $user->otp == $otp) {
                $user->update([User::OTP => null]);
                session()->forget('mobile');
                if (\auth()->loginUsingId($user->getKey())) {
                    return redirect()->route('dashboard');
                }
            }
            return redirect()->back()->withErrors([OtpRequest::OTP => 'کد وارد شده صحیح نیست!']);
        }
        return redirect()->route('otp1');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt([User::MOBILE => $request->input(LoginRequest::MOBILE)], true);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended(RouteServiceProvider::DASHBOARD);
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $request->input(LoginRequest::MOBILE) => [trans('auth.failed')],
        ]);
    }

    public function generateToken(): int
    {
        return rand(1000, 9999);
    }
}
