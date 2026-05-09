@extends('admin.layouts.admin_layout')
@section('pageTitle', __('employees.title'))
@section('content')
  <div class="d-flex align-items-center mb-3">
    <h4 class="mb-0">{{ trim($employee->first_name.' '.$employee->last_name) }}</h4>
    <div class="ms-auto d-flex gap-2">
      <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-primary">
        <i class="bi bi-pencil me-1"></i> {{ __('common.edit') }}
      </a>
      <a href="{{ route('admin.employees.index') }}" class="btn btn-light">
        <i class="bi bi-arrow-left me-1"></i> {{ __('common.back') }}
      </a>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
          @if ($employee->profile_photo_path)
            <img src="{{ asset('storage/'.$employee->profile_photo_path) }}" class="rounded-circle mb-3" style="width:120px;height:120px;object-fit:cover;">
          @else
            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                 style="width:120px;height:120px;font-size:2.5rem;font-weight:700;">
              {{ strtoupper(mb_substr($employee->first_name ?? 'E', 0, 1)) }}
            </div>
          @endif
          <h5 class="mb-1">{{ trim($employee->first_name.' '.$employee->last_name) }}</h5>
          <p class="text-muted mb-2">{{ $employee->employee_code }}</p>
          <span class="badge bg-soft-primary">{{ $employee->status }}</span>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent"><h6 class="mb-0">{{ __('employees.tabs.personal') }}</h6></div>
        <div class="card-body">
          <dl class="row mb-0">
            <dt class="col-sm-4 text-muted">{{ __('common.email') }}</dt><dd class="col-sm-8">{{ $employee->email ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('common.phone') }}</dt><dd class="col-sm-8">{{ $employee->phone ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('employees.fields.gender') }}</dt><dd class="col-sm-8">{{ $employee->gender ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('employees.fields.date_of_birth') }}</dt><dd class="col-sm-8">{{ optional($employee->date_of_birth)->format('Y-m-d') ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('common.country') }}</dt><dd class="col-sm-8">{{ $employee->country?->name ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('employees.fields.national_id_no') }}</dt><dd class="col-sm-8">{{ $employee->national_id_no ?? '—' }}</dd>
          </dl>
        </div>
      </div>

      <div class="card border-0 shadow-sm mt-3">
        <div class="card-header bg-transparent"><h6 class="mb-0">{{ __('employees.tabs.employment') }}</h6></div>
        <div class="card-body">
          <dl class="row mb-0">
            <dt class="col-sm-4 text-muted">{{ __('common.company') }}</dt><dd class="col-sm-8">{{ $employee->company?->name ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('common.branch') }}</dt><dd class="col-sm-8">{{ $employee->branch?->name ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('common.department') }}</dt><dd class="col-sm-8">{{ $employee->department?->name ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('common.position') }}</dt><dd class="col-sm-8">{{ $employee->position?->title ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('employees.fields.join_date') }}</dt><dd class="col-sm-8">{{ optional($employee->join_date)->format('Y-m-d') ?? '—' }}</dd>
            <dt class="col-sm-4 text-muted">{{ __('employees.fields.basic_salary') }}</dt><dd class="col-sm-8">{{ $employee->basic_salary ? number_format((float) $employee->basic_salary, 2) : '—' }} {{ $employee->salaryCurrency?->code }}</dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
@endsection
