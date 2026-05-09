<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index(): View
    {
        return view('admin.roles.index');
    }

    public function data(): JsonResponse
    {
        $query = Role::query()
            ->with(['company:id,name'])
            ->select('roles.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($r) => $r->company?->name ?? '—')
            ->editColumn('is_system', fn ($r) => $r->is_system
                ? '<span class="badge bg-soft-info">'.__('common.yes').'</span>'
                : '—')
            ->editColumn('is_active', fn ($r) => $r->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->addColumn('actions', function ($r) {
                $editUrl = route('admin.roles.edit', $r);
                $deleteUrl = route('admin.roles.destroy', $r);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$r->name}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['is_system', 'is_active', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.roles.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        Role::create($this->validateRole($request));
        sweetalert()->success(__('roles.saved'));

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role): View
    {
        return view('admin.roles.edit', array_merge($this->formData(), [
            'role' => $role,
        ]));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $role->update($this->validateRole($request));
        sweetalert()->success(__('roles.saved'));

        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        sweetalert()->success(__('roles.deleted'));

        return redirect()->route('admin.roles.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
        ];
    }

    private function validateRole(Request $request): array
    {
        return $request->validate([
            'company_id' => ['nullable', 'exists:companies,id'],
            'name' => ['required', 'string', 'max:255'],
            'guard_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_system' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
