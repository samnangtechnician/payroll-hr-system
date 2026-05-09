<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayrollRun;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PayrollRunController extends Controller
{
    public function index(): View
    {
        return view('admin.payroll_runs.index');
    }

    public function data(): JsonResponse
    {
        $query = PayrollRun::query()
            ->with(['period:id,period_code', 'country:id,name'])
            ->select('payroll_runs.*');

        return DataTables::eloquent($query)
            ->addColumn('period_code', fn ($r) => $r->period?->period_code)
            ->addColumn('country_name', fn ($r) => $r->country?->name ?? '—')
            ->editColumn('gross_amount', fn ($r) => number_format((float) $r->gross_amount, 2))
            ->editColumn('total_deduction', fn ($r) => number_format((float) $r->total_deduction, 2))
            ->editColumn('net_amount', fn ($r) => number_format((float) $r->net_amount, 2))
            ->editColumn('status', fn ($r) => '<span class="badge bg-soft-primary">'.e($r->status).'</span>')
            ->editColumn('approved_at', fn ($r) => $r->approved_at?->format('Y-m-d H:i') ?? '—')
            ->rawColumns(['status'])
            ->toJson();
    }
}
