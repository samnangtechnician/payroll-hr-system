@extends('admin.layouts.admin_layout')

@section('pageTitle', __('departments.title'))

@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('departments.title') }}</h4>
    <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> {{ __('departments.create') }}
    </a>
  </div>

  @include('admin.partials.datatable', [
    'id'      => 'departments-table',
    'ajaxUrl' => route('admin.departments.data'),
    'columns' => [
      ['data' => 'id',               'name' => 'id',                 'title' => '#'],
      ['data' => 'company_name',     'name' => 'company.name',       'title' => __('common.company'), 'orderable' => false],
      ['data' => 'branch_name',      'name' => 'branch.name',        'title' => __('common.branch'),  'orderable' => false],
      ['data' => 'department_code',  'name' => 'department_code',    'title' => __('common.code')],
      ['data' => 'name',             'name' => 'name',               'title' => __('common.name')],
      ['data' => 'manager_name',     'name' => 'manager.first_name', 'title' => __('common.manager'), 'orderable' => false],
      ['data' => 'is_active',        'name' => 'is_active',          'title' => __('common.status')],
      ['data' => 'created_at',       'name' => 'created_at',         'title' => __('common.created_at')],
      ['data' => 'actions',          'name' => 'actions',            'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
