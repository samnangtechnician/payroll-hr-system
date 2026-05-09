@extends('admin.layouts.admin_layout')
@section('pageTitle', __('payroll_runs.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('payroll_runs.title') }}</h4>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'payroll-runs-table', 'ajaxUrl' => route('admin.payroll-runs.data'),
    'columns' => [
      ['data' => 'id',              'name' => 'id',           'title' => '#'],
      ['data' => 'payroll_no',      'name' => 'payroll_no',   'title' => __('payroll_runs.fields.payroll_no')],
      ['data' => 'period_code',     'name' => 'period.period_code', 'title' => __('payroll_runs.fields.period'), 'orderable' => false],
      ['data' => 'country_name',    'name' => 'country.name', 'title' => __('common.country'), 'orderable' => false],
      ['data' => 'gross_amount',    'name' => 'gross_amount', 'title' => __('payroll_runs.fields.gross_amount')],
      ['data' => 'total_deduction', 'name' => 'total_deduction', 'title' => __('payroll_runs.fields.total_deduction')],
      ['data' => 'net_amount',      'name' => 'net_amount',   'title' => __('payroll_runs.fields.net_amount')],
      ['data' => 'status',          'name' => 'status',       'title' => __('common.status')],
      ['data' => 'approved_at',     'name' => 'approved_at',  'title' => __('payroll_runs.fields.approved_at')],
    ],
  ])
@endsection
