@extends('admin.layouts.admin_layout')

@section('pageTitle', __('branches.edit'))

@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ __('branches.edit') }}: {{ $branch->name }}</h4>
    <a href="{{ route('admin.branches.index') }}" class="btn btn-link ms-auto">
      <i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}
    </a>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <form method="POST" action="{{ route('admin.branches.update', $branch) }}">
        @csrf
        @method('PUT')
        @include('admin.branches._form', ['branch' => $branch])
      </form>
    </div>
  </div>
@endsection
