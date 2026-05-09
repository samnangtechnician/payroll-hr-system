@extends('admin.layouts.admin_layout')
@section('pageTitle', __('shifts.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('shifts.title') }}</h4>
    <a href="{{ route('admin.shifts.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> {{ __('shifts.create') }}</a>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'shifts-table', 'ajaxUrl' => route('admin.shifts.data'),
    'columns' => [
      ['data' => 'id',           'name' => 'id',          'title' => '#'],
      ['data' => 'name',         'name' => 'name',        'title' => __('shifts.fields.name')],
      ['data' => 'shift_code',   'name' => 'shift_code',  'title' => __('shifts.fields.shift_code')],
      ['data' => 'company_name', 'name' => 'company.name','title' => __('common.company'), 'orderable' => false],
      ['data' => 'start_time',   'name' => 'start_time',  'title' => __('shifts.fields.start_time')],
      ['data' => 'end_time',     'name' => 'end_time',    'title' => __('shifts.fields.end_time')],
      ['data' => 'is_night_shift','name' => 'is_night_shift', 'title' => __('shifts.fields.is_night_shift')],
      ['data' => 'is_active',    'name' => 'is_active',   'title' => __('common.status')],
      ['data' => 'actions',      'name' => 'actions',     'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
