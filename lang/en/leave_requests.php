<?php

return [
    'title' => 'Leave Requests',
    'create' => 'New Leave Request',
    'edit' => 'Edit Leave Request',
    'fields' => [
        'leave_no' => 'Leave No.',
        'employee' => 'Employee',
        'leave_type' => 'Leave Type',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'days_count' => 'Days',
        'total_days' => 'Total Days',
        'is_half_day' => 'Half Day?',
        'half_day_period' => 'Half Day Period',
        'reason' => 'Reason',
        'approval_note' => 'Approval Note',
        'status' => 'Status',
    ],
    'half' => [
        'morning' => 'Morning (AM)',
        'afternoon' => 'Afternoon (PM)',
    ],
    'statuses' => [
        'draft' => 'Draft',
        'submitted' => 'Submitted',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'cancelled' => 'Cancelled',
    ],
    'deleted' => 'Leave request deleted',
    'saved' => 'Leave request saved',
];
