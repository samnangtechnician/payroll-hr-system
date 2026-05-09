@extends('admin.layouts.admin_layout')
@section('pageTitle', __('companies.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('companies.title') }}</h4>
    <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> {{ __('companies.create') }}
    </a>
  </div>

  @include('admin.partials.datatable', [
    'id'      => 'companies-table',
    'ajaxUrl' => route('admin.companies.data'),
    'columns' => [
      ['data' => 'id',            'name' => 'id',                 'title' => '#'],
      ['data' => 'company_code',  'name' => 'company_code',       'title' => __('companies.fields.company_code')],
      ['data' => 'name',          'name' => 'name',               'title' => __('companies.fields.name')],
      ['data' => 'legal_name',    'name' => 'legal_name',         'title' => __('companies.fields.legal_name')],
      ['data' => 'country_name',  'name' => 'country.name',       'title' => __('common.country'),  'orderable' => false],
      ['data' => 'currency_code', 'name' => 'currency.code',      'title' => __('common.currency'), 'orderable' => false],
      ['data' => 'phone',         'name' => 'phone',              'title' => __('common.phone')],
      ['data' => 'is_active',     'name' => 'is_active',          'title' => __('common.status')],
      ['data' => 'actions',       'name' => 'actions',            'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
