@extends('admin.layouts.admin_layout')
@section('pageTitle', __('currencies.title'))
@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <h4 class="mb-0">{{ __('currencies.title') }}</h4>
  </div>
  @include('admin.partials.datatable', [
    'id' => 'currencies-table', 'ajaxUrl' => route('admin.currencies.data'),
    'columns' => [
      ['data' => 'id',          'name' => 'id',          'title' => '#'],
      ['data' => 'code',        'name' => 'code',        'title' => __('currencies.fields.code')],
      ['data' => 'name',        'name' => 'name',        'title' => __('currencies.fields.name')],
      ['data' => 'symbol',      'name' => 'symbol',      'title' => __('currencies.fields.symbol')],
      ['data' => 'decimal_places', 'name' => 'decimal_places', 'title' => __('currencies.fields.decimal_places')],
      ['data' => 'is_active',   'name' => 'is_active',   'title' => __('common.status')],
    ],
  ])
@endsection
