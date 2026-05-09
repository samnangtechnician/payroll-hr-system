<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceRecord extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id', 'shift_id', 'attendance_date',
        'check_in_at', 'check_out_at', 'total_working_hours',
        'late_minutes', 'early_leave_minutes', 'ot_hours',
        'attendance_status', 'work_mode',
        'check_in_latitude', 'check_in_longitude',
        'check_out_latitude', 'check_out_longitude',
        'biometric_device_id', 'is_manual', 'manual_reason',
        'approved_by', 'approved_at',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'check_in_at' => 'datetime',
        'check_out_at' => 'datetime',
        'approved_at' => 'datetime',
        'late_minutes' => 'integer',
        'early_leave_minutes' => 'integer',
        'total_working_hours' => 'decimal:2',
        'ot_hours' => 'decimal:2',
        'is_manual' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }
}
