@extends('admin.layouts.admin_layout')
@section('pageTitle', __('departments.create'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('departments.create') }}</h4>
    <a href="{{ route('admin.departments.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.departments.store') }}">
      @csrf
      @include('admin.departments._form')
    </form>
  </div></div>
@endsection
