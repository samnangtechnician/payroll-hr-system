@php
    $publicHoliday = $publicHoliday ?? null;
    $values = old() ?: ($publicHoliday ? $publicHoliday->toArray() : []);
@endphp
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">{{ __('public_holidays.fields.company') }}</label>
    <select name="company_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($companies as $c)
        <option value="{{ $c->id }}" @selected(($values['company_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('public_holidays.fields.country') }}</label>
    <select name="country_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($countries as $c)
        <option value="{{ $c->id }}" @selected(($values['country_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-8">
    <label class="form-label">{{ __('public_holidays.fields.name') }} <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $values['name'] ?? '' }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('public_holidays.fields.holiday_date') }} <span class="text-danger">*</span></label>
    <input type="text" name="holiday_date" class="form-control flatpickr-date" value="{{ $values['holiday_date'] ?? '' }}" required>
  </div>
  <div class="col-md-12">
    <div class="form-check">
      <input type="hidden" name="is_recurring" value="0">
      <input type="checkbox" id="ph_recur" name="is_recurring" value="1" class="form-check-input" @checked((bool) ($values['is_recurring'] ?? false))>
      <label class="form-check-label" for="ph_recur">{{ __('public_holidays.fields.is_recurring') }}</label>
    </div>
  </div>
  <div class="col-12">
    <label class="form-label">{{ __('public_holidays.fields.description') }}</label>
    <textarea name="description" rows="2" class="form-control">{{ $values['description'] ?? '' }}</textarea>
  </div>
  <div class="col-12 d-flex justify-content-end gap-2 mt-2">
    <a href="{{ route('admin.public-holidays.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
  </div>
</div>
