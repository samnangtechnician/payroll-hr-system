<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function index(): View
    {
        return view('admin.positions.index');
    }

    public function data(): JsonResponse
    {
        $query = Position::query()
            ->with(['company:id,name', 'department:id,name'])
            ->select('positions.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($p) => $p->company?->name)
            ->addColumn('department_name', fn ($p) => $p->department?->name)
            ->editColumn('is_managerial', fn ($p) => $p->is_managerial
                ? '<span class="badge bg-soft-info">'.__('common.yes').'</span>'
                : '—')
            ->editColumn('is_active', fn ($p) => $p->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->addColumn('actions', function ($p) {
                $editUrl = route('admin.positions.edit', $p);
                $deleteUrl = route('admin.positions.destroy', $p);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$p->title}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['is_managerial', 'is_active', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.positions.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        Position::create($this->validatePosition($request));
        sweetalert()->success(__('positions.saved'));

        return redirect()->route('admin.positions.index');
    }

    public function edit(Position $position): View
    {
        return view('admin.positions.edit', array_merge($this->formData(), [
            'position' => $position,
        ]));
    }

    public function update(Request $request, Position $position): RedirectResponse
    {
        $position->update($this->validatePosition($request));
        sweetalert()->success(__('positions.saved'));

        return redirect()->route('admin.positions.index');
    }

    public function destroy(Position $position): RedirectResponse
    {
        $position->delete();
        sweetalert()->success(__('positions.deleted'));

        return redirect()->route('admin.positions.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
            'departments' => Department::query()->orderBy('name')->get(['id', 'name', 'company_id']),
        ];
    }

    private function validatePosition(Request $request): array
    {
        return $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'position_code' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_managerial' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
