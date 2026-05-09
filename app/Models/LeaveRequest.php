<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'leave_no', 'employee_id', 'leave_type_id',
        'start_date', 'end_date', 'total_days',
        'is_half_day', 'half_day_period',
        'reason', 'attachment_path', 'requested_date',
        'approved_by', 'approved_at', 'status', 'approval_note',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'requested_date' => 'date',
        'total_days' => 'decimal:2',
        'is_half_day' => 'boolean',
        'approved_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function dates(): HasMany
    {
        return $this->hasMany(LeaveRequestDate::class);
    }
}
