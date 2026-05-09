<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Shift;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ShiftController extends Controller
{
    public function index(): View
    {
        return view('admin.shifts.index');
    }

    public function data(): JsonResponse
    {
        $query = Shift::query()->with('company:id,name')->select('shifts.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($s) => $s->company?->name)
            ->editColumn('is_night_shift', fn ($s) => $s->is_night_shift
                ? '<span class="badge bg-soft-info">'.__('common.yes').'</span>'
                : '—')
            ->editColumn('is_active', fn ($s) => $s->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->addColumn('actions', function ($s) {
                $editUrl = route('admin.shifts.edit', $s);
                $deleteUrl = route('admin.shifts.destroy', $s);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$s->name}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['is_night_shift', 'is_active', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.shifts.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        Shift::create($this->validateShift($request));
        sweetalert()->success(__('shifts.saved'));

        return redirect()->route('admin.shifts.index');
    }

    public function edit(Shift $shift): View
    {
        return view('admin.shifts.edit', array_merge($this->formData(), ['shift' => $shift]));
    }

    public function update(Request $request, Shift $shift): RedirectResponse
    {
        $shift->update($this->validateShift($request));
        sweetalert()->success(__('shifts.saved'));

        return redirect()->route('admin.shifts.index');
    }

    public function destroy(Shift $shift): RedirectResponse
    {
        $shift->delete();
        sweetalert()->success(__('shifts.deleted'));

        return redirect()->route('admin.shifts.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
        ];
    }

    private function validateShift(Request $request): array
    {
        return $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'shift_code' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i'],
            'break_minutes' => ['nullable', 'integer', 'min:0', 'max:1440'],
            'late_grace_minutes' => ['nullable', 'integer', 'min:0', 'max:1440'],
            'early_leave_grace_minutes' => ['nullable', 'integer', 'min:0', 'max:1440'],
            'is_night_shift' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
