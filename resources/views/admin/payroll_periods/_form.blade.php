@php
    $payrollPeriod = $payrollPeriod ?? null;
    $values = old() ?: ($payrollPeriod ? $payrollPeriod->toArray() : []);
@endphp
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">{{ __('payroll_periods.fields.company') }} <span class="text-danger">*</span></label>
    <select name="company_id" class="form-select tom-select" required>
      <option value="">{{ __('common.select') }}</option>
      @foreach ($companies as $c)
        <option value="{{ $c->id }}" @selected(($values['company_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('payroll_periods.fields.country') }}</label>
    <select name="country_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($countries as $c)
        <option value="{{ $c->id }}" @selected(($values['country_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <label class="form-label">{{ __('payroll_periods.fields.period_code') }} <span class="text-danger">*</span></label>
    <input type="text" name="period_code" class="form-control @error('period_code') is-invalid @enderror" value="{{ $values['period_code'] ?? '' }}" required>
    @error('period_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-3">
    <label class="form-label">{{ __('payroll_periods.fields.start_date') }} <span class="text-danger">*</span></label>
    <input type="text" name="start_date" class="form-control flatpickr-date" value="{{ $values['start_date'] ?? '' }}" required>
  </div>
  <div class="col-md-3">
    <label class="form-label">{{ __('payroll_periods.fields.end_date') }} <span class="text-danger">*</span></label>
    <input type="text" name="end_date" class="form-control flatpickr-date" value="{{ $values['end_date'] ?? '' }}" required>
  </div>
  <div class="col-md-3">
    <label class="form-label">{{ __('payroll_periods.fields.payment_date') }}</label>
    <input type="text" name="payment_date" class="form-control flatpickr-date" value="{{ $values['payment_date'] ?? '' }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('common.status') }} <span class="text-danger">*</span></label>
    <select name="status" class="form-select tom-select" required>
      @foreach ($statuses as $s)
        <option value="{{ $s }}" @selected(($values['status'] ?? 'open') === $s)>{{ __('payroll_periods.status.'.$s) }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-12 d-flex justify-content-end gap-2 mt-2">
    <a href="{{ route('admin.payroll-periods.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
  </div>
</div>
