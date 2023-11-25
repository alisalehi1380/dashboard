@extends('auth.layouts.app')
@section('title' , 'ورود')
@php
  use App\Http\Controllers\Auth\Requests\RegisterRequest;
@endphp
@section('content')
  <div class="row">
    <div class="col-lg-4 col-md-8 col-12 mx-auto">
      <div class="card z-index-0 fadeIn3 fadeInBottom">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
            <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">ثبت نام</h4>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('register.post') }}" method="post" role="form" class="text-start">
            @csrf
            <div class="input-group input-group-outline my-3">
              <label class="form-label">نام</label>
              <input type="{{ RegisterRequest::FIRST_NAME }}" class="form-control @error(RegisterRequest::FIRST_NAME) is-invalid @enderror" name="{{ RegisterRequest::FIRST_NAME }}" required>
              @error(RegisterRequest::FIRST_NAME)
              <span class="invalid-feedback" role="alert" style="text-align: right"><strong>{{ $message }}</strong></span>@enderror
            </div>
            <div class="input-group input-group-outline my-3">
              <label class="form-label">نام خانوادگی</label>
              <input type="{{ RegisterRequest::LAST_NAME }}" class="form-control @error(RegisterRequest::LAST_NAME) is-invalid @enderror" name="{{ RegisterRequest::LAST_NAME }}" required>
              @error(RegisterRequest::LAST_NAME)
              <span class="invalid-feedback" role="alert" style="text-align: right"><strong>{{ $message }}</strong></span>@enderror
            </div>
            <div class="input-group input-group-outline my-3">
              <label class="form-label">شماره موبایل</label>
              <input type="number" class="form-control @error(RegisterRequest::MOBILE) is-invalid @enderror" name="{{ RegisterRequest::MOBILE }}" required>
              @error(RegisterRequest::MOBILE)
              <span class="invalid-feedback" role="alert" style="text-align: right"><strong>{{ $message }}</strong></span>@enderror
            </div>
            <div class="text-center">
              <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">ثبت نام</button>
            </div>
            <p class="mt-4 text-sm text-center">
              اکانت دارید؟
              <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold me-1">ورود</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection