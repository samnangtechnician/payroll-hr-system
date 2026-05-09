@extends('admin.layouts.admin_layout')
@section('pageTitle', __('leave_requests.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('leave_requests.title') }}</h4>
    <a href="{{ route('admin.leave-requests.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> {{ __('leave_requests.create') }}</a>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'leave-requests-table', 'ajaxUrl' => route('admin.leave-requests.data'),
    'columns' => [
      ['data' => 'id',                'name' => 'id',                  'title' => '#'],
      ['data' => 'leave_no',          'name' => 'leave_no',            'title' => __('leave_requests.fields.leave_no')],
      ['data' => 'employee_name',     'name' => 'employee.first_name', 'title' => __('leave_requests.fields.employee'), 'orderable' => false],
      ['data' => 'leave_type_name',   'name' => 'leaveType.name',      'title' => __('leave_requests.fields.leave_type'), 'orderable' => false],
      ['data' => 'start_date',        'name' => 'start_date',          'title' => __('leave_requests.fields.start_date')],
      ['data' => 'end_date',          'name' => 'end_date',            'title' => __('leave_requests.fields.end_date')],
      ['data' => 'total_days',        'name' => 'total_days',          'title' => __('leave_requests.fields.total_days')],
      ['data' => 'status',            'name' => 'status',              'title' => __('common.status')],
      ['data' => 'actions',           'name' => 'actions',             'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
