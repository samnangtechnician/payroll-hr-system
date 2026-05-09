@extends('admin.layouts.admin_layout')
@section('pageTitle', __('departments.edit'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('departments.edit') }}: {{ $department->name }}</h4>
    <a href="{{ route('admin.departments.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.departments.update', $department) }}">
      @csrf @method('PUT')
      @include('admin.departments._form', ['department' => $department])
    </form>
  </div></div>
@endsection
