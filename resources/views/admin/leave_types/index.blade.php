@extends('admin.layouts.admin_layout')
@section('pageTitle', __('leave_types.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('leave_types.title') }}</h4>
    <a href="{{ route('admin.leave-types.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> {{ __('leave_types.create') }}</a>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'leave-types-table', 'ajaxUrl' => route('admin.leave-types.data'),
    'columns' => [
      ['data' => 'id',          'name' => 'id',          'title' => '#'],
      ['data' => 'name',        'name' => 'name',        'title' => __('leave_types.fields.name')],
      ['data' => 'code',        'name' => 'code',        'title' => __('leave_types.fields.code')],
      ['data' => 'company_name', 'name' => 'company.name', 'title' => __('common.company'), 'orderable' => false],
      ['data' => 'default_entitlement_days', 'name' => 'default_entitlement_days', 'title' => __('leave_types.fields.default_entitlement_days')],
      ['data' => 'is_paid',     'name' => 'is_paid',     'title' => __('leave_types.fields.is_paid')],
      ['data' => 'is_active',   'name' => 'is_active',   'title' => __('common.status')],
      ['data' => 'actions',     'name' => 'actions',     'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
