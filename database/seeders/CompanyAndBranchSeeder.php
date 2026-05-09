<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\ContractType;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\EmploymentType;
use App\Models\LeaveType;
use App\Models\Position;
use App\Models\Shift;
use Illuminate\Database\Seeder;

class CompanyAndBranchSeeder extends Seeder
{
    public function run(): void
    {
        $cambodia = Country::query()->where('iso2', 'KH')->first();
        $khr = Currency::query()->where('code', 'KHR')->first();
        $usd = Currency::query()->where('code', 'USD')->first();

        $company = Company::query()->updateOrCreate(
            ['company_code' => 'DEMO'],
            [
                'country_id' => $cambodia?->id,
                'currency_id' => $usd?->id ?? $khr?->id,
                'name' => 'Demo Payroll Co., Ltd.',
                'legal_name' => 'Demo Payroll Company Limited',
                'address' => '#100, Street 271, Phnom Penh',
                'phone' => '+855 12 000 000',
                'email' => 'info@payroll-hr.local',
                'website' => 'https://payroll-hr.local',
                'fiscal_year_start_month' => 'January',
                'payroll_cycle' => 'monthly',
                'working_days' => ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'],
                'is_active' => true,
            ]
        );

        $branches = [
            ['branch_code' => 'HQ',  'name' => 'Head Office',  'is_head_office' => true],
            ['branch_code' => 'BR1', 'name' => 'Branch One',   'is_head_office' => false],
            ['branch_code' => 'BR2', 'name' => 'Branch Two',   'is_head_office' => false],
        ];

        foreach ($branches as $row) {
            Branch::query()->updateOrCreate(
                ['company_id' => $company->id, 'branch_code' => $row['branch_code']],
                array_merge([
                    'country_id' => $cambodia?->id,
                    'phone' => '+855 12 111 111',
                    'email' => strtolower($row['branch_code']).'@payroll-hr.local',
                    'is_active' => true,
                ], $row)
            );
        }

        $hq = Branch::query()->where('company_id', $company->id)->where('branch_code', 'HQ')->first();

        $departments = [
            ['department_code' => 'HR',    'name' => 'Human Resources'],
            ['department_code' => 'FIN',   'name' => 'Finance'],
            ['department_code' => 'IT',    'name' => 'Information Technology'],
            ['department_code' => 'OPS',   'name' => 'Operations'],
            ['department_code' => 'SALES', 'name' => 'Sales & Marketing'],
        ];
        foreach ($departments as $row) {
            Department::query()->updateOrCreate(
                ['company_id' => $company->id, 'department_code' => $row['department_code']],
                array_merge(['branch_id' => $hq?->id, 'is_active' => true], $row)
            );
        }

        $hrDept = Department::query()->where('company_id', $company->id)->where('department_code', 'HR')->first();
        $itDept = Department::query()->where('company_id', $company->id)->where('department_code', 'IT')->first();

        $positions = [
            ['position_code' => 'CEO',  'title' => 'Chief Executive Officer', 'level' => 'C-Suite', 'is_managerial' => true,  'department_id' => null],
            ['position_code' => 'HRM',  'title' => 'HR Manager',              'level' => 'Manager', 'is_managerial' => true,  'department_id' => $hrDept?->id],
            ['position_code' => 'DEV',  'title' => 'Software Engineer',       'level' => 'Senior',  'is_managerial' => false, 'department_id' => $itDept?->id],
            ['position_code' => 'STAFF', 'title' => 'Staff',                   'level' => 'Junior',  'is_managerial' => false, 'department_id' => null],
        ];
        foreach ($positions as $row) {
            Position::query()->updateOrCreate(
                ['company_id' => $company->id, 'position_code' => $row['position_code']],
                array_merge(['is_active' => true], $row)
            );
        }

        $employmentTypes = ['Full-time', 'Part-time', 'Contract', 'Internship'];
        foreach ($employmentTypes as $name) {
            EmploymentType::query()->updateOrCreate(
                ['company_id' => $company->id, 'name' => $name],
                ['is_active' => true]
            );
        }

        $contractTypes = [
            ['name' => 'Permanent', 'default_months' => null],
            ['name' => 'Fixed-term 6 months', 'default_months' => 6],
            ['name' => 'Fixed-term 12 months', 'default_months' => 12],
            ['name' => 'Probation', 'default_months' => 3],
        ];
        foreach ($contractTypes as $row) {
            ContractType::query()->updateOrCreate(
                ['company_id' => $company->id, 'name' => $row['name']],
                array_merge(['is_active' => true], $row)
            );
        }

        $documentTypes = [
            ['name' => 'National ID',  'module' => 'employee'],
            ['name' => 'Passport',     'module' => 'employee', 'requires_expiry_date' => true],
            ['name' => 'Work Permit',  'module' => 'employee', 'requires_expiry_date' => true],
            ['name' => 'Contract',     'module' => 'employee'],
            ['name' => 'Certificate',  'module' => 'employee'],
        ];
        foreach ($documentTypes as $row) {
            DocumentType::query()->updateOrCreate(
                ['company_id' => $company->id, 'name' => $row['name'], 'module' => $row['module']],
                array_merge(['is_active' => true, 'requires_expiry_date' => false], $row)
            );
        }

        Shift::query()->updateOrCreate(
            ['company_id' => $company->id, 'shift_code' => 'STD'],
            [
                'name' => 'Standard 09:00 — 18:00',
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
                'break_minutes' => 60,
                'late_grace_minutes' => 15,
                'early_leave_grace_minutes' => 5,
                'is_night_shift' => false,
                'is_active' => true,
            ]
        );

        $leaveTypes = [
            ['name' => 'Annual Leave',   'code' => 'AL',  'default_entitlement_days' => 18, 'is_paid' => true],
            ['name' => 'Sick Leave',     'code' => 'SL',  'default_entitlement_days' => 7,  'is_paid' => true, 'requires_attachment' => true],
            ['name' => 'Personal Leave', 'code' => 'PL',  'default_entitlement_days' => 5,  'is_paid' => false, 'allow_half_day' => true],
            ['name' => 'Maternity Leave', 'code' => 'ML',  'default_entitlement_days' => 90, 'is_paid' => true],
        ];
        foreach ($leaveTypes as $row) {
            LeaveType::query()->updateOrCreate(
                ['company_id' => $company->id, 'name' => $row['name']],
                array_merge([
                    'country_id' => $cambodia?->id,
                    'is_active' => true,
                    'is_paid' => false,
                    'allow_half_day' => false,
                    'requires_attachment' => false,
                ], $row)
            );
        }
    }
}
