<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\PayrollPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PayrollPeriodController extends Controller
{
    public function index(): View
    {
        return view('admin.payroll_periods.index');
    }

    public function data(): JsonResponse
    {
        $query = PayrollPeriod::query()
            ->with(['company:id,name', 'country:id,name'])
            ->select('payroll_periods.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($p) => $p->company?->name)
            ->addColumn('country_name', fn ($p) => $p->country?->name ?? '—')
            ->editColumn('start_date', fn ($p) => $p->start_date?->format('Y-m-d'))
            ->editColumn('end_date', fn ($p) => $p->end_date?->format('Y-m-d'))
            ->editColumn('payment_date', fn ($p) => $p->payment_date?->format('Y-m-d') ?? '—')
            ->editColumn('status', fn ($p) => '<span class="badge bg-soft-primary">'.e($p->status).'</span>')
            ->addColumn('actions', function ($p) {
                $editUrl = route('admin.payroll-periods.edit', $p);
                $deleteUrl = route('admin.payroll-periods.destroy', $p);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$p->period_code}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['status', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.payroll_periods.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        PayrollPeriod::create($this->validatePeriod($request));
        sweetalert()->success(__('common.save').' ✓');

        return redirect()->route('admin.payroll-periods.index');
    }

    public function edit(PayrollPeriod $payrollPeriod): View
    {
        return view('admin.payroll_periods.edit', array_merge($this->formData(), [
            'period' => $payrollPeriod,
        ]));
    }

    public function update(Request $request, PayrollPeriod $payrollPeriod): RedirectResponse
    {
        $payrollPeriod->update($this->validatePeriod($request));
        sweetalert()->success(__('common.save').' ✓');

        return redirect()->route('admin.payroll-periods.index');
    }

    public function destroy(PayrollPeriod $payrollPeriod): RedirectResponse
    {
        $payrollPeriod->delete();
        sweetalert()->success(__('common.delete').' ✓');

        return redirect()->route('admin.payroll-periods.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
            'countries' => Country::query()->orderBy('name')->get(['id', 'name']),
            'statuses' => ['open', 'calculating', 'review', 'approved', 'paid', 'closed'],
        ];
    }

    private function validatePeriod(Request $request): array
    {
        return $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'period_code' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'payment_date' => ['nullable', 'date'],
            'status' => ['required', 'in:open,calculating,review,approved,paid,closed'],
        ]);
    }
}
