@php
    $section = function (string $route): bool {
        return request()->routeIs($route);
    };

    $sectionStarts = function (string $prefix): bool {
        return request()->routeIs($prefix.'*');
    };
@endphp

<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <h5 class="logo-text mb-0">{{ __('app.name') }}</h5>
      <small class="text-muted">{{ __('app.tagline') }}</small>
    </div>
    <div class="toggle-icon ms-auto">
      <i class="bi bi-list"></i>
    </div>
  </div>

  <ul class="metismenu" id="menu">
    <li class="{{ $section('admin.dashboard') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.dashboard') }}">
        <div class="parent-icon"><i class="bi bi-speedometer2"></i></div>
        <div class="menu-title">{{ __('menu.dashboard') }}</div>
      </a>
    </li>

    <li class="menu-label pt-3 px-3 text-muted small text-uppercase">
      {{ __('menu.organization') }}
    </li>
    <li class="{{ $sectionStarts('admin.companies') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.companies.index') }}">
        <div class="parent-icon"><i class="bi bi-building"></i></div>
        <div class="menu-title">{{ __('menu.companies') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.branches') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.branches.index') }}">
        <div class="parent-icon"><i class="bi bi-diagram-3"></i></div>
        <div class="menu-title">{{ __('menu.branches') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.departments') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.departments.index') }}">
        <div class="parent-icon"><i class="bi bi-grid-1x2"></i></div>
        <div class="menu-title">{{ __('menu.departments') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.positions') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.positions.index') }}">
        <div class="parent-icon"><i class="bi bi-tag"></i></div>
        <div class="menu-title">{{ __('menu.positions') }}</div>
      </a>
    </li>

    <li class="menu-label pt-3 px-3 text-muted small text-uppercase">
      {{ __('menu.people') }}
    </li>
    <li class="{{ $sectionStarts('admin.employees') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.employees.index') }}">
        <div class="parent-icon"><i class="bi bi-people"></i></div>
        <div class="menu-title">{{ __('menu.employees') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.users') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.users.index') }}">
        <div class="parent-icon"><i class="bi bi-person-badge"></i></div>
        <div class="menu-title">{{ __('menu.users') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.roles') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.roles.index') }}">
        <div class="parent-icon"><i class="bi bi-shield-lock"></i></div>
        <div class="menu-title">{{ __('menu.roles') }}</div>
      </a>
    </li>

    <li class="menu-label pt-3 px-3 text-muted small text-uppercase">
      {{ __('menu.attendance') }}
    </li>
    <li class="{{ $sectionStarts('admin.shifts') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.shifts.index') }}">
        <div class="parent-icon"><i class="bi bi-clock-history"></i></div>
        <div class="menu-title">{{ __('menu.shifts') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.public-holidays') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.public-holidays.index') }}">
        <div class="parent-icon"><i class="bi bi-calendar-event"></i></div>
        <div class="menu-title">{{ __('menu.public_holidays') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.attendance') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.attendance.index') }}">
        <div class="parent-icon"><i class="bi bi-check2-square"></i></div>
        <div class="menu-title">{{ __('menu.attendance_records') }}</div>
      </a>
    </li>

    <li class="menu-label pt-3 px-3 text-muted small text-uppercase">
      {{ __('menu.leave') }}
    </li>
    <li class="{{ $sectionStarts('admin.leave-types') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.leave-types.index') }}">
        <div class="parent-icon"><i class="bi bi-bookmark"></i></div>
        <div class="menu-title">{{ __('menu.leave_types') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.leave-requests') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.leave-requests.index') }}">
        <div class="parent-icon"><i class="bi bi-envelope-open"></i></div>
        <div class="menu-title">{{ __('menu.leave_requests') }}</div>
      </a>
    </li>

    <li class="menu-label pt-3 px-3 text-muted small text-uppercase">
      {{ __('menu.payroll') }}
    </li>
    <li class="{{ $sectionStarts('admin.payroll-periods') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.payroll-periods.index') }}">
        <div class="parent-icon"><i class="bi bi-calendar3"></i></div>
        <div class="menu-title">{{ __('menu.payroll_periods') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.payroll-runs') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.payroll-runs.index') }}">
        <div class="parent-icon"><i class="bi bi-cash-stack"></i></div>
        <div class="menu-title">{{ __('menu.payroll_runs') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.payslips') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.payslips.index') }}">
        <div class="parent-icon"><i class="bi bi-receipt"></i></div>
        <div class="menu-title">{{ __('menu.payslips') }}</div>
      </a>
    </li>

    <li class="menu-label pt-3 px-3 text-muted small text-uppercase">
      {{ __('menu.settings') }}
    </li>
    <li class="{{ $sectionStarts('admin.countries') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.countries.index') }}">
        <div class="parent-icon"><i class="bi bi-globe2"></i></div>
        <div class="menu-title">{{ __('menu.countries') }}</div>
      </a>
    </li>
    <li class="{{ $sectionStarts('admin.currencies') ? 'mm-active' : '' }}">
      <a href="{{ route('admin.currencies.index') }}">
        <div class="parent-icon"><i class="bi bi-currency-exchange"></i></div>
        <div class="menu-title">{{ __('menu.currencies') }}</div>
      </a>
    </li>
  </ul>
</aside>
