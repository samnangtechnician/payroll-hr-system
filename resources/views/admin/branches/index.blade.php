@extends('admin.layouts.admin_layout')

@section('pageTitle', __('branches.title'))

@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('branches.title') }}</h4>
    <a href="{{ route('admin.branches.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> {{ __('branches.create') }}
    </a>
  </div>

  @include('admin.partials.datatable', [
    'id'      => 'branches-table',
    'ajaxUrl' => route('admin.branches.data'),
    'columns' => [
      ['data' => 'id',             'name' => 'id',                   'title' => '#'],
      ['data' => 'company_name',   'name' => 'company.name',         'title' => __('common.company'),       'orderable' => false],
      ['data' => 'branch_code',    'name' => 'branch_code',          'title' => __('branches.fields.branch_code')],
      ['data' => 'name',           'name' => 'name',                 'title' => __('branches.fields.name')],
      ['data' => 'country_name',   'name' => 'country.name',         'title' => __('common.country'),       'orderable' => false],
      ['data' => 'phone',          'name' => 'phone',                'title' => __('common.phone')],
      ['data' => 'is_head_office', 'name' => 'is_head_office',       'title' => __('common.is_head_office')],
      ['data' => 'is_active',      'name' => 'is_active',            'title' => __('common.status')],
      ['data' => 'actions',        'name' => 'actions',              'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
    'orderColumn' => 0,
    'orderDir'    => 'desc',
  ])
@endsection
