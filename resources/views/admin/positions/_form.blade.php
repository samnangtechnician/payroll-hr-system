@php
    $position = $position ?? null;
    $values = old() ?: ($position ? $position->toArray() : []);
@endphp
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label" for="company_id">{{ __('positions.fields.company') }} <span class="text-danger">*</span></label>
    <select id="company_id" name="company_id" class="form-select tom-select" required>
      <option value="">{{ __('common.select') }}</option>
      @foreach ($companies as $c)
        <option value="{{ $c->id }}" @selected(($values['company_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label" for="department_id">{{ __('positions.fields.department') }}</label>
    <select id="department_id" name="department_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($departments as $d)
        <option value="{{ $d->id }}" @selected(($values['department_id'] ?? null) == $d->id)>{{ $d->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label" for="position_code">{{ __('positions.fields.position_code') }}</label>
    <input type="text" id="position_code" name="position_code" class="form-control" value="{{ $values['position_code'] ?? '' }}">
  </div>
  <div class="col-md-5">
    <label class="form-label" for="title">{{ __('positions.fields.title') }} <span class="text-danger">*</span></label>
    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $values['title'] ?? '' }}" required>
    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-3">
    <label class="form-label" for="level">{{ __('positions.fields.level') }}</label>
    <input type="text" id="level" name="level" class="form-control" value="{{ $values['level'] ?? '' }}">
  </div>
  <div class="col-12">
    <label class="form-label" for="description">{{ __('positions.fields.description') }}</label>
    <textarea id="description" name="description" rows="3" class="form-control">{{ $values['description'] ?? '' }}</textarea>
  </div>
  <div class="col-md-6">
    <div class="form-check">
      <input type="hidden" name="is_managerial" value="0">
      <input type="checkbox" id="is_managerial" name="is_managerial" value="1" class="form-check-input" @checked((bool) ($values['is_managerial'] ?? false))>
      <label class="form-check-label" for="is_managerial">{{ __('positions.fields.is_managerial') }}</label>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-check">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" id="is_active" name="is_active" value="1" class="form-check-input" @checked((bool) ($values['is_active'] ?? true))>
      <label class="form-check-label" for="is_active">{{ __('positions.fields.is_active') }}</label>
    </div>
  </div>
  <div class="col-12 d-flex justify-content-end gap-2 mt-2">
    <a href="{{ route('admin.positions.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
  </div>
</div>
