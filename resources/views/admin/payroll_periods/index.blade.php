@extends('admin.layouts.admin_layout')
@section('pageTitle', __('payroll_periods.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('payroll_periods.title') }}</h4>
    <a href="{{ route('admin.payroll-periods.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> {{ __('payroll_periods.create') }}</a>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'payroll-periods-table', 'ajaxUrl' => route('admin.payroll-periods.data'),
    'columns' => [
      ['data' => 'id',           'name' => 'id',           'title' => '#'],
      ['data' => 'period_code',  'name' => 'period_code',  'title' => __('payroll_periods.fields.period_code')],
      ['data' => 'company_name', 'name' => 'company.name', 'title' => __('common.company'), 'orderable' => false],
      ['data' => 'start_date',   'name' => 'start_date',   'title' => __('payroll_periods.fields.start_date')],
      ['data' => 'end_date',     'name' => 'end_date',     'title' => __('payroll_periods.fields.end_date')],
      ['data' => 'payment_date', 'name' => 'payment_date', 'title' => __('payroll_periods.fields.payment_date')],
      ['data' => 'status',       'name' => 'status',       'title' => __('common.status')],
      ['data' => 'actions',      'name' => 'actions',      'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
