@php
    $employee = $employee ?? null;
    $values = old() ?: ($employee ? $employee->toArray() : []);
@endphp

<ul class="nav nav-tabs mb-3" role="tablist">
  <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-personal" type="button">{{ __('employees.tabs.personal') }}</button></li>
  <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-employment" type="button">{{ __('employees.tabs.employment') }}</button></li>
  <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-compensation" type="button">{{ __('employees.tabs.compensation') }}</button></li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade show active" id="tab-personal">
    <div class="row g-3">
      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.employee_code') }} <span class="text-danger">*</span></label>
        <input type="text" name="employee_code" class="form-control @error('employee_code') is-invalid @enderror" value="{{ $values['employee_code'] ?? '' }}" required>
        @error('employee_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.first_name') }} <span class="text-danger">*</span></label>
        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ $values['first_name'] ?? '' }}" required>
        @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.last_name') }}</label>
        <input type="text" name="last_name" class="form-control" value="{{ $values['last_name'] ?? '' }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.khmer_name') }}</label>
        <input type="text" name="khmer_name" class="form-control" value="{{ $values['khmer_name'] ?? '' }}">
      </div>

      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.gender') }}</label>
        <select name="gender" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($genders as $g)
            <option value="{{ $g }}" @selected(($values['gender'] ?? null) === $g)>{{ __('employees.gender.'.$g) }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.date_of_birth') }}</label>
        <input type="text" name="date_of_birth" class="form-control flatpickr-date" value="{{ $values['date_of_birth'] ?? '' }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('common.phone') }}</label>
        <input type="text" name="phone" class="form-control" value="{{ $values['phone'] ?? '' }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.secondary_phone') }}</label>
        <input type="text" name="secondary_phone" class="form-control" value="{{ $values['secondary_phone'] ?? '' }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">{{ __('common.email') }}</label>
        <input type="email" name="email" class="form-control" value="{{ $values['email'] ?? '' }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.national_id_no') }}</label>
        <input type="text" name="national_id_no" class="form-control" value="{{ $values['national_id_no'] ?? '' }}">
      </div>
      <div class="col-md-3">
        <label class="form-label">{{ __('employees.fields.passport_no') }}</label>
        <input type="text" name="passport_no" class="form-control" value="{{ $values['passport_no'] ?? '' }}">
      </div>

      <div class="col-md-6">
        <label class="form-label">{{ __('employees.fields.current_address') }}</label>
        <textarea name="current_address" rows="2" class="form-control">{{ $values['current_address'] ?? '' }}</textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">{{ __('employees.fields.permanent_address') }}</label>
        <textarea name="permanent_address" rows="2" class="form-control">{{ $values['permanent_address'] ?? '' }}</textarea>
      </div>

      <div class="col-md-6">
        <label class="form-label">{{ __('employees.fields.country') }}</label>
        <select name="country_id" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($countries as $c)
            <option value="{{ $c->id }}" @selected(($values['country_id'] ?? null) == $c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">{{ __('employees.fields.profile_photo') }}</label>
        <input type="file" name="profile_photo" accept="image/*" class="form-control">
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab-employment">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.company') }} <span class="text-danger">*</span></label>
        <select name="company_id" class="form-select tom-select" required>
          <option value="">{{ __('common.select') }}</option>
          @foreach ($companies as $c)
            <option value="{{ $c->id }}" @selected(($values['company_id'] ?? null) == $c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.branch') }}</label>
        <select name="branch_id" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($branches as $b)
            <option value="{{ $b->id }}" @selected(($values['branch_id'] ?? null) == $b->id)>{{ $b->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.department') }}</label>
        <select name="department_id" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($departments as $d)
            <option value="{{ $d->id }}" @selected(($values['department_id'] ?? null) == $d->id)>{{ $d->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.position') }}</label>
        <select name="position_id" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($positions as $p)
            <option value="{{ $p->id }}" @selected(($values['position_id'] ?? null) == $p->id)>{{ $p->title }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.employment_type') }}</label>
        <select name="employment_type_id" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($employmentTypes as $t)
            <option value="{{ $t->id }}" @selected(($values['employment_type_id'] ?? null) == $t->id)>{{ $t->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.contract_type') }}</label>
        <select name="contract_type_id" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($contractTypes as $t)
            <option value="{{ $t->id }}" @selected(($values['contract_type_id'] ?? null) == $t->id)>{{ $t->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.manager') }}</label>
        <select name="manager_employee_id" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($managers as $m)
            @if (! $employee || $m->id !== $employee->id)
              <option value="{{ $m->id }}" @selected(($values['manager_employee_id'] ?? null) == $m->id)>
                {{ $m->employee_code }} — {{ trim($m->first_name.' '.$m->last_name) }}
              </option>
            @endif
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.join_date') }}</label>
        <input type="text" name="join_date" class="form-control flatpickr-date" value="{{ $values['join_date'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.probation_end_date') }}</label>
        <input type="text" name="probation_end_date" class="form-control flatpickr-date" value="{{ $values['probation_end_date'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.contract_start_date') }}</label>
        <input type="text" name="contract_start_date" class="form-control flatpickr-date" value="{{ $values['contract_start_date'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.contract_end_date') }}</label>
        <input type="text" name="contract_end_date" class="form-control flatpickr-date" value="{{ $values['contract_end_date'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('common.status') }} <span class="text-danger">*</span></label>
        <select name="status" class="form-select tom-select" required>
          @foreach ($statuses as $s)
            <option value="{{ $s }}" @selected(($values['status'] ?? 'active') === $s)>{{ __('employees.status.'.$s) }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tab-compensation">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.basic_salary') }}</label>
        <input type="number" step="0.01" min="0" name="basic_salary" class="form-control" value="{{ $values['basic_salary'] ?? '' }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.salary_currency') }}</label>
        <select name="salary_currency_id" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($currencies as $c)
            <option value="{{ $c->id }}" @selected(($values['salary_currency_id'] ?? null) == $c->id)>{{ $c->code }} — {{ $c->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">{{ __('employees.fields.salary_payment_method') }}</label>
        <select name="salary_payment_method" class="form-select tom-select">
          <option value="">{{ __('common.select') }}</option>
          @foreach ($paymentMethods as $m)
            <option value="{{ $m }}" @selected(($values['salary_payment_method'] ?? null) === $m)>{{ __('employees.payment_method.'.$m) }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
  <a href="{{ route('admin.employees.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
  <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
</div>
