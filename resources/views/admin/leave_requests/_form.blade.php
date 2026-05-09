@php
    $leaveRequest = $leaveRequest ?? null;
    $values = old() ?: ($leaveRequest ? $leaveRequest->toArray() : []);
@endphp
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">{{ __('leave_requests.fields.employee') }} <span class="text-danger">*</span></label>
    <select name="employee_id" class="form-select tom-select" required>
      <option value="">{{ __('common.select') }}</option>
      @foreach ($employees as $e)
        <option value="{{ $e->id }}" @selected(($values['employee_id'] ?? null) == $e->id)>
          {{ $e->employee_code }} — {{ trim($e->first_name.' '.$e->last_name) }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">{{ __('leave_requests.fields.leave_type') }} <span class="text-danger">*</span></label>
    <select name="leave_type_id" class="form-select tom-select" required>
      <option value="">{{ __('common.select') }}</option>
      @foreach ($leaveTypes as $t)
        <option value="{{ $t->id }}" @selected(($values['leave_type_id'] ?? null) == $t->id)>{{ $t->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('leave_requests.fields.start_date') }} <span class="text-danger">*</span></label>
    <input type="text" name="start_date" class="form-control flatpickr-date" value="{{ $values['start_date'] ?? '' }}" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('leave_requests.fields.end_date') }} <span class="text-danger">*</span></label>
    <input type="text" name="end_date" class="form-control flatpickr-date" value="{{ $values['end_date'] ?? '' }}" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('leave_requests.fields.total_days') }}</label>
    <input type="number" step="0.5" min="0" name="total_days" class="form-control" value="{{ $values['total_days'] ?? '' }}">
  </div>
  <div class="col-md-4">
    <div class="form-check">
      <input type="hidden" name="is_half_day" value="0">
      <input type="checkbox" id="lr_half" name="is_half_day" value="1" class="form-check-input" @checked((bool) ($values['is_half_day'] ?? false))>
      <label class="form-check-label" for="lr_half">{{ __('leave_requests.fields.is_half_day') }}</label>
    </div>
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('leave_requests.fields.half_day_period') }}</label>
    <select name="half_day_period" class="form-select">
      <option value="">{{ __('common.select') }}</option>
      <option value="morning" @selected(($values['half_day_period'] ?? null) === 'morning')>{{ __('leave_requests.half.morning') }}</option>
      <option value="afternoon" @selected(($values['half_day_period'] ?? null) === 'afternoon')>{{ __('leave_requests.half.afternoon') }}</option>
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">{{ __('common.status') }}</label>
    <select name="status" class="form-select tom-select">
      @foreach ($statuses as $s)
        <option value="{{ $s }}" @selected(($values['status'] ?? 'draft') === $s)>{{ __('leave_requests.status.'.$s) }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-12">
    <label class="form-label">{{ __('leave_requests.fields.reason') }}</label>
    <textarea name="reason" rows="2" class="form-control">{{ $values['reason'] ?? '' }}</textarea>
  </div>
  <div class="col-12">
    <label class="form-label">{{ __('leave_requests.fields.approval_note') }}</label>
    <textarea name="approval_note" rows="2" class="form-control">{{ $values['approval_note'] ?? '' }}</textarea>
  </div>
  <div class="col-12 d-flex justify-content-end gap-2 mt-2">
    <a href="{{ route('admin.leave-requests.index') }}" class="btn btn-light">{{ __('common.cancel') }}</a>
    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i> {{ __('common.save') }}</button>
  </div>
</div>
