@php
    $company = $company ?? null;
    $values = old() ?: ($company ? $company->toArray() : []);
@endphp
<div class="row g-3">
  <div class="col-md-4">
    <label class="form-label">{{ __('companies.fields.country') }}</label>
    <select name="country_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($countries as $c)
        <option value="{{ $c->id }}" @selected(($values['country_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('companies.fields.currency') }}</label>
    <select name="currency_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($currencies as $c)
        <option value="{{ $c->id }}" @selected(($values['currency_id'] ?? null) == $c->id)>{{ $c->code }} — {{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('companies.fields.company_code') }}</label>
    <input type="text" name="company_code" class="form-control" value="{{ $values['company_code'] ?? '' }}">
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('companies.fields.name') }} <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $values['name'] ?? '' }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('companies.fields.legal_name') }}</label>
    <input type="text" name="legal_name" class="form-control" value="{{ $values['legal_name'] ?? '' }}">
  </div>
  <div class="col-12">
    <label class="form-label">{{ __('companies.fields.address') }}</label>
    <textarea name="address" rows="2" class="form-control">{{ $values['address'] ?? '' }}</textarea>
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('common.phone') }}</label>
    <input type="text" name="phone" class="form-control" value="{{ $values['phone'] ?? '' }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('common.email') }}</label>
    <input type="email" name="email" class="form-control" value="{{ $values['email'] ?? '' }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('companies.fields.website') }}</label>
    <input type="url" name="website" class="form-control" value="{{ $values['website'] ?? '' }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('companies.fields.tax_registration_no') }}</label>
    <input type="text" name="tax_registration_no" class="form-control" value="{{ $values['tax_registration_no'] ?? '' }}">
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('companies.fields.business_registration_no') }}</label>
    <input type="text" name="business_registration_no" class="form-control" value="{{ $values['business_registration_no'] ?? '' }}">
  </div>
  <div class="col-md-2">
    <label class="form-label">{{ __('companies.fields.fiscal_year_start_month') }}</label>
    <input type="text" name="fiscal_year_start_month" class="form-control" value="{{ $values['fiscal_year_start_month'] ?? '' }}">
  </div>
  <div class="col-md-2">
    <label class="form-label">{{ __('companies.fields.payroll_cycle') }}</label>
    <input type="text" name="payroll_cycle" class="form-control" value="{{ $values['payroll_cycle'] ?? '' }}">
  </div>
  <div class="col-md-2 d-flex align-items-end">
    <div class="form-check">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" id="is_active_company" name="is_active" value="1" class="form-check-input" @checked((bool) ($values['is_active'] ?? true))>
      <label class="form-check-label" for="is_active_company">{{ __('common.active') }}</label>
    </div>
  </div>
  <div class="col-12 d-flex justify-content-end gap-2 mt-2">
    <a href="{{ route('admin.companies.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
  </div>
</div>
