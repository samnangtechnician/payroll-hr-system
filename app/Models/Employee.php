<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id', 'user_id', 'country_id', 'branch_id', 'department_id',
        'position_id', 'employment_type_id', 'contract_type_id', 'manager_employee_id',
        'employee_code', 'first_name', 'last_name', 'khmer_name',
        'gender', 'date_of_birth', 'phone', 'secondary_phone', 'email',
        'current_address', 'permanent_address',
        'national_id_no', 'passport_no', 'passport_expiry_date',
        'work_permit_no', 'work_permit_expiry_date',
        'join_date', 'probation_end_date', 'contract_start_date',
        'contract_end_date', 'resignation_date', 'termination_date',
        'basic_salary', 'salary_currency_id', 'salary_payment_method',
        'status', 'profile_photo_path', 'extra',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'passport_expiry_date' => 'date',
        'work_permit_expiry_date' => 'date',
        'join_date' => 'date',
        'probation_end_date' => 'date',
        'contract_start_date' => 'date',
        'contract_end_date' => 'date',
        'resignation_date' => 'date',
        'termination_date' => 'date',
        'basic_salary' => 'decimal:2',
        'extra' => 'array',
    ];

    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '').' '.($this->last_name ?? ''));
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function employmentType(): BelongsTo
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function contractType(): BelongsTo
    {
        return $this->belongsTo(ContractType::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'manager_employee_id');
    }

    public function salaryCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'salary_currency_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(EmployeeBankAccount::class);
    }

    public function emergencyContacts(): HasMany
    {
        return $this->hasMany(EmployeeEmergencyContact::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(EmployeeContract::class);
    }

    public function leaveRequests(): HasMany
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}
