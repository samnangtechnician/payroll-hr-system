@extends('admin.layouts.admin_layout')
@section('pageTitle', __('roles.edit'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('roles.edit') }}: {{ $role->name }}</h4>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.roles.update', $role) }}">@csrf @method('PUT') @include('admin.roles._form', ['role' => $role])</form>
  </div></div>
@endsection
