<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CurrencyController extends Controller
{
    public function index(): View
    {
        return view('admin.currencies.index');
    }

    public function data(): JsonResponse
    {
        return DataTables::eloquent(Currency::query())
            ->editColumn('is_active', fn ($c) => $c->is_active
                ? '<span class="badge bg-soft-success">'.__('common.active').'</span>'
                : '<span class="badge bg-soft-secondary">'.__('common.inactive').'</span>')
            ->rawColumns(['is_active'])
            ->toJson();
    }
}
