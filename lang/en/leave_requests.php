<?php

return [
    'title' => 'Leave Requests',
    'create' => 'New Leave Request',
    'edit' => 'Edit Leave Request',
    'fields' => [
        'employee' => 'Employee',
        'leave_type' => 'Leave Type',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'days_count' => 'Days',
        'reason' => 'Reason',
        'status' => 'Status',
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
