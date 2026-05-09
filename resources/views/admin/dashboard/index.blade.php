@extends('admin.layouts.admin_layout')

@section('pageTitle', __('dashboard.title'))

@section('content')
  <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
    <div>
      <h4 class="mb-0">{{ __('dashboard.title') }}</h4>
      <small class="text-muted">{{ __('dashboard.welcome') }}, {{ auth()->user()?->name }}</small>
    </div>
  </div>

  <div class="row g-3 mb-3">
    @foreach ([
      ['k' => 'branches',           'i' => 'bi-diagram-3', 'c' => 'primary'],
      ['k' => 'departments',        'i' => 'bi-grid-1x2',  'c' => 'info'],
      ['k' => 'employees',          'i' => 'bi-people',    'c' => 'success'],
      ['k' => 'active_employees',   'i' => 'bi-person-check', 'c' => 'warning'],
      ['k' => 'pending_leaves',     'i' => 'bi-envelope',  'c' => 'danger'],
      ['k' => 'this_month_payroll', 'i' => 'bi-cash-stack', 'c' => 'secondary'],
    ] as $card)
      <div class="col-12 col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body d-flex align-items-center gap-3">
            <div class="rounded bg-soft-{{ $card['c'] }} text-{{ $card['c'] }} d-inline-flex align-items-center justify-content-center"
                 style="width:48px;height:48px;font-size:1.5rem;">
              <i class="bi {{ $card['i'] }}"></i>
            </div>
            <div>
              <small class="text-muted d-block">{{ __('dashboard.stats.'.$card['k']) }}</small>
              <h4 class="mb-0">
                @if ($card['k'] === 'this_month_payroll')
                  {{ number_format((float) ($stats[$card['k']] ?? 0), 2) }}
                @else
                  {{ number_format((int) ($stats[$card['k']] ?? 0)) }}
                @endif
              </h4>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="row g-3">
    <div class="col-12 col-xl-7">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-transparent">
          <h6 class="mb-0">{{ __('dashboard.recent_employees') }}</h6>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th>{{ __('employees.fields.employee_code') }}</th>
                  <th>{{ __('employees.fields.first_name') }}</th>
                  <th>{{ __('common.branch') }}</th>
                  <th>{{ __('common.department') }}</th>
                  <th>{{ __('common.position') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentEmployees as $emp)
                  <tr>
                    <td>{{ $emp->employee_code }}</td>
                    <td>{{ trim($emp->first_name.' '.$emp->last_name) }}</td>
                    <td>{{ $emp->branch?->name ?? '—' }}</td>
                    <td>{{ $emp->department?->name ?? '—' }}</td>
                    <td>{{ $emp->position?->title ?? '—' }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                      {{ __('common.no_results') }}
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-xl-5">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-header bg-transparent">
          <h6 class="mb-0">{{ __('dashboard.branch_distribution') }}</h6>
        </div>
        <div class="card-body p-0">
          <div class="list-group list-group-flush">
            @forelse ($branchDistribution as $branch)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                  <i class="bi bi-diagram-3 me-2 text-muted"></i>
                  {{ $branch->name }}
                </span>
                <span class="badge bg-soft-primary">
                  {{ $branch->employees_count }}
                </span>
              </div>
            @empty
              <div class="list-group-item text-center text-muted py-4">
                {{ __('common.no_results') }}
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
