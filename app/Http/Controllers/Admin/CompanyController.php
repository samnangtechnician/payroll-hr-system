<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index(): View
    {
        return view('admin.companies.index');
    }

    public function data(): JsonResponse
    {
        $query = Company::query()
            ->with(['country:id,name', 'currency:id,code,name'])
            ->select('companies.*');

        return DataTables::eloquent($query)
            ->addColumn('country_name', fn ($c) => $c->country?->name)
            ->addColumn('currency_code', fn ($c) => $c->currency?->code)
            ->editColumn('is_active', fn ($c) => $c->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->addColumn('actions', function ($c) {
                $editUrl = route('admin.companies.edit', $c);
                $deleteUrl = route('admin.companies.destroy', $c);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$c->name}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['is_active', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.companies.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        Company::create($this->validateCompany($request));
        sweetalert()->success(__('common.save').' ✓');

        return redirect()->route('admin.companies.index');
    }

    public function edit(Company $company): View
    {
        return view('admin.companies.edit', array_merge($this->formData(), [
            'company' => $company,
        ]));
    }

    public function update(Request $request, Company $company): RedirectResponse
    {
        $company->update($this->validateCompany($request));
        sweetalert()->success(__('common.save').' ✓');

        return redirect()->route('admin.companies.index');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $company->delete();
        sweetalert()->success(__('common.delete').' ✓');

        return redirect()->route('admin.companies.index');
    }

    private function formData(): array
    {
        return [
            'countries' => Country::query()->orderBy('name')->get(['id', 'name']),
            'currencies' => Currency::query()->orderBy('code')->get(['id', 'code', 'name']),
        ];
    }

    private function validateCompany(Request $request): array
    {
        return $request->validate([
            'country_id' => ['nullable', 'exists:countries,id'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
            'company_code' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'legal_name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'tax_registration_no' => ['nullable', 'string', 'max:255'],
            'business_registration_no' => ['nullable', 'string', 'max:255'],
            'fiscal_year_start_month' => ['nullable', 'string', 'max:20'],
            'payroll_cycle' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
