@extends('admin.layouts.admin_layout')
@section('pageTitle', __('roles.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('roles.title') }}</h4>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> {{ __('roles.create') }}</a>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'roles-table', 'ajaxUrl' => route('admin.roles.data'),
    'columns' => [
      ['data' => 'id',           'name' => 'id',          'title' => '#'],
      ['data' => 'name',         'name' => 'name',        'title' => __('roles.fields.name')],
      ['data' => 'guard_name',   'name' => 'guard_name',  'title' => __('roles.fields.guard_name')],
      ['data' => 'company_name', 'name' => 'company.name','title' => __('common.company'), 'orderable' => false],
      ['data' => 'is_system',    'name' => 'is_system',   'title' => __('roles.fields.is_system')],
      ['data' => 'is_active',    'name' => 'is_active',   'title' => __('common.status')],
      ['data' => 'actions',      'name' => 'actions',     'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
