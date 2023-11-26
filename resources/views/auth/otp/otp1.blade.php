@extends('auth.layouts.app')
@section('title' , 'ورود با رمز یکبار مصرف')
@php
    use \App\Http\Controllers\Auth\Requests\OtpRequest
@endphp
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">ورود با رمز یکبار مصرف</h4>
                    </div>
                </div>
                @dump(session()->all())
                <div class="card-body">
                    <form role="form" class="text-start" method="post" action="{{ route('otp1.post') }}">
                        @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">شماره موبایل خود را وارد کنید</label>
                            <input type="number" class="form-control @error(OtpRequest::MOBILE) is-invalid @enderror" name="{{ OtpRequest::MOBILE }}" required>
                            @error(OtpRequest::MOBILE)
                            <span class="invalid-feedback" role="alert" style="text-align: right"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">ورود</button>
                        </div>
                    </form>
                    <p class="mt-2 text-sm text-center">
                        اکانتی ندارید؟
                        <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold me-1">ثبت نام</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
