@extends('admin.layouts.admin_layout')
@section('pageTitle', __('users.edit'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('users.edit') }}: {{ $user->name }}</h4>
    <a href="{{ route('admin.users.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
      @csrf @method('PUT')
      @include('admin.users._form', ['user' => $user])
    </form>
  </div></div>
@endsection
