# Payroll & HR Management System

A multi-branch **Payroll & Human Resources** management web application built on **Laravel 12 + Vue 3 + Bootstrap 5**, with first-class support for **Khmer / English** language switching and a Cambodia-localized payroll demo dataset.

> Internal admin panel — designed for a single company with multiple branches, but the schema is multi-tenant ready (every operational table carries `company_id`).

---

## Table of Contents

1. [Tech Stack](#tech-stack)
2. [Features](#features)
3. [Repository Layout](#repository-layout)
4. [Quick Start](#quick-start)
5. [Default Login Accounts](#default-login-accounts)
6. [Database Migration & Seeding](#database-migration--seeding)
7. [Frontend Build](#frontend-build)
8. [Language Switching (Khmer / English)](#language-switching-khmer--english)
9. [Admin Layout & Blade Partials](#admin-layout--blade-partials)
10. [DataTables (Yajra Server-Side)](#datatables-yajra-server-side)
11. [Frontend Libraries](#frontend-libraries)
12. [Routes & Modules](#routes--modules)
13. [Adding a New CRUD Module](#adding-a-new-crud-module)
14. [Adding a New Language](#adding-a-new-language)
15. [Code Style & Linting](#code-style--linting)
16. [Common Commands](#common-commands)
17. [Troubleshooting](#troubleshooting)

---

## Tech Stack

| Layer        | Technology                                                                        |
|--------------|-----------------------------------------------------------------------------------|
| Backend      | PHP 8.2+, Laravel 12, Eloquent ORM                                                |
| Frontend     | Vue 3, Pinia, vue-i18n, Bootstrap 5.3, Vite 7                                     |
| Database     | MySQL 8 (single all-in-one schema migration, 96 application tables)               |
| UI / UX      | SweetAlert2 (delete confirmation), PHPFlasher (success toast), Flatpickr, Tom Select |
| DataTables   | Yajra Laravel DataTables (server-side) + datatables.net-bs5 + FixedHeader        |
| Auth & RBAC  | Laravel UI + Spatie Permissions (roles & permissions seeded)                      |
| Lint / Format| Laravel Pint                                                                      |

---

## Features

- **Multi-branch organisation** — Company → Branches → Departments → Positions
- **Employee directory** with Khmer & English names, contracts, documents, salary history
- **Attendance & shifts** — shift definitions, daily attendance records, public holidays
- **Leave management** — leave types, policies, balances, requests with approval flow
- **Payroll engine** — salary components, payroll periods/runs, payslips, tax & social-contribution rules
- **Performance** — KPIs, appraisal cycles, competency templates
- **Recruitment (ATS)** — job vacancies, candidates, interviews, offers
- **Learning & development** — courses, materials, quizzes, certificates
- **Asset management** — categories, assignments, maintenance records
- **Approvals workflow engine** with delegations
- **Audit log, login history, system settings, AI usage tracking, backup logs**
- **Bilingual UI (Khmer / English)** with **no page refresh** when switching
- **Idempotent seeders** for every one of the 96 tables (re-runnable safely)

---

## Repository Layout

```
.
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                  # 18 admin CRUD controllers
│   │   │   ├── Auth/                   # Login / logout
│   │   │   └── LocaleController.php    # Switches user locale (no refresh)
│   │   └── Middleware/SetLocale.php    # Reads session locale -> App::setLocale()
│   └── Models/                         # 30 Eloquent models
├── database/
│   ├── migrations/
│   │   └── 2026_05_09_000001_create_payroll_hr_all_in_one_schema.php
│   └── seeders/                        # One seeder per table (96+) + DatabaseSeeder
├── resources/
│   ├── js/
│   │   ├── app.js                      # Vue + Pinia + vue-i18n bootstrap
│   │   ├── i18n/                       # vue-i18n setup
│   │   └── components/                 # <language-switcher>, etc.
│   └── views/
│       ├── admin/                      # Per-module blade folders (CRUD)
│       └── admin/layouts/admin_layout.blade.php
├── routes/web.php                      # /admin/* resource routes
├── lang/
│   ├── en/  km/                        # Blade translations
│   └── en.json  km.json                # Vue translations (vue-i18n)
└── public/build/                       # Compiled Vite assets
```

---

## Quick Start

> Prerequisites: **PHP 8.2+**, **Composer 2**, **Node 20+**, **MySQL 8** (or MariaDB 10.6+).

```bash
# 1. Clone
git clone https://github.com/samnangtechnician/payroll-hr-system.git
cd payroll-hr-system

# 2. PHP + Node dependencies
composer install
npm install

# 3. Environment
cp .env.example .env
php artisan key:generate

# 4. Configure the DB in .env (defaults match below)
#    DB_DATABASE=payroll_hr
#    DB_USERNAME=payroll_hr
#    DB_PASSWORD=password

# 5. Create the MySQL database & user (one-time)
mysql -uroot -e "CREATE DATABASE payroll_hr CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -uroot -e "CREATE USER 'payroll_hr'@'localhost' IDENTIFIED BY 'password';"
mysql -uroot -e "GRANT ALL ON payroll_hr.* TO 'payroll_hr'@'localhost'; FLUSH PRIVILEGES;"

# 6. Run migrations + seed demo data
php artisan migrate:fresh --seed --force

# 7. Build frontend assets
npm run build

# 8. Serve
php artisan serve
```

Open <http://127.0.0.1:8000/login>.

> For active development you can run the Vite dev server and Laravel together:
>
> ```bash
> composer run dev
> ```
>
> This starts `php artisan serve`, `queue:listen`, `pail`, and `vite` concurrently.

---

## Default Login Accounts

Seeded by `UserSeeder`. All three share the password **`password`**.

| Email                          | Username | Role            |
|--------------------------------|----------|-----------------|
| `admin@payroll-hr.local`       | admin    | Admin (all)     |
| `hr@payroll-hr.local`          | hr       | HR Manager      |
| `finance@payroll-hr.local`     | finance  | Finance Manager |

> Change passwords immediately for any non-local environment.

---

## Database Migration & Seeding

This project ships **one all-in-one migration** that defines every table:

```
database/migrations/2026_05_09_000001_create_payroll_hr_all_in_one_schema.php
```

Run it with:

```bash
php artisan migrate                     # apply pending migrations only
php artisan migrate:fresh                # drop all tables, then migrate
php artisan migrate:fresh --seed --force # drop all + migrate + seed (recommended for dev)
```

### Seeders

There is one seeder class per table (96 application tables in total), all wired up in `DatabaseSeeder.php` and called in correct dependency order.

**Hand-crafted (realistic Cambodia / "DEMO" data)** — 18 seeders:

| Seeder                        | Rows | Notes                                                            |
|-------------------------------|------|------------------------------------------------------------------|
| `CountrySeeder`               | 20   | KH, US, TH, VN, SG, MY, ID, PH, JP, KR, CN, IN, AU, GB, CA, FR, DE, LA, MM, BN |
| `CurrencySeeder`              | 16   | USD, KHR (៛), EUR (€), THB (฿), VND (₫), JPY (¥), KRW (₩), INR (₹), …    |
| `CompanySeeder`               | 1    | "DEMO / Demo Payroll Co., Ltd." — Phnom Penh, USD                |
| `BranchSeeder`                | 3    | HQ, BR1 Siem Reap, BR2 Battambang                                |
| `DepartmentSeeder`            | 5    | HR, FIN, IT, OPS, SALES                                          |
| `PositionSeeder`              | 4    | CEO, HR-MGR, SE, STAFF                                           |
| `RoleSeeder`                  | 5    | Admin, HR Manager, Finance Manager, Branch Manager, Employee     |
| `PermissionSeeder`            | 84   | 21 modules × 4 actions (view/create/update/delete)               |
| `RolePermissionSeeder`        | 161  | Role → permission mappings                                       |
| `UserSeeder`                  | 3    | admin / hr / finance (password: `password`)                      |
| `UserRoleSeeder`              | 3    | user ↔ role assignments                                          |
| `EmploymentTypeSeeder`        | 4    | Full-time, Part-time, Contract, Internship                       |
| `ContractTypeSeeder`          | 4    | Probation (3m), Fixed Term (12m), Permanent, Internship (3m)     |
| `DocumentTypeSeeder`          | 6    | National ID, Passport, Contract, Resume, Diploma, Driving Lic.   |
| `ShiftSeeder`                 | 3    | STD 09–17, EARLY 06–14, NIGHT 22–06                              |
| `LeaveTypeSeeder`             | 5    | Annual, Sick, Maternity, Unpaid, Special                         |
| `PublicHolidaySeeder`         | 18   | Cambodia public holidays for 2026                                |
| `EmployeeSeeder`              | 5    | Sokha, Sopheap, Dara, Linda, Bopha (Khmer names included)        |

**Auto-generated** — 78 seeders covering every other operational table (attendance, leave policies/balances/requests, payroll periods/runs/items/payslips, KPI, appraisal, asset, ATS, approvals, learning, AI credits, audit log, …). Each uses `DB::table()->updateOrInsert([keys], [row])` so re-running `db:seed` never produces duplicate-key errors.

```bash
# Re-seed without dropping the database (idempotent)
php artisan db:seed
```

---

## Frontend Build

Vite is the build tool. Two main scripts in `package.json`:

```bash
npm run dev      # development with HMR (used by `composer run dev`)
npm run build    # production assets to public/build
```

Entry points:

- `resources/js/app.js` — bootstraps Vue, Pinia, vue-i18n, Bootstrap, SweetAlert2, Flatpickr, Tom Select
- `resources/sass/app.scss` (or `app.css`) — Bootstrap + custom styles

---

## Language Switching (Khmer / English)

The system supports **switching language without refreshing the page**.

How it works:

1. `lang/en.json` and `lang/km.json` hold all UI strings used by Vue components (vue-i18n).
2. `lang/en/*.php` and `lang/km/*.php` hold strings used in Blade templates.
3. The top-right `<language-switcher>` Vue component dispatches:
   - `i18n.global.locale.value = 'km' | 'en'` — instant UI update for any Vue text
   - `POST /locale { locale }` to `LocaleController` — saves the choice in `session('locale')` so subsequent page loads (and Blade renders) use the same language
4. `App\Http\Middleware\SetLocale` reads `session('locale')` on every request and calls `App::setLocale(...)`.

End result: clicking the flag instantly updates everything mounted as Vue, and the next full-page load re-renders Blade in the chosen language.

---

## Admin Layout & Blade Partials

The single admin layout is split into reusable partials so each section is isolated and easy to override:

```
resources/views/admin/layouts/admin_layout.blade.php   # extends @yield('content')
resources/views/admin_partials/
    head.blade.php         # <head>, CSRF, Vite assets, SweetAlert2, Flatpickr, Tom Select
    header.blade.php       # Top navbar + <language-switcher>
    left_sidebar.blade.php # Side menu (companies, branches, employees, payroll, …)
    scripts.blade.php      # Footer scripts, PHPFlasher, app.js
```

Use it from any view:

```blade
@extends('admin.layouts.admin_layout')

@section('content')
    {{-- your page --}}
@endsection
```

Every CRUD module under `resources/views/admin/<module>/` ships with separate blade files:

- `index.blade.php` — DataTable listing
- `_form.blade.php` — shared form fields (used by create + edit)
- `create.blade.php` — wraps `_form` for new records
- `edit.blade.php` — wraps `_form` for existing records
- `show.blade.php` — read-only details (employees only, by default)

---

## DataTables (Yajra Server-Side)

All listing pages use **server-side** processing via Yajra DataTables, with **fixed Bootstrap 5 pagination** styling and FixedHeader.

Backend pattern (e.g. `BranchController@data`):

```php
use Yajra\DataTables\Facades\DataTables;

public function data()
{
    $query = Branch::query()->with(['country', 'company']);
    return DataTables::eloquent($query)
        ->addColumn('action', fn ($row) => view('admin.branches._actions', compact('row'))->render())
        ->rawColumns(['action'])
        ->toJson();
}
```

Frontend pattern (in the module's `index.blade.php`):

```js
$('#branches-table').DataTable({
    serverSide: true,
    processing: true,
    ajax: '{{ route('admin.branches.data') }}',
    columns: [
        { data: 'branch_code' },
        { data: 'name' },
        // ...
        { data: 'action', orderable: false, searchable: false },
    ],
    fixedHeader: true,
    pagingType: 'full_numbers',
});
```

> Always call `DataTables::eloquent()` via the facade (`Yajra\DataTables\Facades\DataTables`). Calling the class statically does not work in Laravel 12.

---

## Frontend Libraries

| Library         | Used for                                | Where to look                           |
|-----------------|-----------------------------------------|-----------------------------------------|
| **SweetAlert2** | Delete confirmations                    | `resources/js/app.js` + per-page `_actions.blade.php` |
| **PHPFlasher**  | Success / error flash toasts            | Server-side: `flash()->addSuccess('...')` |
| **Flatpickr**   | Date / datetime inputs                  | Auto-bound on `input[data-flatpickr]`   |
| **Tom Select**  | Searchable selects (FK pickers)         | Auto-bound on `select[data-tom-select]` |
| **Yajra DT**    | Server-side DataTables                  | `app/Http/Controllers/Admin/*Controller.php@data` |
| **Bootstrap 5** | Layout, components, pagination          | `resources/sass/app.scss`               |
| **Pinia**       | Frontend state (current user, locale)   | `resources/js/stores/`                  |
| **vue-i18n**    | Vue translations                        | `resources/js/i18n/` + `lang/*.json`    |

---

## Routes & Modules

All admin routes live under `/admin/*` and are protected by the `auth` middleware. Each module exposes a Yajra data endpoint (`<module>/data`) plus a Laravel resource route.

| Module           | URL prefix                | Controller                           |
|------------------|---------------------------|--------------------------------------|
| Dashboard        | `/admin/dashboard`        | `DashboardController`                |
| Companies        | `/admin/companies`        | `CompanyController`                  |
| Branches         | `/admin/branches`         | `BranchController`                   |
| Departments      | `/admin/departments`      | `DepartmentController`               |
| Positions        | `/admin/positions`        | `PositionController`                 |
| Employees        | `/admin/employees`        | `EmployeeController`                 |
| Users            | `/admin/users`            | `UserController`                     |
| Roles            | `/admin/roles`            | `RoleController`                     |
| Shifts           | `/admin/shifts`           | `ShiftController`                    |
| Public Holidays  | `/admin/public-holidays`  | `PublicHolidayController`            |
| Attendance       | `/admin/attendance`       | `AttendanceController`               |
| Leave Types      | `/admin/leave-types`      | `LeaveTypeController`                |
| Leave Requests   | `/admin/leave-requests`   | `LeaveRequestController`             |
| Payroll Periods  | `/admin/payroll-periods`  | `PayrollPeriodController`            |
| Payroll Runs     | `/admin/payroll-runs`     | `PayrollRunController`               |
| Payslips         | `/admin/payslips`         | `PayslipController`                  |
| Countries        | `/admin/countries`        | `CountryController`                  |
| Currencies       | `/admin/currencies`       | `CurrencyController`                 |

Other tables in the schema (assets, ATS, KPI, appraisal, learning, expenses, approvals, audit log, AI usage, …) are **seeded** but their admin UI is not yet exposed — add controllers + views by following the pattern below.

---

## Adding a New CRUD Module

1. **Model** — create `app/Models/Foo.php` extending `Illuminate\Database\Eloquent\Model`.
2. **Controller** — create `app/Http/Controllers/Admin/FooController.php` with `index`, `data` (Yajra), `create`, `store`, `edit`, `update`, `destroy`.
3. **Routes** — in `routes/web.php` inside the `admin` prefix:
   ```php
   Route::get('foos/data', [FooController::class, 'data'])->name('foos.data');
   Route::resource('foos', FooController::class)->except('show');
   ```
4. **Views** — under `resources/views/admin/foos/`:
   - `index.blade.php` (DataTable)
   - `_form.blade.php` (shared)
   - `create.blade.php` and `edit.blade.php` (wrap `_form`)
   - `_actions.blade.php` (Edit / Delete buttons with SweetAlert2)
5. **Sidebar** — add a link in `resources/views/admin_partials/left_sidebar.blade.php`.
6. **Translations** — add labels to `lang/en/foos.php`, `lang/km/foos.php`, and `lang/en.json` / `lang/km.json` if used in Vue.
7. **Seeder** — drop in a per-table seeder at `database/seeders/FooSeeder.php` and register it in `DatabaseSeeder.php` in dependency order.

---

## Adding a New Language

1. Copy `lang/en/` to `lang/<code>/` and translate each PHP file.
2. Copy `lang/en.json` to `lang/<code>.json` and translate every value.
3. Add the locale to the `<language-switcher>` Vue component options.
4. Add the locale to `config/app.php` under `available_locales` if you've defined one, or to the validation rule in `LocaleController`.

---

## Code Style & Linting

This repo uses **Laravel Pint** (PHP-CS-Fixer wrapper):

```bash
vendor/bin/pint           # auto-fix PHP style
vendor/bin/pint --test    # check only (used in CI)
```

JS/Vue code is unformatted by default — feel free to add Prettier or ESLint if your team wants it.

---

## Common Commands

```bash
# DB / seeders
php artisan migrate:fresh --seed --force
php artisan db:seed
php artisan db:seed --class=EmployeeSeeder

# Cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear

# Routes / models
php artisan route:list
php artisan tinker

# Tests (PHPUnit)
php artisan test

# Lint
vendor/bin/pint --test

# Frontend
npm run dev
npm run build
```

---

## Troubleshooting

**`SQLSTATE[HY000] [1045] Access denied for user 'payroll_hr'@'localhost'`**
The MySQL user has not been created or has the wrong password. Re-run the `CREATE USER` / `GRANT` snippet in [Quick Start](#quick-start), then `php artisan migrate:fresh --seed --force`.

**`Class "Yajra\DataTables\DataTables" not found` or DataTables endpoint returns HTML**
Make sure controllers `use Yajra\DataTables\Facades\DataTables;` (the facade) and not `use Yajra\DataTables\DataTables;` (the class — calling its static methods does not work).

**Language switch updates Vue but Blade text stays English**
That's expected on the same page render — the Blade translations are baked in server-side. Either reload the page once after switching, or move the dynamic text into a Vue component that uses `$t('...')`.

**`Vite manifest not found`**
You forgot to build the frontend. Run `npm run build` (production) or `npm run dev` / `composer run dev` (development).

**`SQLSTATE[42000] [1071] Specified key was too long`**
Your MySQL is older than 5.7.7 with `innodb_large_prefix` disabled. Upgrade to MySQL 8, or set `Schema::defaultStringLength(191)` in `app/Providers/AppServiceProvider.php@boot`.

**Re-seeding fails with `Duplicate entry` errors**
You're running an older seeder that uses `insert()`. All seeders in this repo use `updateOrInsert()` and are idempotent — pull the latest `database/seeders/`.

---

## License

MIT — see [LICENSE](LICENSE) (defaults to the Laravel framework MIT license).

---

**Made with ❤️ in Phnom Penh.**
