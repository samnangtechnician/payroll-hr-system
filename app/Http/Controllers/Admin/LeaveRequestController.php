<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class LeaveRequestController extends Controller
{
    public function index(): View
    {
        return view('admin.leave_requests.index');
    }

    public function data(): JsonResponse
    {
        $query = LeaveRequest::query()
            ->with([
                'employee:id,first_name,last_name,employee_code',
                'leaveType:id,name',
            ])
            ->select('leave_requests.*');

        return DataTables::eloquent($query)
            ->addColumn('employee_name', fn ($r) => $r->employee
                ? trim($r->employee->first_name.' '.$r->employee->last_name).' ('.$r->employee->employee_code.')'
                : '—')
            ->addColumn('leave_type_name', fn ($r) => $r->leaveType?->name)
            ->editColumn('start_date', fn ($r) => $r->start_date?->format('Y-m-d'))
            ->editColumn('end_date', fn ($r) => $r->end_date?->format('Y-m-d'))
            ->editColumn('status', function ($r) {
                $map = [
                    'draft' => 'bg-soft-secondary',
                    'submitted' => 'bg-soft-info',
                    'approved' => 'bg-soft-success',
                    'rejected' => 'bg-soft-danger',
                    'cancelled' => 'bg-soft-secondary',
                ];
                $cls = $map[$r->status] ?? 'bg-soft-info';
                $label = __('leave_requests.statuses.'.$r->status);

                return "<span class=\"badge {$cls}\">{$label}</span>";
            })
            ->addColumn('actions', function ($r) {
                $editUrl = route('admin.leave-requests.edit', $r);
                $deleteUrl = route('admin.leave-requests.destroy', $r);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$r->leave_no}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['status', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.leave_requests.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateRequest($request);

        $data['leave_no'] ??= 'LV-'.Str::upper(Str::random(8));
        $data['requested_date'] ??= now()->toDateString();

        LeaveRequest::create($data);
        sweetalert()->success(__('leave_requests.saved'));

        return redirect()->route('admin.leave-requests.index');
    }

    public function edit(LeaveRequest $leaveRequest): View
    {
        return view('admin.leave_requests.edit', array_merge($this->formData(), [
            'leaveRequest' => $leaveRequest,
        ]));
    }

    public function update(Request $request, LeaveRequest $leaveRequest): RedirectResponse
    {
        $leaveRequest->update($this->validateRequest($request));
        sweetalert()->success(__('leave_requests.saved'));

        return redirect()->route('admin.leave-requests.index');
    }

    public function destroy(LeaveRequest $leaveRequest): RedirectResponse
    {
        $leaveRequest->delete();
        sweetalert()->success(__('leave_requests.deleted'));

        return redirect()->route('admin.leave-requests.index');
    }

    private function formData(): array
    {
        return [
            'employees' => Employee::query()->orderBy('first_name')->limit(500)
                ->get(['id', 'first_name', 'last_name', 'employee_code']),
            'leaveTypes' => LeaveType::query()->where('is_active', true)->orderBy('name')->get(['id', 'name']),
            'statuses' => ['draft', 'submitted', 'approved', 'rejected', 'cancelled'],
        ];
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'leave_no' => ['nullable', 'string', 'max:255'],
            'employee_id' => ['required', 'exists:employees,id'],
            'leave_type_id' => ['required', 'exists:leave_types,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'total_days' => ['nullable', 'numeric', 'min:0'],
            'is_half_day' => ['nullable', 'boolean'],
            'half_day_period' => ['nullable', 'string', 'max:20'],
            'reason' => ['nullable', 'string'],
            'requested_date' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,submitted,approved,rejected,cancelled'],
            'approval_note' => ['nullable', 'string'],
        ]);
    }
}
