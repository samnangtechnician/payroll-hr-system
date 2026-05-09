<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\PayrollRun;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'branches' => Branch::query()->count(),
            'departments' => Department::query()->count(),
            'employees' => Employee::query()->count(),
            'active_employees' => Employee::query()->where('status', 'active')->count(),
            'pending_leaves' => LeaveRequest::query()->where('status', 'submitted')->count(),
            'this_month_payroll' => PayrollRun::query()
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('net_amount'),
        ];

        $recentEmployees = Employee::query()
            ->with(['branch', 'department', 'position'])
            ->latest('id')
            ->limit(8)
            ->get();

        $branchDistribution = Branch::query()
            ->withCount('employees')
            ->orderByDesc('employees_count')
            ->limit(10)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats', 'recentEmployees', 'branchDistribution'
        ));
    }
}
