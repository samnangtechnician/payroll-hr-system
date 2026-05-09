<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\ContractType;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmploymentType;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(): View
    {
        return view('admin.employees.index');
    }

    public function data(): JsonResponse
    {
        $query = Employee::query()
            ->with([
                'company:id,name',
                'branch:id,name',
                'department:id,name',
                'position:id,title',
            ])
            ->select('employees.*');

        return DataTables::eloquent($query)
            ->addColumn('full_name', fn ($e) => trim($e->first_name.' '.$e->last_name))
            ->addColumn('company_name', fn ($e) => $e->company?->name)
            ->addColumn('branch_name', fn ($e) => $e->branch?->name)
            ->addColumn('department_name', fn ($e) => $e->department?->name)
            ->addColumn('position_title', fn ($e) => $e->position?->title)
            ->editColumn('status', function ($e) {
                $map = [
                    'active' => 'bg-soft-success',
                    'probation' => 'bg-soft-warning',
                    'resigned' => 'bg-soft-secondary',
                    'terminated' => 'bg-soft-danger',
                    'inactive' => 'bg-soft-secondary',
                ];
                $cls = $map[$e->status] ?? 'bg-soft-info';
                $label = __('employees.statuses.'.$e->status);

                return "<span class=\"badge {$cls}\">{$label}</span>";
            })
            ->editColumn('basic_salary', fn ($e) => number_format((float) $e->basic_salary, 2))
            ->editColumn('join_date', fn ($e) => $e->join_date?->format('Y-m-d'))
            ->addColumn('actions', function ($e) {
                $editUrl = route('admin.employees.edit', $e);
                $deleteUrl = route('admin.employees.destroy', $e);
                $showUrl = route('admin.employees.show', $e);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$showUrl}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$e->employee_code}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['status', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.employees.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateEmployee($request);

        if ($request->hasFile('profile_photo')) {
            $data['profile_photo_path'] = $request->file('profile_photo')
                ->store('employees', 'public');
        }

        Employee::create($data);

        sweetalert()->success(__('employees.saved'));

        return redirect()->route('admin.employees.index');
    }

    public function show(Employee $employee): View
    {
        $employee->load([
            'company', 'branch', 'department', 'position',
            'employmentType', 'contractType', 'manager',
            'salaryCurrency', 'bankAccounts', 'emergencyContacts',
            'documents.documentType', 'contracts',
        ]);

        return view('admin.employees.show', compact('employee'));
    }

    public function edit(Employee $employee): View
    {
        return view('admin.employees.edit', array_merge($this->formData(), [
            'employee' => $employee,
        ]));
    }

    public function update(Request $request, Employee $employee): RedirectResponse
    {
        $data = $this->validateEmployee($request, $employee->id);

        if ($request->hasFile('profile_photo')) {
            if ($employee->profile_photo_path) {
                Storage::disk('public')->delete($employee->profile_photo_path);
            }
            $data['profile_photo_path'] = $request->file('profile_photo')
                ->store('employees', 'public');
        }

        $employee->update($data);

        sweetalert()->success(__('employees.saved'));

        return redirect()->route('admin.employees.index');
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();
        sweetalert()->success(__('employees.deleted'));

        return redirect()->route('admin.employees.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
            'countries' => Country::query()->orderBy('name')->get(['id', 'name']),
            'branches' => Branch::query()->orderBy('name')->get(['id', 'name', 'company_id']),
            'departments' => Department::query()->orderBy('name')->get(['id', 'name', 'company_id', 'branch_id']),
            'positions' => Position::query()->orderBy('title')->get(['id', 'title', 'company_id', 'department_id']),
            'employmentTypes' => EmploymentType::query()->orderBy('name')->get(['id', 'name']),
            'contractTypes' => ContractType::query()->orderBy('name')->get(['id', 'name']),
            'currencies' => Currency::query()->orderBy('code')->get(['id', 'code', 'name']),
            'managers' => Employee::query()
                ->whereIn('status', ['active', 'probation'])
                ->orderBy('first_name')
                ->limit(500)
                ->get(['id', 'first_name', 'last_name', 'employee_code']),
            'statuses' => ['active', 'probation', 'resigned', 'terminated', 'inactive'],
            'genders' => ['male', 'female', 'other'],
            'paymentMethods' => ['cash', 'bank_transfer', 'mobile_wallet', 'cheque'],
        ];
    }

    private function validateEmployee(Request $request, ?int $ignoreId = null): array
    {
        $rules = [
            'company_id' => ['required', 'exists:companies,id'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'position_id' => ['nullable', 'exists:positions,id'],
            'employment_type_id' => ['nullable', 'exists:employment_types,id'],
            'contract_type_id' => ['nullable', 'exists:contract_types,id'],
            'manager_employee_id' => ['nullable', 'exists:employees,id'],
            'employee_code' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'khmer_name' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:50'],
            'secondary_phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'current_address' => ['nullable', 'string'],
            'permanent_address' => ['nullable', 'string'],
            'national_id_no' => ['nullable', 'string', 'max:255'],
            'passport_no' => ['nullable', 'string', 'max:255'],
            'passport_expiry_date' => ['nullable', 'date'],
            'join_date' => ['nullable', 'date'],
            'probation_end_date' => ['nullable', 'date'],
            'contract_start_date' => ['nullable', 'date'],
            'contract_end_date' => ['nullable', 'date'],
            'basic_salary' => ['nullable', 'numeric', 'min:0'],
            'salary_currency_id' => ['nullable', 'exists:currencies,id'],
            'salary_payment_method' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:active,probation,resigned,terminated,inactive'],
            'profile_photo' => ['nullable', 'image', 'max:4096'],
        ];

        $data = $request->validate($rules);
        unset($data['profile_photo']);

        return $data;
    }
}
