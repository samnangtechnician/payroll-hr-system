@extends('admin.layouts.admin_layout')
@section('pageTitle', __('employees.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('employees.title') }}</h4>
    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> {{ __('employees.create') }}
    </a>
  </div>

  @include('admin.partials.datatable', [
    'id'      => 'employees-table',
    'ajaxUrl' => route('admin.employees.data'),
    'columns' => [
      ['data' => 'id',                'name' => 'id',                  'title' => '#'],
      ['data' => 'employee_code',     'name' => 'employee_code',       'title' => __('employees.fields.employee_code')],
      ['data' => 'full_name',         'name' => 'first_name',          'title' => __('employees.fields.full_name')],
      ['data' => 'company_name',      'name' => 'company.name',        'title' => __('common.company'),    'orderable' => false],
      ['data' => 'branch_name',       'name' => 'branch.name',         'title' => __('common.branch'),     'orderable' => false],
      ['data' => 'department_name',   'name' => 'department.name',     'title' => __('common.department'), 'orderable' => false],
      ['data' => 'position_title',    'name' => 'position.title',      'title' => __('common.position'),   'orderable' => false],
      ['data' => 'basic_salary',      'name' => 'basic_salary',        'title' => __('employees.fields.basic_salary')],
      ['data' => 'status',            'name' => 'status',              'title' => __('common.status')],
      ['data' => 'actions',           'name' => 'actions',             'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
