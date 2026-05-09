<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\LeaveType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class LeaveTypeController extends Controller
{
    public function index(): View
    {
        return view('admin.leave_types.index');
    }

    public function data(): JsonResponse
    {
        $query = LeaveType::query()->with(['company:id,name'])->select('leave_types.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($l) => $l->company?->name ?? '—')
            ->editColumn('is_paid', fn ($l) => $l->is_paid
                ? '<span class="badge bg-soft-success">'.__('common.yes').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.no').'</span>')
            ->editColumn('is_active', fn ($l) => $l->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->addColumn('actions', function ($l) {
                $editUrl = route('admin.leave-types.edit', $l);
                $deleteUrl = route('admin.leave-types.destroy', $l);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$l->name}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['is_paid', 'is_active', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.leave_types.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        LeaveType::create($this->validateLeaveType($request));
        sweetalert()->success(__('leave_types.saved'));

        return redirect()->route('admin.leave-types.index');
    }

    public function edit(LeaveType $leaveType): View
    {
        return view('admin.leave_types.edit', array_merge($this->formData(), [
            'leaveType' => $leaveType,
        ]));
    }

    public function update(Request $request, LeaveType $leaveType): RedirectResponse
    {
        $leaveType->update($this->validateLeaveType($request));
        sweetalert()->success(__('leave_types.saved'));

        return redirect()->route('admin.leave-types.index');
    }

    public function destroy(LeaveType $leaveType): RedirectResponse
    {
        $leaveType->delete();
        sweetalert()->success(__('leave_types.deleted'));

        return redirect()->route('admin.leave-types.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
            'countries' => Country::query()->orderBy('name')->get(['id', 'name']),
        ];
    }

    private function validateLeaveType(Request $request): array
    {
        return $request->validate([
            'company_id' => ['nullable', 'exists:companies,id'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:255'],
            'default_entitlement_days' => ['nullable', 'numeric', 'min:0'],
            'is_paid' => ['nullable', 'boolean'],
            'allow_half_day' => ['nullable', 'boolean'],
            'requires_attachment' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
