@extends('admin.layouts.admin_layout')
@section('pageTitle', __('shifts.edit'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('shifts.edit') }}: {{ $shift->name }}</h4>
    <a href="{{ route('admin.shifts.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.shifts.update', $shift) }}">@csrf @method('PUT') @include('admin.shifts._form', ['shift' => $shift])</form>
  </div></div>
@endsection
