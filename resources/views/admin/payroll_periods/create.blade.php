@extends('admin.layouts.admin_layout')
@section('pageTitle', __('payroll_periods.create'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('payroll_periods.create') }}</h4>
    <a href="{{ route('admin.payroll-periods.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.payroll-periods.store') }}">@csrf @include('admin.payroll_periods._form')</form>
  </div></div>
@endsection
