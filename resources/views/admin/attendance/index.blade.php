@extends('admin.layouts.admin_layout')
@section('pageTitle', __('attendance.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('attendance.title') }}</h4>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'attendance-table', 'ajaxUrl' => route('admin.attendance.data'),
    'columns' => [
      ['data' => 'id',                'name' => 'id',                'title' => '#'],
      ['data' => 'attendance_date',   'name' => 'attendance_date',   'title' => __('attendance.fields.attendance_date')],
      ['data' => 'employee_name',     'name' => 'employee.first_name', 'title' => __('common.employee'), 'orderable' => false],
      ['data' => 'shift_name',        'name' => 'shift.name',        'title' => __('attendance.fields.shift'), 'orderable' => false],
      ['data' => 'check_in_at',       'name' => 'check_in_at',       'title' => __('attendance.fields.check_in')],
      ['data' => 'check_out_at',      'name' => 'check_out_at',      'title' => __('attendance.fields.check_out')],
      ['data' => 'total_working_hours', 'name' => 'total_working_hours', 'title' => __('attendance.fields.working_hours')],
      ['data' => 'late_minutes',      'name' => 'late_minutes',      'title' => __('attendance.fields.late_minutes')],
      ['data' => 'attendance_status', 'name' => 'attendance_status', 'title' => __('common.status')],
    ],
  ])
@endsection
