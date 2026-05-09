@extends('admin.layouts.admin_layout')
@section('pageTitle', __('employees.create'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('employees.create') }}</h4>
    <a href="{{ route('admin.employees.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.employees.store') }}" enctype="multipart/form-data">
      @csrf
      @include('admin.employees._form')
    </form>
  </div></div>
@endsection
