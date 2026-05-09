<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    public function index(): View
    {
        return view('admin.branches.index');
    }

    public function data(Request $request): JsonResponse
    {
        $query = Branch::query()
            ->with(['company:id,name', 'country:id,name'])
            ->select('branches.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($b) => $b->company?->name)
            ->addColumn('country_name', fn ($b) => $b->country?->name)
            ->editColumn('is_head_office', fn ($b) => $b->is_head_office
                ? '<span class="badge bg-soft-primary">'.__('branches.head_office_badge').'</span>'
                : '<span class="text-muted">—</span>')
            ->editColumn('is_active', fn ($b) => $b->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->editColumn('created_at', fn ($b) => $b->created_at?->format('Y-m-d H:i'))
            ->addColumn('actions', function ($b) {
                $editUrl = route('admin.branches.edit', $b);
                $deleteUrl = route('admin.branches.destroy', $b);
                $editLabel = __('common.edit');
                $deleteLabel = __('common.delete');

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary" title="{$editLabel}">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$b->name}" title="{$deleteLabel}">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
                HTML;
            })
            ->rawColumns(['is_head_office', 'is_active', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.branches.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateBranch($request);

        Branch::create($data);

        sweetalert()->success(__('branches.saved'));

        return redirect()->route('admin.branches.index');
    }

    public function edit(Branch $branch): View
    {
        return view('admin.branches.edit', array_merge($this->formData(), [
            'branch' => $branch,
        ]));
    }

    public function update(Request $request, Branch $branch): RedirectResponse
    {
        $data = $this->validateBranch($request, $branch->id);

        $branch->update($data);

        sweetalert()->success(__('branches.saved'));

        return redirect()->route('admin.branches.index');
    }

    public function destroy(Branch $branch): RedirectResponse
    {
        $branch->delete();

        sweetalert()->success(__('branches.deleted'));

        return redirect()->route('admin.branches.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
            'countries' => Country::query()->orderBy('name')->get(['id', 'name']),
        ];
    }

    private function validateBranch(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'branch_code' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'is_head_office' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }
}
