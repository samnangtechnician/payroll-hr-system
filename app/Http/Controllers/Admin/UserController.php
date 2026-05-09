<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index');
    }

    public function data(): JsonResponse
    {
        $query = User::query()
            ->with(['company:id,name', 'employee:id,first_name,last_name,employee_code', 'roles:id,name'])
            ->select('users.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($u) => $u->company?->name)
            ->addColumn('employee_label', fn ($u) => $u->employee
                ? trim($u->employee->first_name.' '.$u->employee->last_name).' ('.$u->employee->employee_code.')'
                : '—')
            ->addColumn('roles_csv', fn ($u) => $u->roles->pluck('name')->join(', ') ?: '—')
            ->editColumn('is_active', fn ($u) => $u->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->editColumn('last_login_at', fn ($u) => $u->last_login_at?->format('Y-m-d H:i') ?? '—')
            ->addColumn('actions', function ($u) {
                $editUrl = route('admin.users.edit', $u);
                $deleteUrl = route('admin.users.destroy', $u);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$u->email}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['is_active', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.users.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateUser($request);
        $data['password'] = Hash::make($data['password']);

        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        $user = User::create($data);
        if ($roles) {
            $user->roles()->sync($roles);
        }

        sweetalert()->success(__('users.saved'));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user): View
    {
        $user->load('roles');

        return view('admin.users.edit', array_merge($this->formData(), [
            'user' => $user,
        ]));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $this->validateUser($request, $user->id);

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        $user->update($data);
        $user->roles()->sync($roles);

        sweetalert()->success(__('users.saved'));

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        sweetalert()->success(__('users.deleted'));

        return redirect()->route('admin.users.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
            'employees' => Employee::query()
                ->orderBy('first_name')
                ->limit(500)
                ->get(['id', 'first_name', 'last_name', 'employee_code']),
            'roles' => Role::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']),
        ];
    }

    private function validateUser(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'company_id' => ['nullable', 'exists:companies,id'],
            'employee_id' => ['nullable', 'exists:employees,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($ignoreId)],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users', 'username')->ignore($ignoreId)],
            'phone' => ['nullable', 'string', 'max:50'],
            'password' => [$ignoreId ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'boolean'],
            'roles' => ['array'],
            'roles.*' => ['exists:roles,id'],
        ]);
    }
}
