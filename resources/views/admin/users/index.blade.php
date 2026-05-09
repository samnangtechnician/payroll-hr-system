@extends('admin.layouts.admin_layout')
@section('pageTitle', __('users.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('users.title') }}</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> {{ __('users.create') }}
    </a>
  </div>

  @include('admin.partials.datatable', [
    'id'      => 'users-table',
    'ajaxUrl' => route('admin.users.data'),
    'columns' => [
      ['data' => 'id',           'name' => 'id',          'title' => '#'],
      ['data' => 'name',         'name' => 'name',        'title' => __('users.fields.name')],
      ['data' => 'email',        'name' => 'email',       'title' => __('users.fields.email')],
      ['data' => 'username',     'name' => 'username',    'title' => __('users.fields.username')],
      ['data' => 'company_name', 'name' => 'company.name', 'title' => __('common.company'), 'orderable' => false],
      ['data' => 'roles_csv',    'name' => 'roles_csv',   'title' => __('users.fields.roles'), 'orderable' => false, 'searchable' => false],
      ['data' => 'is_active',    'name' => 'is_active',   'title' => __('common.status')],
      ['data' => 'actions',      'name' => 'actions',     'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
