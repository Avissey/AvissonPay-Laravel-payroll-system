<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [

        'employee_id',
        'bank_name',
        'account_name',
        'account_number',
        'momo_name',
        'momo_number',
        'basic_salary',
        'allowance',
        'deduction',
        'salary_increment',
        'increment_type',
        'gross_salary',
        'ssnit_rate',
        'paye_rate',
        'loan',
        'welfare',
        'net_salary',
        'pay_date',

    ];



     protected $casts = [
        'pay_date' => 'date',
    ];

    /**
     * Relationship: Each payroll belongs to one employee.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Automatically calculate net salary before saving.
     */
    protected static function booted()
    {
        static::saving(function ($payroll) {
            // Use the calculation helper to determine gross and net prior to saving
            $result = self::calculateSalary(
                (float) $payroll->basic_salary,
                $payroll->increment_type ?? 'flat',
                (float) ($payroll->salary_increment ?? 0),
                $payroll->allowance ?? 0,
                [
                    'ssnit_rate' => (float) ($payroll->ssnit_rate ?? 0),
                    'paye_rate'  => (float) ($payroll->paye_rate ?? 0),
                    'loan'       => (float) ($payroll->loan ?? 0),
                    'welfare'    => (float) ($payroll->welfare ?? 0),
                ]
            );

            $payroll->gross_salary = $result['gross_salary'];
            $payroll->net_salary = $result['net_salary'];
        });
    }

    /**
     * Calculate gross and net salary using flexible allowances and deductions rules.
     * - $allowances may be a single numeric value (fixed) or an array of arrays [ ['type'=>'percentage'|'fixed','value'=>x], ... ]
     * - $deductions is an associative array with keys: ssnit_rate, paye_rate, loan, welfare
     */
    public static function calculateSalary(
        float $basicSalary,
        string $incrementType,
        float $incrementValue,
        $allowances = 0,
        array $deductions = []
    ) : array {
        // Increment
        $incrementAmount = ($incrementType === 'percentage')
            ? ($incrementValue / 100) * $basicSalary
            : $incrementValue;

        $newBasicSalary = $basicSalary + $incrementAmount;

        // Allowances
        $totalAllowances = 0;

        if (is_array($allowances)) {
            foreach ($allowances as $allowance) {
                $totalAllowances += ($allowance['type'] === 'percentage')
                    ? ($allowance['value'] / 100) * $newBasicSalary
                    : $allowance['value'];
            }
        } else {
            // single numeric allowance treated as fixed value
            $totalAllowances = (float) $allowances;
        }

        // Gross Salary
        $grossSalary = $newBasicSalary + $totalAllowances;

        // Deductions (use defaults if missing)
        $ssnit = ((float) ($deductions['ssnit_rate'] ?? 0) / 100) * $newBasicSalary;
        $paye  = ((float) ($deductions['paye_rate'] ?? 0) / 100) * $newBasicSalary;

        $fixedDeductions = (float) ($deductions['loan'] ?? 0) + (float) ($deductions['welfare'] ?? 0);

        $totalDeductions = $ssnit + $paye + $fixedDeductions;

        // Net Salary
        $netSalary = $grossSalary - $totalDeductions;

        return [
            'gross_salary' => round($grossSalary, 2),
            'net_salary'   => round($netSalary, 2),
            'increment_amount' => round($incrementAmount, 2),
            'total_allowances' => round($totalAllowances, 2),
            'total_deductions' => round($totalDeductions, 2),
        ];
    }
}
