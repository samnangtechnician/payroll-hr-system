@extends('layouts.auth')

@section('pageTitle', __('auth.login'))

@section('content')
  <div class="card shadow-sm border-0">
    <div class="card-body p-4 p-md-5">
      <div class="text-center mb-4">
        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white mb-3"
             style="width:56px;height:56px;font-size:1.4rem;">
          <i class="bi bi-shield-lock"></i>
        </div>
        <h4 class="mb-1">{{ __('app.name') }}</h4>
        <p class="text-muted mb-0">{{ __('auth.login_to_account') }}</p>
      </div>

      <form method="POST" action="{{ route('login.attempt') }}" novalidate>
        @csrf

        <div class="mb-3">
          <label class="form-label" for="email">{{ __('auth.email') }}</label>
          <input type="email" name="email" id="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email') }}" required autofocus>
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="password">{{ __('auth.password') }}</label>
          <input type="password" name="password" id="password"
                 class="form-control @error('password') is-invalid @enderror" required>
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-check mb-3">
          <input type="checkbox" name="remember" id="remember" class="form-check-input">
          <label class="form-check-label" for="remember">{{ __('auth.remember_me') }}</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">
          <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('auth.sign_in') }}
        </button>
      </form>

      <div class="text-center mt-4 small text-muted">
        <div class="d-inline-flex gap-2 align-items-center">
          <form method="POST" action="{{ route('locale.store') }}" class="m-0 p-0">
            @csrf
            <input type="hidden" name="locale" value="en">
            <button type="submit"
                    class="btn btn-link btn-sm text-muted p-0 border-0 align-baseline{{ app()->getLocale() === 'en' ? ' fw-semibold' : '' }}">
              English
            </button>
          </form>
          <span>|</span>
          <form method="POST" action="{{ route('locale.store') }}" class="m-0 p-0">
            @csrf
            <input type="hidden" name="locale" value="km">
            <button type="submit" lang="km"
                    class="btn btn-link btn-sm text-muted p-0 border-0 align-baseline{{ app()->getLocale() === 'km' ? ' fw-semibold' : '' }}">
              ខ្មែរ
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
