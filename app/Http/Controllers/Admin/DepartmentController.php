<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    public function index(): View
    {
        return view('admin.departments.index');
    }

    public function data(): JsonResponse
    {
        $query = Department::query()
            ->with(['company:id,name', 'branch:id,name', 'manager:id,first_name,last_name'])
            ->select('departments.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($d) => $d->company?->name)
            ->addColumn('branch_name', fn ($d) => $d->branch?->name)
            ->addColumn('manager_name', fn ($d) => $d->manager
                ? trim($d->manager->first_name.' '.$d->manager->last_name)
                : '—')
            ->editColumn('is_active', fn ($d) => $d->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->editColumn('created_at', fn ($d) => $d->created_at?->format('Y-m-d'))
            ->addColumn('actions', function ($d) {
                $editUrl = route('admin.departments.edit', $d);
                $deleteUrl = route('admin.departments.destroy', $d);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$d->name}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['is_active', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.departments.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        Department::create($this->validateDepartment($request));
        sweetalert()->success(__('departments.saved'));

        return redirect()->route('admin.departments.index');
    }

    public function edit(Department $department): View
    {
        return view('admin.departments.edit', array_merge($this->formData(), [
            'department' => $department,
        ]));
    }

    public function update(Request $request, Department $department): RedirectResponse
    {
        $department->update($this->validateDepartment($request));
        sweetalert()->success(__('departments.saved'));

        return redirect()->route('admin.departments.index');
    }

    public function destroy(Department $department): RedirectResponse
    {
        $department->delete();
        sweetalert()->success(__('departments.deleted'));

        return redirect()->route('admin.departments.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
            'branches' => Branch::query()->orderBy('name')->get(['id', 'name', 'company_id']),
            'employees' => Employee::query()
                ->orderBy('first_name')
                ->limit(500)
                ->get(['id', 'first_name', 'last_name', 'employee_code']),
        ];
    }

    private function validateDepartment(Request $request): array
    {
        return $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'manager_employee_id' => ['nullable', 'exists:employees,id'],
            'department_code' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
