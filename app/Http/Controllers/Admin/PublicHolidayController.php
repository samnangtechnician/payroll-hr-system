<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\PublicHoliday;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class PublicHolidayController extends Controller
{
    public function index(): View
    {
        return view('admin.public_holidays.index');
    }

    public function data(): JsonResponse
    {
        $query = PublicHoliday::query()
            ->with(['company:id,name', 'country:id,name'])
            ->select('public_holidays.*');

        return DataTables::eloquent($query)
            ->addColumn('company_name', fn ($h) => $h->company?->name ?? '—')
            ->addColumn('country_name', fn ($h) => $h->country?->name ?? '—')
            ->editColumn('holiday_date', fn ($h) => $h->holiday_date?->format('Y-m-d'))
            ->editColumn('is_recurring', fn ($h) => $h->is_recurring
                ? '<span class="badge bg-soft-info">'.__('common.yes').'</span>'
                : '—')
            ->addColumn('actions', function ($h) {
                $editUrl = route('admin.public-holidays.edit', $h);
                $deleteUrl = route('admin.public-holidays.destroy', $h);

                return <<<HTML
                <div class="d-inline-flex gap-1">
                  <a href="{$editUrl}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                  <button type="button" class="btn btn-sm btn-outline-danger"
                    data-confirm-delete data-url="{$deleteUrl}"
                    data-item-label="{$h->name}"><i class="bi bi-trash"></i></button>
                </div>
                HTML;
            })
            ->rawColumns(['is_recurring', 'actions'])
            ->toJson();
    }

    public function create(): View
    {
        return view('admin.public_holidays.create', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        PublicHoliday::create($this->validateHoliday($request));
        sweetalert()->success(__('public_holidays.saved'));

        return redirect()->route('admin.public-holidays.index');
    }

    public function edit(PublicHoliday $publicHoliday): View
    {
        return view('admin.public_holidays.edit', array_merge($this->formData(), [
            'publicHoliday' => $publicHoliday,
        ]));
    }

    public function update(Request $request, PublicHoliday $publicHoliday): RedirectResponse
    {
        $publicHoliday->update($this->validateHoliday($request));
        sweetalert()->success(__('public_holidays.saved'));

        return redirect()->route('admin.public-holidays.index');
    }

    public function destroy(PublicHoliday $publicHoliday): RedirectResponse
    {
        $publicHoliday->delete();
        sweetalert()->success(__('public_holidays.deleted'));

        return redirect()->route('admin.public-holidays.index');
    }

    private function formData(): array
    {
        return [
            'companies' => Company::query()->orderBy('name')->get(['id', 'name']),
            'countries' => Country::query()->orderBy('name')->get(['id', 'name']),
        ];
    }

    private function validateHoliday(Request $request): array
    {
        return $request->validate([
            'company_id' => ['nullable', 'exists:companies,id'],
            'country_id' => ['nullable', 'exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
            'holiday_date' => ['required', 'date'],
            'is_recurring' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string'],
        ]);
    }
}
