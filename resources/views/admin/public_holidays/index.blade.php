@extends('admin.layouts.admin_layout')
@section('pageTitle', __('public_holidays.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('public_holidays.title') }}</h4>
    <a href="{{ route('admin.public-holidays.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> {{ __('public_holidays.create') }}</a>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'holidays-table', 'ajaxUrl' => route('admin.public-holidays.data'),
    'columns' => [
      ['data' => 'id',           'name' => 'id',           'title' => '#'],
      ['data' => 'name',         'name' => 'name',         'title' => __('public_holidays.fields.name')],
      ['data' => 'holiday_date', 'name' => 'holiday_date', 'title' => __('public_holidays.fields.holiday_date')],
      ['data' => 'company_name', 'name' => 'company.name', 'title' => __('common.company'), 'orderable' => false],
      ['data' => 'country_name', 'name' => 'country.name', 'title' => __('common.country'), 'orderable' => false],
      ['data' => 'is_recurring', 'name' => 'is_recurring', 'title' => __('public_holidays.fields.is_recurring')],
      ['data' => 'actions',      'name' => 'actions',      'title' => __('common.actions'), 'orderable' => false, 'searchable' => false],
    ],
  ])
@endsection
