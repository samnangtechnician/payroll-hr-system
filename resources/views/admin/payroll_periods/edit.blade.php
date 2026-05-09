@extends('admin.layouts.admin_layout')
@section('pageTitle', __('payroll_periods.edit'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('payroll_periods.edit') }}: {{ $payrollPeriod->period_code }}</h4>
    <a href="{{ route('admin.payroll-periods.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.payroll-periods.update', $payrollPeriod) }}">@csrf @method('PUT') @include('admin.payroll_periods._form', ['payrollPeriod' => $payrollPeriod])</form>
  </div></div>
@endsection
