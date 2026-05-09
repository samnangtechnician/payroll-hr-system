@extends('admin.layouts.admin_layout')
@section('pageTitle', __('payslips.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('payslips.title') }}</h4>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'payslips-table', 'ajaxUrl' => route('admin.payslips.data'),
    'columns' => [
      ['data' => 'id',            'name' => 'id',             'title' => '#'],
      ['data' => 'payslip_no',    'name' => 'payslip_no',     'title' => __('payslips.fields.payslip_no')],
      ['data' => 'employee_name', 'name' => 'employee.first_name', 'title' => __('common.employee'), 'orderable' => false],
      ['data' => 'period_code',   'name' => 'period.period_code', 'title' => __('payslips.fields.period'), 'orderable' => false],
      ['data' => 'net_pay',       'name' => 'item.net_amount', 'title' => __('payslips.fields.net_pay'), 'orderable' => false],
      ['data' => 'is_published',  'name' => 'is_published',   'title' => __('payslips.fields.is_published')],
      ['data' => 'issued_at',     'name' => 'issued_at',      'title' => __('payslips.fields.issued_at')],
    ],
  ])
@endsection
