<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| All-in-one Payroll & HR Management System schema
|--------------------------------------------------------------------------
|
| Recommended for Laravel 10/11/12 + MySQL 8.x.
| This migration is intentionally broad so it can be used as a starting
| database foundation for:
| - HR dashboard
| - employee management
| - attendance, leave, OT, payroll
| - project payments
| - multi-country payroll
| - inbox, learning, assets
| - appraisal, KPI, expense, ATS
| - AI usage, approvals, reports, notifications
| - security, audit logs, settings, backup
|
| Notes:
| - Keep statuses as strings for easier customization.
| - Use utf8mb4 / InnoDB in your database configuration.
| - Split this migration into smaller files later if your team prefers.
|
*/

return new class extends Migration
{
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        /*
        |--------------------------------------------------------------------------
        | Foundation / Organization
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iso2', 2)->nullable()->unique();
            $table->string('iso3', 3)->nullable()->unique();
            $table->string('phone_code', 20)->nullable();
            $table->string('default_currency_code', 10)->nullable();
            $table->boolean('is_supported_payroll_country')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name');
            $table->string('symbol', 20)->nullable();
            $table->unsignedTinyInteger('decimal_places')->default(2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->string('company_code')->nullable()->unique();
            $table->string('name');
            $table->string('legal_name')->nullable();
            $table->string('logo_path')->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('tax_registration_no')->nullable();
            $table->string('business_registration_no')->nullable();
            $table->string('fiscal_year_start_month', 20)->nullable();
            $table->string('payroll_cycle', 50)->nullable();
            $table->json('working_days')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('branch_code')->nullable();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_head_office')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['company_id', 'branch_code']);
        });

        $this->createIfMissing('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->unsignedBigInteger('manager_employee_id')->nullable()->index();
            $table->string('department_code')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['company_id', 'department_code']);
        });

        $this->createIfMissing('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->string('position_code')->nullable();
            $table->string('title');
            $table->string('level')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_managerial')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['company_id', 'position_code']);
        });

        /*
        |--------------------------------------------------------------------------
        | Security / RBAC / Users
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->string('guard_name')->default('web');
            $table->text('description')->nullable();
            $table->boolean('is_system')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'name', 'guard_name']);
        });

        $this->createIfMissing('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('module', 100)->index();
            $table->string('name');
            $table->string('guard_name')->default('web');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unique(['module', 'name', 'guard_name']);
        });

        $this->createIfMissing('role_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->foreignId('permission_id')->constrained('permissions')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['role_id', 'permission_id']);
        });

        $this->createIfMissing('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->unsignedBigInteger('employee_id')->nullable()->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->nullable()->unique();
            $table->string('phone', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('two_factor_enabled')->default(false);
            $table->text('two_factor_secret')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip', 100)->nullable();
            $table->unsignedSmallInteger('failed_login_attempts')->default(0);
            $table->timestamp('locked_until')->nullable();
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'role_id', 'company_id', 'country_id', 'branch_id', 'department_id'], 'user_roles_scope_unique');
        });

        $this->createIfMissing('login_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('email')->nullable();
            $table->string('ip_address', 100)->nullable();
            $table->string('user_agent')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('platform')->nullable();
            $table->boolean('was_successful')->default(false);
            $table->string('failure_reason')->nullable();
            $table->timestamp('logged_in_at')->nullable();
            $table->timestamp('logged_out_at')->nullable();
            $table->timestamps();
            $table->index(['user_id', 'logged_in_at']);
        });

        /*
        |--------------------------------------------------------------------------
        | Employee Management
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('employment_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('name'); // Full-time, Part-time, Contract, Internship
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'name']);
        });

        $this->createIfMissing('contract_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->unsignedSmallInteger('default_months')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'name']);
        });

        $this->createIfMissing('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete();
            $table->foreignId('employment_type_id')->nullable()->constrained('employment_types')->nullOnDelete();
            $table->foreignId('contract_type_id')->nullable()->constrained('contract_types')->nullOnDelete();
            $table->foreignId('manager_employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('employee_code');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('khmer_name')->nullable();
            $table->string('gender', 30)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('secondary_phone', 50)->nullable();
            $table->string('email')->nullable();
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('national_id_no')->nullable();
            $table->string('passport_no')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->string('work_permit_no')->nullable();
            $table->date('work_permit_expiry_date')->nullable();
            $table->date('join_date')->nullable();
            $table->date('probation_end_date')->nullable();
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->date('resignation_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->decimal('basic_salary', 15, 2)->default(0);
            $table->foreignId('salary_currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->string('salary_payment_method', 50)->nullable();
            $table->string('status', 50)->default('active')->index(); // active, resigned, terminated, probation, inactive
            $table->string('profile_photo_path')->nullable();
            $table->json('extra')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['company_id', 'employee_code']);
            $table->index(['company_id', 'status']);
            $table->index(['department_id', 'position_id']);
        });

        $this->createIfMissing('employee_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('bank_name');
            $table->string('bank_branch')->nullable();
            $table->string('account_name');
            $table->string('account_number');
            $table->string('swift_code')->nullable();
            $table->string('bank_code')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('employee_emergency_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('name');
            $table->string('relationship', 100)->nullable();
            $table->string('phone', 50);
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        $this->createIfMissing('document_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->string('module', 100)->nullable();
            $table->boolean('requires_expiry_date')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'name', 'module']);
        });

        $this->createIfMissing('employee_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('document_type_id')->nullable()->constrained('document_types')->nullOnDelete();
            $table->string('document_no')->nullable();
            $table->string('title');
            $table->string('file_path');
            $table->string('file_name')->nullable();
            $table->string('mime_type', 100)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->date('issued_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 50)->default('active')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('employee_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('contract_type_id')->nullable()->constrained('contract_types')->nullOnDelete();
            $table->string('contract_no')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('salary_amount', 15, 2)->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->string('file_path')->nullable();
            $table->string('status', 50)->default('active')->index();
            $table->text('remarks')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('employee_salary_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->decimal('old_salary', 15, 2)->nullable();
            $table->decimal('new_salary', 15, 2);
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->date('effective_date');
            $table->string('reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        $this->createIfMissing('employee_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('old_status', 50)->nullable();
            $table->string('new_status', 50);
            $table->date('effective_date')->nullable();
            $table->text('reason')->nullable();
            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Daily Employee Activity / Projects
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->string('project_code')->nullable();
            $table->string('name');
            $table->string('client_name')->nullable();
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('budget_amount', 15, 2)->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->string('status', 50)->default('active')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['company_id', 'project_code']);
        });

        $this->createIfMissing('project_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('role_title')->nullable();
            $table->decimal('hourly_rate', 15, 2)->nullable();
            $table->decimal('daily_rate', 15, 2)->nullable();
            $table->date('assigned_from')->nullable();
            $table->date('assigned_to')->nullable();
            $table->string('status', 50)->default('active')->index();
            $table->timestamps();
            $table->unique(['project_id', 'employee_id']);
        });

        $this->createIfMissing('daily_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('activity_no')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->date('activity_date')->index();
            $table->string('task_title');
            $table->text('task_description')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->decimal('total_hours', 8, 2)->default(0);
            $table->decimal('progress_percent', 5, 2)->default(0);
            $table->string('work_status', 50)->nullable();
            $table->string('attachment_path')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('approval_status', 50)->default('draft')->index();
            $table->text('manager_comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['employee_id', 'activity_date']);
        });

        /*
        |--------------------------------------------------------------------------
        | Attendance / Shift / Holiday
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('shift_code')->nullable();
            $table->string('name');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedSmallInteger('break_minutes')->default(0);
            $table->unsignedSmallInteger('late_grace_minutes')->default(0);
            $table->unsignedSmallInteger('early_leave_grace_minutes')->default(0);
            $table->boolean('is_night_shift')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'shift_code']);
        });

        $this->createIfMissing('employee_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('shift_id')->constrained('shifts')->cascadeOnDelete();
            $table->date('effective_from');
            $table->date('effective_to')->nullable();
            $table->timestamps();
            $table->index(['employee_id', 'effective_from']);
        });

        $this->createIfMissing('public_holidays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('name');
            $table->date('holiday_date')->index();
            $table->boolean('is_recurring')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->unique(['company_id', 'country_id', 'holiday_date', 'name'], 'public_holidays_unique');
        });

        $this->createIfMissing('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('shift_id')->nullable()->constrained('shifts')->nullOnDelete();
            $table->date('attendance_date')->index();
            $table->timestamp('check_in_at')->nullable();
            $table->timestamp('check_out_at')->nullable();
            $table->decimal('total_working_hours', 8, 2)->default(0);
            $table->unsignedInteger('late_minutes')->default(0);
            $table->unsignedInteger('early_leave_minutes')->default(0);
            $table->decimal('ot_hours', 8, 2)->default(0);
            $table->string('attendance_status', 50)->default('present')->index();
            $table->string('work_mode', 50)->nullable(); // office, wfh, field
            $table->decimal('check_in_latitude', 10, 7)->nullable();
            $table->decimal('check_in_longitude', 10, 7)->nullable();
            $table->decimal('check_out_latitude', 10, 7)->nullable();
            $table->decimal('check_out_longitude', 10, 7)->nullable();
            $table->string('biometric_device_id')->nullable();
            $table->boolean('is_manual')->default(false);
            $table->text('manual_reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['employee_id', 'attendance_date']);
        });

        /*
        |--------------------------------------------------------------------------
        | Leave Management
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('leave_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('name');
            $table->string('code')->nullable();
            $table->decimal('default_entitlement_days', 8, 2)->default(0);
            $table->boolean('is_paid')->default(true);
            $table->boolean('allow_half_day')->default(true);
            $table->boolean('requires_attachment')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'country_id', 'code']);
        });

        $this->createIfMissing('leave_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('leave_type_id')->constrained('leave_types')->cascadeOnDelete();
            $table->decimal('entitlement_days', 8, 2)->default(0);
            $table->boolean('allow_carry_forward')->default(false);
            $table->decimal('max_carry_forward_days', 8, 2)->nullable();
            $table->boolean('deduct_from_payroll')->default(false);
            $table->json('rules')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('leave_type_id')->constrained('leave_types')->cascadeOnDelete();
            $table->unsignedSmallInteger('year');
            $table->decimal('entitled_days', 8, 2)->default(0);
            $table->decimal('carried_forward_days', 8, 2)->default(0);
            $table->decimal('used_days', 8, 2)->default(0);
            $table->decimal('pending_days', 8, 2)->default(0);
            $table->decimal('remaining_days', 8, 2)->default(0);
            $table->timestamps();
            $table->unique(['employee_id', 'leave_type_id', 'year']);
        });

        $this->createIfMissing('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->string('leave_no')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('leave_type_id')->constrained('leave_types')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_days', 8, 2)->default(0);
            $table->boolean('is_half_day')->default(false);
            $table->string('half_day_period', 20)->nullable();
            $table->text('reason')->nullable();
            $table->string('attachment_path')->nullable();
            $table->date('requested_date')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->string('status', 50)->default('draft')->index();
            $table->text('approval_note')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['employee_id', 'start_date', 'end_date']);
        });

        $this->createIfMissing('leave_request_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_request_id')->constrained('leave_requests')->cascadeOnDelete();
            $table->date('leave_date')->index();
            $table->decimal('days', 4, 2)->default(1);
            $table->boolean('is_paid')->default(true);
            $table->timestamps();
            $table->unique(['leave_request_id', 'leave_date']);
        });

        /*
        |--------------------------------------------------------------------------
        | Project-Based Payment / Overtime
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('project_payment_records', function (Blueprint $table) {
            $table->id();
            $table->string('project_payment_no')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->string('task_or_work_type')->nullable();
            $table->date('work_date')->index();
            $table->decimal('approved_hours', 8, 2)->default(0);
            $table->decimal('rate', 15, 2)->default(0);
            $table->decimal('payment_amount', 15, 2)->default(0);
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->date('approved_at')->nullable();
            $table->string('payroll_month', 7)->nullable()->index(); // YYYY-MM
            $table->boolean('included_in_payroll')->default(false);
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('overtime_rate_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('ot_type', 100);
            $table->decimal('rate_multiplier', 8, 4)->default(1);
            $table->decimal('fixed_hourly_rate', 15, 2)->nullable();
            $table->json('conditions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('overtime_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ot_no')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('attendance_record_id')->nullable()->constrained('attendance_records')->nullOnDelete();
            $table->date('ot_date')->index();
            $table->string('ot_type', 100);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->decimal('ot_hours', 8, 2)->default(0);
            $table->decimal('ot_rate', 15, 4)->default(0);
            $table->decimal('ot_amount', 15, 2)->default(0);
            $table->text('reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->boolean('included_in_payroll')->default(false);
            $table->string('payroll_month', 7)->nullable()->index();
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        /*
        |--------------------------------------------------------------------------
        | Payroll / Multi-Country Payroll
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('country_payroll_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->string('payroll_cycle', 50)->default('monthly');
            $table->json('working_days')->nullable();
            $table->json('tax_rule')->nullable();
            $table->json('social_contribution_rule')->nullable();
            $table->json('bank_export_format')->nullable();
            $table->json('payslip_format')->nullable();
            $table->string('payslip_language', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['country_id', 'payroll_cycle']);
        });

        $this->createIfMissing('tax_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->string('name');
            $table->date('effective_from');
            $table->date('effective_to')->nullable();
            $table->json('brackets')->nullable();
            $table->json('settings')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('social_contribution_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->string('name');
            $table->date('effective_from');
            $table->date('effective_to')->nullable();
            $table->decimal('employee_rate', 8, 4)->nullable();
            $table->decimal('employer_rate', 8, 4)->nullable();
            $table->decimal('ceiling_amount', 15, 2)->nullable();
            $table->json('settings')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('salary_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('component_code')->nullable();
            $table->string('name');
            $table->string('type', 50)->index(); // earning, deduction, contribution, tax
            $table->boolean('is_taxable')->default(false);
            $table->boolean('is_fixed')->default(false);
            $table->boolean('is_system')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'component_code']);
        });

        $this->createIfMissing('employee_salary_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('salary_component_id')->constrained('salary_components')->cascadeOnDelete();
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('percentage', 8, 4)->nullable();
            $table->date('effective_from')->nullable();
            $table->date('effective_to')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('payroll_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('period_code')->index(); // YYYY-MM
            $table->date('start_date');
            $table->date('end_date');
            $table->date('payment_date')->nullable();
            $table->string('status', 50)->default('open')->index();
            $table->timestamps();
            $table->unique(['company_id', 'country_id', 'period_code']);
        });

        $this->createIfMissing('payroll_runs', function (Blueprint $table) {
            $table->id();
            $table->string('payroll_no')->unique();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('payroll_period_id')->constrained('payroll_periods')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('hr_reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('finance_reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('calculated_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->decimal('gross_amount', 15, 2)->default(0);
            $table->decimal('total_deduction', 15, 2)->default(0);
            $table->decimal('net_amount', 15, 2)->default(0);
            $table->string('status', 50)->default('draft')->index();
            $table->json('calculation_snapshot')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('payroll_run_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_run_id')->constrained('payroll_runs')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->decimal('basic_salary', 15, 2)->default(0);
            $table->decimal('allowance_amount', 15, 2)->default(0);
            $table->decimal('bonus_amount', 15, 2)->default(0);
            $table->decimal('commission_amount', 15, 2)->default(0);
            $table->decimal('project_payment_amount', 15, 2)->default(0);
            $table->decimal('overtime_amount', 15, 2)->default(0);
            $table->decimal('salary_advance_amount', 15, 2)->default(0);
            $table->decimal('deduction_amount', 15, 2)->default(0);
            $table->decimal('unpaid_leave_deduction', 15, 2)->default(0);
            $table->decimal('late_deduction', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('social_contribution_amount', 15, 2)->default(0);
            $table->decimal('gross_salary', 15, 2)->default(0);
            $table->decimal('net_salary', 15, 2)->default(0);
            $table->string('status', 50)->default('calculated')->index();
            $table->json('calculation_detail')->nullable();
            $table->timestamps();
            $table->unique(['payroll_run_id', 'employee_id']);
        });

        $this->createIfMissing('payroll_item_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_run_item_id')->constrained('payroll_run_items')->cascadeOnDelete();
            $table->foreignId('salary_component_id')->nullable()->constrained('salary_components')->nullOnDelete();
            $table->string('component_name');
            $table->string('component_type', 50)->index();
            $table->decimal('amount', 15, 2)->default(0);
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_run_item_id')->constrained('payroll_run_items')->cascadeOnDelete();
            $table->string('payslip_no')->unique();
            $table->string('file_path')->nullable();
            $table->timestamp('released_at')->nullable();
            $table->timestamp('downloaded_at')->nullable();
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
        });

        $this->createIfMissing('salary_advances', function (Blueprint $table) {
            $table->id();
            $table->string('advance_no')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->decimal('amount', 15, 2)->default(0);
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->date('requested_date')->nullable();
            $table->date('repayment_start_date')->nullable();
            $table->unsignedSmallInteger('repayment_months')->default(1);
            $table->decimal('monthly_repayment_amount', 15, 2)->nullable();
            $table->text('reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->boolean('included_in_payroll')->default(false);
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('bank_export_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_run_id')->constrained('payroll_runs')->cascadeOnDelete();
            $table->string('batch_no')->unique();
            $table->string('bank_name')->nullable();
            $table->string('file_format', 50)->nullable();
            $table->string('file_path')->nullable();
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->unsignedInteger('total_employees')->default(0);
            $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('generated_at')->nullable();
            $table->string('status', 50)->default('generated')->index();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Inbox / Notification
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('inbox_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('sender_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('type', 100)->index(); // announcement, approval_request, reminder, payroll_message
            $table->string('subject');
            $table->longText('body')->nullable();
            $table->string('related_type')->nullable();
            $table->unsignedBigInteger('related_id')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['related_type', 'related_id']);
        });

        $this->createIfMissing('inbox_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inbox_message_id')->constrained('inbox_messages')->cascadeOnDelete();
            $table->foreignId('recipient_user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('recipient_employee_id')->nullable()->constrained('employees')->cascadeOnDelete();
            $table->timestamp('read_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();
            $table->index(['recipient_user_id', 'read_at']);
        });

        $this->createIfMissing('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('type', 100)->index();
            $table->string('channel', 50)->index(); // system, inbox, email, sms, telegram, whatsapp, push
            $table->string('subject')->nullable();
            $table->longText('body_template')->nullable();
            $table->json('variables')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'type', 'channel']);
        });

        $this->createIfMissing('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->cascadeOnDelete();
            $table->string('type', 100)->index();
            $table->string('channel', 50)->index();
            $table->string('title');
            $table->longText('message')->nullable();
            $table->string('related_type')->nullable();
            $table->unsignedBigInteger('related_id')->nullable();
            $table->json('payload')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->string('status', 50)->default('pending')->index();
            $table->timestamps();
            $table->index(['related_type', 'related_id']);
        });

        /*
        |--------------------------------------------------------------------------
        | Employee Learning Library
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('learning_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'name']);
        });

        $this->createIfMissing('learning_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('learning_category_id')->nullable()->constrained('learning_categories')->nullOnDelete();
            $table->string('course_code')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('assigned_department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->date('due_date')->nullable();
            $table->boolean('quiz_required')->default(false);
            $table->boolean('certificate_required')->default(false);
            $table->string('status', 50)->default('active')->index();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['company_id', 'course_code']);
        });

        $this->createIfMissing('learning_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_course_id')->constrained('learning_courses')->cascadeOnDelete();
            $table->string('title');
            $table->string('material_type', 50); // video, pdf, document, link
            $table->string('file_path')->nullable();
            $table->string('external_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $this->createIfMissing('learning_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_course_id')->constrained('learning_courses')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('assigned_date')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('status', 50)->default('not_started')->index();
            $table->decimal('progress_percent', 5, 2)->default(0);
            $table->timestamps();
            $table->unique(['learning_course_id', 'employee_id']);
        });

        $this->createIfMissing('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_course_id')->constrained('learning_courses')->cascadeOnDelete();
            $table->string('title');
            $table->decimal('passing_score', 5, 2)->default(0);
            $table->unsignedSmallInteger('time_limit_minutes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->cascadeOnDelete();
            $table->longText('question');
            $table->string('question_type', 50)->default('multiple_choice');
            $table->json('options')->nullable();
            $table->json('correct_answer')->nullable();
            $table->decimal('points', 8, 2)->default(1);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $this->createIfMissing('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->decimal('score', 5, 2)->default(0);
            $table->boolean('passed')->default(false);
            $table->json('answers')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('learning_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_assignment_id')->constrained('learning_assignments')->cascadeOnDelete();
            $table->string('certificate_no')->unique();
            $table->date('issued_date')->nullable();
            $table->string('file_path')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('policy_acknowledgements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('document_type_id')->nullable()->constrained('document_types')->nullOnDelete();
            $table->string('policy_title');
            $table->string('policy_file_path')->nullable();
            $table->timestamp('acknowledged_at')->nullable();
            $table->string('status', 50)->default('pending')->index();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Asset Management
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('asset_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'name']);
        });

        $this->createIfMissing('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('asset_category_id')->nullable()->constrained('asset_categories')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->string('asset_code')->unique();
            $table->string('name');
            $table->string('brand_model')->nullable();
            $table->string('serial_no')->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 15, 2)->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->string('location')->nullable();
            $table->string('condition', 50)->nullable();
            $table->string('status', 50)->default('available')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('asset_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('assigned_date')->nullable();
            $table->date('returned_date')->nullable();
            $table->string('condition_on_assign')->nullable();
            $table->string('condition_on_return')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 50)->default('assigned')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('asset_maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $table->date('maintenance_date')->nullable();
            $table->string('vendor')->nullable();
            $table->decimal('cost', 15, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->default('completed')->index();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Performance Appraisal / Competency / KPI
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('appraisal_cycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->date('period_start');
            $table->date('period_end');
            $table->date('submission_deadline')->nullable();
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
        });

        $this->createIfMissing('competency_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('competency_template_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competency_template_id')->constrained('competency_templates')->cascadeOnDelete();
            $table->string('name'); // technical skill, communication, leadership...
            $table->text('description')->nullable();
            $table->decimal('weight', 5, 2)->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $this->createIfMissing('appraisal_records', function (Blueprint $table) {
            $table->id();
            $table->string('appraisal_no')->unique();
            $table->foreignId('appraisal_cycle_id')->constrained('appraisal_cycles')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('reviewer_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete();
            $table->decimal('kpi_score', 5, 2)->default(0);
            $table->decimal('competency_score', 5, 2)->default(0);
            $table->decimal('attendance_score', 5, 2)->default(0);
            $table->decimal('behavior_score', 5, 2)->default(0);
            $table->decimal('final_rating', 5, 2)->default(0);
            $table->text('recommendation')->nullable();
            $table->text('development_plan')->nullable();
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('appraisal_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appraisal_record_id')->constrained('appraisal_records')->cascadeOnDelete();
            $table->string('score_type', 100); // competency, kpi, behavior, attendance
            $table->string('criteria_name');
            $table->decimal('weight', 5, 2)->default(0);
            $table->decimal('score', 5, 2)->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('kpi_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->string('review_frequency', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('kpis', function (Blueprint $table) {
            $table->id();
            $table->string('kpi_code')->unique();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('target_value', 15, 2)->nullable();
            $table->string('unit', 50)->nullable();
            $table->decimal('weight_percent', 5, 2)->default(0);
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('kpi_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpi_id')->constrained('kpis')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->cascadeOnDelete();
            $table->date('review_period_start');
            $table->date('review_period_end');
            $table->decimal('target_value', 15, 2)->nullable();
            $table->decimal('actual_result', 15, 2)->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->decimal('rating', 5, 2)->nullable();
            $table->string('evidence_attachment_path')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 50)->default('assigned')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('kpi_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpi_assignment_id')->constrained('kpi_assignments')->cascadeOnDelete();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->date('review_date')->nullable();
            $table->decimal('progress_percent', 5, 2)->default(0);
            $table->decimal('score', 5, 2)->nullable();
            $table->text('comment')->nullable();
            $table->string('status', 50)->default('reviewed')->index();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Expense / Advance / Reimbursement
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('monthly_limit', 15, 2)->nullable();
            $table->boolean('requires_receipt')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['company_id', 'name']);
        });

        $this->createIfMissing('expense_claims', function (Blueprint $table) {
            $table->id();
            $table->string('claim_no')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->date('claim_date')->nullable();
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->decimal('approved_amount', 15, 2)->default(0);
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->text('description')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->string('payment_status', 50)->default('unpaid')->index();
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('expense_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_claim_id')->constrained('expense_claims')->cascadeOnDelete();
            $table->foreignId('expense_category_id')->nullable()->constrained('expense_categories')->nullOnDelete();
            $table->date('expense_date')->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('receipt_path')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('advance_requests', function (Blueprint $table) {
            $table->id();
            $table->string('advance_no')->unique();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('settled_amount', 15, 2)->default(0);
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->date('requested_date')->nullable();
            $table->date('settlement_due_date')->nullable();
            $table->text('purpose')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        /*
        |--------------------------------------------------------------------------
        | ATS / Recruitment
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('job_code')->unique();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained('positions')->nullOnDelete();
            $table->foreignId('hiring_manager_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('job_title');
            $table->string('location')->nullable();
            $table->string('employment_type')->nullable();
            $table->decimal('salary_min', 15, 2)->nullable();
            $table->decimal('salary_max', 15, 2)->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->longText('job_description')->nullable();
            $table->longText('requirements')->nullable();
            $table->date('posting_date')->nullable();
            $table->date('closing_date')->nullable();
            $table->boolean('free_posting_2026')->default(false);
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_vacancy_id')->nullable()->constrained('job_vacancies')->nullOnDelete();
            $table->string('candidate_no')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('source')->nullable();
            $table->decimal('expected_salary', 15, 2)->nullable();
            $table->text('resume_summary')->nullable();
            $table->string('pipeline_status', 100)->default('applied')->index();
            $table->string('status', 50)->default('active')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        $this->createIfMissing('candidate_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates')->cascadeOnDelete();
            $table->string('document_type', 100)->nullable();
            $table->string('file_path');
            $table->string('file_name')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('interview_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates')->cascadeOnDelete();
            $table->foreignId('job_vacancy_id')->nullable()->constrained('job_vacancies')->nullOnDelete();
            $table->timestamp('scheduled_at');
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->string('location')->nullable();
            $table->string('meeting_link')->nullable();
            $table->foreignId('interviewer_employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->string('status', 50)->default('scheduled')->index();
            $table->timestamps();
        });

        $this->createIfMissing('interview_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('interview_schedule_id')->constrained('interview_schedules')->cascadeOnDelete();
            $table->foreignId('reviewer_employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->decimal('score', 5, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->string('recommendation', 50)->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('job_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained('candidates')->cascadeOnDelete();
            $table->foreignId('job_vacancy_id')->nullable()->constrained('job_vacancies')->nullOnDelete();
            $table->string('offer_no')->unique();
            $table->decimal('offered_salary', 15, 2)->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->date('offer_date')->nullable();
            $table->date('expected_join_date')->nullable();
            $table->string('offer_letter_path')->nullable();
            $table->string('status', 50)->default('draft')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        /*
        |--------------------------------------------------------------------------
        | Better HR AI Module
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('ai_credit_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('billing_month', 7)->index(); // YYYY-MM
            $table->decimal('monthly_credit_amount', 15, 2)->default(50);
            $table->decimal('used_credit_amount', 15, 2)->default(0);
            $table->decimal('remaining_credit_amount', 15, 2)->default(50);
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->json('limits')->nullable();
            $table->timestamps();
            $table->unique(['company_id', 'billing_month']);
        });

        $this->createIfMissing('ai_usage_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('module', 100)->index();
            $table->string('use_case', 150)->nullable();
            $table->longText('prompt')->nullable();
            $table->longText('response_summary')->nullable();
            $table->decimal('credit_used', 15, 4)->default(0);
            $table->json('request_payload')->nullable();
            $table->json('response_payload')->nullable();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Approval Workflow
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('approval_workflows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->string('module', 100)->index(); // leave, ot, expense, payroll, asset, appraisal, hiring
            $table->string('name');
            $table->json('conditions')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $this->createIfMissing('approval_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_workflow_id')->constrained('approval_workflows')->cascadeOnDelete();
            $table->unsignedSmallInteger('level')->default(1);
            $table->string('approver_type', 50); // manager, hr, finance, role, user, management
            $table->foreignId('approver_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approver_role_id')->nullable()->constrained('roles')->nullOnDelete();
            $table->boolean('is_required')->default(true);
            $table->json('rules')->nullable();
            $table->timestamps();
            $table->unique(['approval_workflow_id', 'level', 'approver_type'], 'approval_steps_unique');
        });

        $this->createIfMissing('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_workflow_id')->nullable()->constrained('approval_workflows')->nullOnDelete();
            $table->foreignId('requested_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('module', 100)->index();
            $table->string('approvable_type');
            $table->unsignedBigInteger('approvable_id');
            $table->unsignedSmallInteger('current_level')->default(1);
            $table->string('status', 50)->default('pending')->index();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('snapshot')->nullable();
            $table->timestamps();
            $table->index(['approvable_type', 'approvable_id']);
        });

        $this->createIfMissing('approval_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_request_id')->constrained('approval_requests')->cascadeOnDelete();
            $table->foreignId('approver_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedSmallInteger('level')->default(1);
            $table->string('action', 50)->index(); // approved, rejected, returned, delegated
            $table->text('comment')->nullable();
            $table->timestamp('acted_at')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('approval_delegations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegator_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('delegate_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('module', 100)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | Report / Export
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('report_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('requested_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('report_type', 150)->index();
            $table->string('format', 20)->default('pdf'); // pdf, xlsx, csv, docx, print
            $table->json('filters')->nullable();
            $table->string('file_path')->nullable();
            $table->string('status', 50)->default('pending')->index();
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | System Settings / Backup / Audit
        |--------------------------------------------------------------------------
        */

        $this->createIfMissing('system_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->string('group', 100)->index(); // company, hr, attendance, leave, payroll, performance, recruitment, ai, backup
            $table->string('key');
            $table->longText('value')->nullable();
            $table->string('value_type', 50)->default('string');
            $table->boolean('is_encrypted')->default(false);
            $table->timestamps();
            $table->unique(['company_id', 'group', 'key']);
        });

        $this->createIfMissing('backup_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('backup_type', 50)->default('database'); // database, files, full
            $table->string('storage_disk')->nullable();
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('status', 50)->default('pending')->index();
            $table->longText('error_message')->nullable();
            $table->timestamps();
        });

        $this->createIfMissing('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained('companies')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('module', 100)->index();
            $table->string('action', 100)->index();
            $table->string('auditable_type')->nullable();
            $table->unsignedBigInteger('auditable_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 100)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('action_at')->nullable();
            $table->timestamps();
            $table->index(['auditable_type', 'auditable_id']);
            $table->index(['user_id', 'action_at']);
        });

        /*
        |--------------------------------------------------------------------------
        | Add deferred optional foreign keys
        |--------------------------------------------------------------------------
        */

        if (Schema::hasTable('departments') && Schema::hasTable('employees')) {
            Schema::table('departments', function (Blueprint $table) {
                if (! $this->hasForeignKey('departments', 'departments_manager_employee_id_foreign')) {
                    $table->foreign('manager_employee_id')->references('id')->on('employees')->nullOnDelete();
                }
            });
        }

        if (Schema::hasTable('users') && Schema::hasTable('employees')) {
            Schema::table('users', function (Blueprint $table) {
                if (! $this->hasForeignKey('users', 'users_employee_id_foreign')) {
                    $table->foreign('employee_id')->references('id')->on('employees')->nullOnDelete();
                }
            });
        }

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        foreach (array_reverse($this->tables()) as $table) {
            Schema::dropIfExists($table);
        }

        Schema::enableForeignKeyConstraints();
    }

    private function createIfMissing(string $table, Closure $callback): void
    {
        if (! Schema::hasTable($table)) {
            Schema::create($table, $callback);
        }
    }

    private function hasForeignKey(string $table, string $foreignKeyName): bool
    {
        $connection = Schema::getConnection();
        $databaseName = $connection->getDatabaseName();

        $result = $connection->selectOne(
            'SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
             WHERE CONSTRAINT_SCHEMA = ? AND TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND CONSTRAINT_TYPE = ?',
            [$databaseName, $table, $foreignKeyName, 'FOREIGN KEY']
        );

        return $result !== null;
    }

    private function tables(): array
    {
        return [
            'countries',
            'currencies',
            'companies',
            'branches',
            'departments',
            'positions',
            'roles',
            'permissions',
            'role_permission',
            'users',
            'user_roles',
            'login_histories',
            'employment_types',
            'contract_types',
            'employees',
            'employee_bank_accounts',
            'employee_emergency_contacts',
            'document_types',
            'employee_documents',
            'employee_contracts',
            'employee_salary_histories',
            'employee_status_histories',
            'projects',
            'project_assignments',
            'daily_activity_logs',
            'shifts',
            'employee_shifts',
            'public_holidays',
            'attendance_records',
            'leave_types',
            'leave_policies',
            'leave_balances',
            'leave_requests',
            'leave_request_dates',
            'project_payment_records',
            'overtime_rate_rules',
            'overtime_requests',
            'country_payroll_rules',
            'tax_rules',
            'social_contribution_rules',
            'salary_components',
            'employee_salary_components',
            'payroll_periods',
            'payroll_runs',
            'payroll_run_items',
            'payroll_item_components',
            'payslips',
            'salary_advances',
            'bank_export_batches',
            'inbox_messages',
            'inbox_recipients',
            'notification_templates',
            'notifications',
            'learning_categories',
            'learning_courses',
            'learning_materials',
            'learning_assignments',
            'quizzes',
            'quiz_questions',
            'quiz_attempts',
            'learning_certificates',
            'policy_acknowledgements',
            'asset_categories',
            'assets',
            'asset_assignments',
            'asset_maintenance_records',
            'appraisal_cycles',
            'competency_templates',
            'competency_template_items',
            'appraisal_records',
            'appraisal_scores',
            'kpi_templates',
            'kpis',
            'kpi_assignments',
            'kpi_reviews',
            'expense_categories',
            'expense_claims',
            'expense_items',
            'advance_requests',
            'job_vacancies',
            'candidates',
            'candidate_documents',
            'interview_schedules',
            'interview_feedback',
            'job_offers',
            'ai_credit_accounts',
            'ai_usage_logs',
            'approval_workflows',
            'approval_steps',
            'approval_requests',
            'approval_actions',
            'approval_delegations',
            'report_exports',
            'system_settings',
            'backup_logs',
            'audit_logs',
        ];
    }
};
