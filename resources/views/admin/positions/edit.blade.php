@extends('admin.layouts.admin_layout')
@section('pageTitle', __('positions.edit'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('positions.edit') }}: {{ $position->title }}</h4>
    <a href="{{ route('admin.positions.index') }}" class="btn btn-link ms-auto"><i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}</a>
  </div>
  <div class="card border-0 shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.positions.update', $position) }}">
      @csrf @method('PUT')
      @include('admin.positions._form', ['position' => $position])
    </form>
  </div></div>
@endsection
