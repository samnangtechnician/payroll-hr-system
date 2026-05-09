@extends('admin.layouts.admin_layout')
@section('pageTitle', __('countries.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('countries.title') }}</h4>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'countries-table', 'ajaxUrl' => route('admin.countries.data'),
    'columns' => [
      ['data' => 'id',                            'name' => 'id',                             'title' => '#'],
      ['data' => 'name',                          'name' => 'name',                           'title' => __('countries.fields.name')],
      ['data' => 'iso2',                          'name' => 'iso2',                           'title' => __('countries.fields.iso2')],
      ['data' => 'iso3',                          'name' => 'iso3',                           'title' => __('countries.fields.iso3')],
      ['data' => 'phone_code',                    'name' => 'phone_code',                     'title' => __('countries.fields.phone_code')],
      ['data' => 'is_supported_payroll_country',  'name' => 'is_supported_payroll_country',   'title' => __('countries.fields.is_supported_payroll_country')],
      ['data' => 'is_active',                     'name' => 'is_active',                      'title' => __('common.status')],
    ],
  ])
@endsection
