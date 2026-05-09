<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AttendanceController extends Controller
{
    public function index(): View
    {
        return view('admin.attendance.index');
    }

    public function data(): JsonResponse
    {
        $query = AttendanceRecord::query()
            ->with([
                'employee:id,first_name,last_name,employee_code',
                'shift:id,name',
            ])
            ->select('attendance_records.*');

        return DataTables::eloquent($query)
            ->addColumn('employee_name', fn ($a) => $a->employee
                ? trim($a->employee->first_name.' '.$a->employee->last_name).' ('.$a->employee->employee_code.')'
                : '—')
            ->addColumn('shift_name', fn ($a) => $a->shift?->name ?? '—')
            ->editColumn('attendance_date', fn ($a) => $a->attendance_date?->format('Y-m-d'))
            ->editColumn('check_in_at', fn ($a) => $a->check_in_at?->format('H:i'))
            ->editColumn('check_out_at', fn ($a) => $a->check_out_at?->format('H:i'))
            ->editColumn('attendance_status', function ($a) {
                $map = [
                    'present' => 'bg-soft-success',
                    'absent' => 'bg-soft-danger',
                    'late' => 'bg-soft-warning',
                    'leave' => 'bg-soft-info',
                    'holiday' => 'bg-soft-primary',
                ];
                $cls = $map[$a->attendance_status] ?? 'bg-soft-secondary';

                return '<span class="badge '.$cls.'">'.e($a->attendance_status).'</span>';
            })
            ->rawColumns(['attendance_status'])
            ->toJson();
    }
}
