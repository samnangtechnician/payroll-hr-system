@php
    /** @var \App\Models\Branch|null $branch */
    $branch = $branch ?? null;
    $values = old() ?: ($branch ? $branch->toArray() : []);
@endphp

<div class="row g-3">
  <div class="col-12 col-md-6">
    <label class="form-label" for="company_id">{{ __('branches.fields.company') }} <span class="text-danger">*</span></label>
    <select id="company_id" name="company_id" class="form-select tom-select" required>
      <option value="">{{ __('common.select') }}</option>
      @foreach ($companies as $c)
        <option value="{{ $c->id }}" @selected(($values['company_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
    @error('company_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
  </div>

  <div class="col-12 col-md-6">
    <label class="form-label" for="country_id">{{ __('branches.fields.country') }}</label>
    <select id="country_id" name="country_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($countries as $c)
        <option value="{{ $c->id }}" @selected(($values['country_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-12 col-md-4">
    <label class="form-label" for="branch_code">{{ __('branches.fields.branch_code') }}</label>
    <input type="text" id="branch_code" name="branch_code" class="form-control" value="{{ $values['branch_code'] ?? '' }}">
  </div>

  <div class="col-12 col-md-8">
    <label class="form-label" for="name">{{ __('branches.fields.name') }} <span class="text-danger">*</span></label>
    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ $values['name'] ?? '' }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-12">
    <label class="form-label" for="address">{{ __('branches.fields.address') }}</label>
    <textarea id="address" name="address" rows="2" class="form-control">{{ $values['address'] ?? '' }}</textarea>
  </div>

  <div class="col-12 col-md-6">
    <label class="form-label" for="phone">{{ __('branches.fields.phone') }}</label>
    <input type="text" id="phone" name="phone" class="form-control" value="{{ $values['phone'] ?? '' }}">
  </div>

  <div class="col-12 col-md-6">
    <label class="form-label" for="email">{{ __('branches.fields.email') }}</label>
    <input type="email" id="email" name="email" class="form-control" value="{{ $values['email'] ?? '' }}">
  </div>

  <div class="col-12 col-md-6">
    <div class="form-check">
      <input type="hidden" name="is_head_office" value="0">
      <input type="checkbox" id="is_head_office" name="is_head_office" value="1" class="form-check-input"
             @checked((bool) ($values['is_head_office'] ?? false))>
      <label class="form-check-label" for="is_head_office">{{ __('branches.fields.is_head_office') }}</label>
    </div>
  </div>

  <div class="col-12 col-md-6">
    <div class="form-check">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" id="is_active" name="is_active" value="1" class="form-check-input"
             @checked((bool) ($values['is_active'] ?? true))>
      <label class="form-check-label" for="is_active">{{ __('branches.fields.is_active') }}</label>
    </div>
  </div>

  <div class="col-12 d-flex gap-2 justify-content-end mt-2">
    <a href="{{ route('admin.branches.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary">
      <i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}
    </button>
  </div>
</div>
