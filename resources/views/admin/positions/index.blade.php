@extends('admin.layouts.admin_layout')
@section('pageTitle', __('positions.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('positions.title') }}</h4>
    <a href="{{ route('admin.positions.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> {{ __('positions.create') }}
    </a>
  </div>

  @include('admin.partials.datatable', [
    'id'      => 'positions-table',
    'ajaxUrl' => route('admin.positions.data'),
    'columns' => [
      ['data' => 'id',              'name' => 'id',                'title' => '#'],
      ['data' => 'company_name',    'name' => 'company.name',      'title' => __('common.company'),   'orderable' => false],
      ['data' => 'department_name', 'name' => 'department.name',   'title' => __('common.department'), 'orderable' => false],
      ['data' => 'position_code',   'name' => 'position_code',     'title' => __('positions.fields.position_code')],
      ['data' => 'title',           'name' => 'title',             'title' => __('positions.fields.title')],
      ['data' => 'level',           'name' => 'level',             'title' => __('positions.fields.level')],
      ['data' => 'is_managerial',   'name' => 'is_managerial',     'title' => __('positions.fields.is_managerial')],
      ['data' => 'is_active',       'name' => 'is_active',         'title' => __('common.status')],
      ['data' => 'actions',         'name' => 'actions',           'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
