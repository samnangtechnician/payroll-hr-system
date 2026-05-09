<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CountryController extends Controller
{
    public function index(): View
    {
        return view('admin.countries.index');
    }

    public function data(): JsonResponse
    {
        return DataTables::eloquent(Country::query())
            ->editColumn('is_supported_payroll_country', fn ($c) => $c->is_supported_payroll_country
                ? '<span class="badge bg-soft-success">'.__('common.yes').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.no').'</span>')
            ->editColumn('is_active', fn ($c) => $c->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->rawColumns(['is_supported_payroll_country', 'is_active'])
            ->toJson();
    }
}
