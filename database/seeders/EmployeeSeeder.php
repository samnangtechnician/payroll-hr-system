<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $companyId = DB::table('companies')->where('company_code', 'DEMO')->value('id');
        $countryId = DB::table('countries')->where('iso2', 'KH')->value('id');
        $branchId = DB::table('branches')->where('company_id', $companyId)->where('branch_code', 'HQ')->value('id');
        $deptIt = DB::table('departments')->where('company_id', $companyId)->where('department_code', 'IT')->value('id');
        $deptHr = DB::table('departments')->where('company_id', $companyId)->where('department_code', 'HR')->value('id');
        $deptFin = DB::table('departments')->where('company_id', $companyId)->where('department_code', 'FIN')->value('id');
        $posSE = DB::table('positions')->where('company_id', $companyId)->where('position_code', 'SE')->value('id');
        $posHr = DB::table('positions')->where('company_id', $companyId)->where('position_code', 'HR-MGR')->value('id');
        $posStaff = DB::table('positions')->where('company_id', $companyId)->where('position_code', 'STAFF')->value('id');
        $posCeo = DB::table('positions')->where('company_id', $companyId)->where('position_code', 'CEO')->value('id');
        $empTypeFt = DB::table('employment_types')->where('company_id', $companyId)->where('name', 'Full-time')->value('id');
        $contractPerm = DB::table('contract_types')->where('company_id', $companyId)->where('name', 'Permanent')->value('id');
        $usd = DB::table('currencies')->where('code', 'USD')->value('id');

        $rows = [
            ['employee_code' => 'EMP-0001', 'first_name' => 'Sokha',   'last_name' => 'Chan', 'khmer_name' => 'ចាន់ សុខា',   'gender' => 'male',   'date_of_birth' => '1985-03-15', 'phone' => '+855 12 100 001', 'email' => 'sokha.chan@payroll-hr.local',   'department_id' => $deptIt,  'position_id' => $posCeo,   'basic_salary' => 3500.00, 'join_date' => '2018-01-01'],
            ['employee_code' => 'EMP-0002', 'first_name' => 'Sopheap', 'last_name' => 'Lim',  'khmer_name' => 'លឹម សុភាព',    'gender' => 'female', 'date_of_birth' => '1990-07-20', 'phone' => '+855 12 100 002', 'email' => 'sopheap.lim@payroll-hr.local',  'department_id' => $deptHr,  'position_id' => $posHr,    'basic_salary' => 1500.00, 'join_date' => '2019-06-15'],
            ['employee_code' => 'EMP-0003', 'first_name' => 'Dara',    'last_name' => 'Pich', 'khmer_name' => 'ពេជ្រ ដារា',    'gender' => 'male',   'date_of_birth' => '1992-11-05', 'phone' => '+855 12 100 003', 'email' => 'dara.pich@payroll-hr.local',    'department_id' => $deptIt,  'position_id' => $posSE,    'basic_salary' => 1200.00, 'join_date' => '2021-03-10'],
            ['employee_code' => 'EMP-0004', 'first_name' => 'Linda',   'last_name' => 'Heng', 'khmer_name' => 'ហេង លីនដា',    'gender' => 'female', 'date_of_birth' => '1995-05-22', 'phone' => '+855 12 100 004', 'email' => 'linda.heng@payroll-hr.local',   'department_id' => $deptFin, 'position_id' => $posStaff, 'basic_salary' => 800.00,  'join_date' => '2022-09-01'],
            ['employee_code' => 'EMP-0005', 'first_name' => 'Bopha',   'last_name' => 'Sok',  'khmer_name' => 'សុក បុប្ផា',    'gender' => 'female', 'date_of_birth' => '1998-09-30', 'phone' => '+855 12 100 005', 'email' => 'bopha.sok@payroll-hr.local',    'department_id' => $deptIt,  'position_id' => $posSE,    'basic_salary' => 950.00,  'join_date' => '2024-02-15'],
        ];

        foreach ($rows as $row) {
            DB::table('employees')->updateOrInsert(
                ['company_id' => $companyId, 'employee_code' => $row['employee_code']],
                array_merge($row, [
                    'company_id' => $companyId,
                    'country_id' => $countryId,
                    'branch_id' => $branchId,
                    'employment_type_id' => $empTypeFt,
                    'contract_type_id' => $contractPerm,
                    'salary_currency_id' => $usd,
                    'salary_payment_method' => 'bank_transfer',
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
