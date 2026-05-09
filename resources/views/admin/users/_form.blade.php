@php
    $user = $user ?? null;
    $values = old() ?: ($user ? $user->toArray() : []);
    $selectedRoles = old('roles', $user?->roles?->pluck('id')->toArray() ?? []);
@endphp
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">{{ __('users.fields.name') }} <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $values['name'] ?? '' }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('users.fields.email') }} <span class="text-danger">*</span></label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $values['email'] ?? '' }}" required>
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('users.fields.username') }}</label>
    <input type="text" name="username" class="form-control" value="{{ $values['username'] ?? '' }}">
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('users.fields.phone') }}</label>
    <input type="text" name="phone" class="form-control" value="{{ $values['phone'] ?? '' }}">
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('users.fields.company') }}</label>
    <select name="company_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($companies as $c)
        <option value="{{ $c->id }}" @selected(($values['company_id'] ?? null) == $c->id)>{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('users.fields.linked_employee') }}</label>
    <select name="employee_id" class="form-select tom-select">
      <option value="">{{ __('common.select') }}</option>
      @foreach ($employees as $e)
        <option value="{{ $e->id }}" @selected(($values['employee_id'] ?? null) == $e->id)>
          {{ $e->employee_code }} — {{ trim($e->first_name.' '.$e->last_name) }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('users.fields.password') }} @if (! $user) <span class="text-danger">*</span> @endif</label>
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    @if ($user)<small class="text-muted">{{ __('users.password_help') }}</small>@endif
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('users.fields.password_confirmation') }}</label>
    <input type="password" name="password_confirmation" class="form-control">
  </div>
  <div class="col-12">
    <label class="form-label">{{ __('users.fields.roles') }}</label>
    <select name="roles[]" multiple class="form-select tom-select">
      @foreach ($roles as $r)
        <option value="{{ $r->id }}" @selected(in_array($r->id, $selectedRoles))>{{ $r->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <div class="form-check">
      <input type="hidden" name="is_active" value="0">
      <input type="checkbox" id="user_is_active" name="is_active" value="1" class="form-check-input" @checked((bool) ($values['is_active'] ?? true))>
      <label class="form-check-label" for="user_is_active">{{ __('common.active') }}</label>
    </div>
  </div>
  <div class="col-12 d-flex justify-content-end gap-2 mt-2">
    <a href="{{ route('admin.users.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
  </div>
</div>
