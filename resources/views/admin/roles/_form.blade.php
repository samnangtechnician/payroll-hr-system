@php
    $role = $role ?? null;
    $values = old() ?: ($role ? $role->toArray() : []);
@endphp
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">{{ __('roles.fields.name') }} <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $values['name'] ?? '' }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('roles.fields.guard_name') }}</label>
    <input type="text" name="guard_name" class="form-control" value="{{ $values['guard_name'] ?? 'web' }}">
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('roles.fields.company') }}</label>
    <select name="company_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($companies as $c)
        <option value="{{ $c->id }}" @selected(($values['company_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-12">
    <label class="form-label">{{ __('roles.fields.description') }}</label>
    <textarea name="description" rows="2" class="form-control">{{ $values['description'] ?? '' }}</textarea>
  </div>
  <div class="col-md-6">
    <div class="form-check">
      <input type="hidden" name="is_system" value="0">
      <input type="checkbox" id="role_is_system" name="is_system" value="1" class="form-check-input" @checked((bool) ($values['is_system'] ?? false))>
      <label class="form-check-label" for="role_is_system">{{ __('roles.fields.is_system') }}</label>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-check">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" id="role_is_active" name="is_active" value="1" class="form-check-input" @checked((bool) ($values['is_active'] ?? true))>
      <label class="form-check-label" for="role_is_active">{{ __('common.active') }}</label>
    </div>
  </div>
  <div class="col-12 d-flex justify-content-end gap-2 mt-2">
    <a href="{{ route('admin.roles.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
  </div>
</div>
