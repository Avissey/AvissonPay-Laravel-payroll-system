<?php

namespace App\Livewire\Employer\Payroll;

use Livewire\Component;
use App\Models\Payroll;
use App\Models\Employee;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Title;


#[Title('Edit Payroll')]
class EditPayroll extends Component
{
    // Payroll record ID
    public $payrollId;

    // Form fields
    public $employee_id;
    public $bank_name;
    public $account_name;
    public $account_number;
    public $momo_name;
    public $momo_number;
    public $basic_salary = 0;
    public $allowance = 0;
    public $deduction = 0;
    public $salary_increment = 0;
    public $increment_type = 'flat';

    public $ssnit_rate = 0;
    public $paye_rate = 0;
    public $loan = 0;
    public $welfare = 0;

    public $gross_salary = 0;
    public $net_salary = 0;

    public $pay_date;

    protected $rules = [
        'employee_id'    => 'required|exists:employees,id',
        'bank_name'      => 'nullable|string|max:255',
        'account_name'   => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:255',
        'momo_name'      => 'nullable|string|max:255',
        'momo_number'    => 'nullable|string|max:255',
        'basic_salary'   => 'required|numeric|min:0',
        'allowance'      => 'nullable|numeric|min:0',
        'deduction'      => 'nullable|numeric|min:0',
        'salary_increment' => 'nullable|numeric|min:0',
        'increment_type' => 'in:flat,percentage',
        'ssnit_rate' => 'nullable|numeric|min:0',
        'paye_rate' => 'nullable|numeric|min:0',
        'loan' => 'nullable|numeric|min:0',
        'welfare' => 'nullable|numeric|min:0',
        'pay_date'       => 'required|date',
    ];

    public function mount($id)
    {
        // store payroll id for update
        $this->payrollId = $id;

        try {
            $payroll = Payroll::findOrFail($id);

            $this->employee_id    = $payroll->employee_id;
            $this->bank_name      = $payroll->bank_name;
            $this->account_name   = $payroll->account_name;
            $this->account_number = $payroll->account_number;
            $this->momo_name = $payroll->momo_name;
            $this->momo_number    = $payroll->momo_number;
            $this->basic_salary   = $payroll->basic_salary;
            $this->allowance      = $payroll->allowance;
            $this->deduction      = $payroll->deduction;
            $this->salary_increment = $payroll->salary_increment ?? 0;
            $this->increment_type = $payroll->increment_type ?? 'flat';
            $this->ssnit_rate = $payroll->ssnit_rate ?? 0;
            $this->paye_rate = $payroll->paye_rate ?? 0;
            $this->loan = $payroll->loan ?? 0;
            $this->welfare = $payroll->welfare ?? 0;
            $this->gross_salary = $payroll->gross_salary ?? 0;
            $this->net_salary = $payroll->net_salary ?? 0;
            $this->pay_date       = $payroll->pay_date ? $payroll->pay_date->toDateString() : null;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Redirect back to payroll list with a toaster message if the record doesn't exist
            Toaster::error('Payroll record not found.');
            redirect()->route('payroll.index')->send();
        }
    }

    public function updated($propertyName)
    {
        // Live validate while typing
        $this->validateOnly($propertyName);

        $calcFields = [
            'basic_salary', 'salary_increment', 'increment_type', 'allowance', 'ssnit_rate', 'paye_rate', 'loan', 'welfare'
        ];

        if (in_array($propertyName, $calcFields)) {
            $this->computeSalaries();
        }
    }

    protected function computeSalaries()
    {
        $result = Payroll::calculateSalary(
            (float) $this->basic_salary,
            $this->increment_type ?? 'flat',
            (float) $this->salary_increment,
            $this->allowance ?? 0,
            [
                'ssnit_rate' => (float) $this->ssnit_rate,
                'paye_rate'  => (float) $this->paye_rate,
                'loan'       => (float) $this->loan,
                'welfare'    => (float) $this->welfare,
            ]
        );

        $this->gross_salary = $result['gross_salary'];
        $this->net_salary = $result['net_salary'];
    }

    public function update()
    {
        $this->validate();

        //  use stored payrollId instead of $id
        $payroll = Payroll::findOrFail($this->payrollId);

        $payroll->update([
            'employee_id'    => $this->employee_id,
            'bank_name'      => $this->bank_name,
            'account_name'   => $this->account_name,
            'account_number' => $this->account_number,
            'momo_name'      => $this->momo_name,
            'momo_number'    => $this->momo_number,
            'basic_salary'   => $this->basic_salary,
            'allowance'      => $this->allowance,
            'deduction'      => $this->deduction,
            'salary_increment' => $this->salary_increment,
            'increment_type' => $this->increment_type,
            'ssnit_rate' => $this->ssnit_rate,
            'paye_rate' => $this->paye_rate,
            'loan' => $this->loan,
            'welfare' => $this->welfare,
            'gross_salary' => $this->gross_salary,
            'pay_date'       => $this->pay_date,
        ]);

        Toaster::success('Payroll of employee updated successfully.');

        return redirect()->route('payroll.index');
    }

    public function render()
    {
        // Pass employees list to the Blade for the <select>
        $employees = Employee::orderBy('first_name')->get();

        return view('livewire.employer.payroll.edit-payroll', compact('employees'));
    }
}


