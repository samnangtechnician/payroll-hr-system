<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payslip;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PayslipController extends Controller
{
    public function index(): View
    {
        return view('admin.payslips.index');
    }

    public function data(): JsonResponse
    {
        $query = Payslip::query()
            ->with([
                'employee:id,first_name,last_name,employee_code',
                'period:id,period_code',
                'item:id,net_amount,gross_amount',
            ])
            ->select('payslips.*');

        return DataTables::eloquent($query)
            ->addColumn('employee_name', fn ($p) => $p->employee
                ? trim($p->employee->first_name.' '.$p->employee->last_name).' ('.$p->employee->employee_code.')'
                : '—')
            ->addColumn('period_code', fn ($p) => $p->period?->period_code)
            ->addColumn('net_pay', fn ($p) => number_format((float) ($p->item?->net_amount ?? 0), 2))
            ->editColumn('issued_at', fn ($p) => $p->issued_at?->format('Y-m-d H:i') ?? '—')
            ->editColumn('is_published', fn ($p) => $p->is_published
                ? '<span class="badge bg-soft-success">'.__('common.yes').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.no').'</span>')
            ->rawColumns(['is_published'])
            ->toJson();
    }
}
