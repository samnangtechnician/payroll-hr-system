<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveRequestDate extends Model
{
    protected $fillable = [
        'leave_request_id', 'leave_date', 'days', 'is_paid',
    ];

    protected $casts = [
        'leave_date' => 'date',
        'days' => 'decimal:2',
        'is_paid' => 'boolean',
    ];

    public function leaveRequest(): BelongsTo
    {
        return $this->belongsTo(LeaveRequest::class);
    }
}
