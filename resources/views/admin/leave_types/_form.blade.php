@php
    $leaveType = $leaveType ?? null;
    $values = old() ?: ($leaveType ? $leaveType->toArray() : []);
@endphp
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">{{ __('leave_types.fields.company') }}</label>
    <select name="company_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($companies as $c)
        <option value="{{ $c->id }}" @selected(($values['company_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('leave_types.fields.country') }}</label>
    <select name="country_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($countries as $c)
        <option value="{{ $c->id }}" @selected(($values['country_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-8">
    <label class="form-label">{{ __('leave_types.fields.name') }} <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $values['name'] ?? '' }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('leave_types.fields.code') }}</label>
    <input type="text" name="code" class="form-control" value="{{ $values['code'] ?? '' }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('leave_types.fields.default_entitlement_days') }}</label>
    <input type="number" step="0.5" min="0" name="default_entitlement_days" class="form-control" value="{{ $values['default_entitlement_days'] ?? '' }}">
  </div>
  <div class="col-md-2 d-flex align-items-end">
    <div class="form-check">
      <input type="hidden" name="is_paid" value="0">
      <input type="checkbox" id="lt_is_paid" name="is_paid" value="1" class="form-check-input" @checked((bool) ($values['is_paid'] ?? true))>
      <label class="form-check-label" for="lt_is_paid">{{ __('leave_types.fields.is_paid') }}</label>
    </div>
  </div>
  <div class="col-md-3 d-flex align-items-end">
    <div class="form-check">
      <input type="hidden" name="allow_half_day" value="0">
      <input type="checkbox" id="lt_allow_half_day" name="allow_half_day" value="1" class="form-check-input" @checked((bool) ($values['allow_half_day'] ?? false))>
      <label class="form-check-label" for="lt_allow_half_day">{{ __('leave_types.fields.allow_half_day') }}</label>
    </div>
  </div>
  <div class="col-md-3 d-flex align-items-end">
    <div class="form-check">
      <input type="hidden" name="requires_attachment" value="0">
      <input type="checkbox" id="lt_requires_attachment" name="requires_attachment" value="1" class="form-check-input" @checked((bool) ($values['requires_attachment'] ?? false))>
      <label class="form-check-label" for="lt_requires_attachment">{{ __('leave_types.fields.requires_attachment') }}</label>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-check">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" id="lt_is_active" name="is_active" value="1" class="form-check-input" @checked((bool) ($values['is_active'] ?? true))>
      <label class="form-check-label" for="lt_is_active">{{ __('common.active') }}</label>
    </div>
  </div>
  <div class="col-12 d-flex justify-content-end gap-2 mt-2">
    <a href="{{ route('admin.leave-types.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
  </div>
</div>
