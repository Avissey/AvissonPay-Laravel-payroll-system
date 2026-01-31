<?php

namespace App\Livewire\Employer\Payroll;

use Livewire\Component;
use App\Models\Payroll;
use App\Models\Employee;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Title;


#[Title('Add Payroll')]
class Addpayroll extends Component
{
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
    public $increment_type = 'flat'; // 'flat' or 'percentage'

    // Deduction rates / fixed deductions
    public $ssnit_rate = 0;
    public $paye_rate = 0;
    public $loan = 0;
    public $welfare = 0;

    // Computed values for UI
    public $gross_salary = 0;
    public $net_salary = 0;

    public $pay_date;

    public $employees = []; 

    protected $rules = [
        'employee_id' => 'required|exists:employees,id',
        'bank_name' => 'nullable|string|max:255',
        'account_name'   => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:255',
        'momo_name'      => 'nullable|string|max:255',
        'momo_number' => 'nullable|string|max:255',
        'basic_salary' => 'required|numeric|min:0',
        'allowance' => 'nullable|numeric|min:0',
        'deduction' => 'nullable|numeric|min:0',
        'salary_increment' => 'nullable|numeric|min:0',
        'increment_type' => 'in:flat,percentage',
        'ssnit_rate' => 'nullable|numeric|min:0',
        'paye_rate' => 'nullable|numeric|min:0',
        'loan' => 'nullable|numeric|min:0',
        'welfare' => 'nullable|numeric|min:0',
        'pay_date' => 'required|date',
    ];

    public function mount()
    {
        $this->employees = Employee::orderBy('first_name')->get();
        $this->pay_date = now()->toDateString();

        // initialize computed values
        $this->computeSalaries();
    }

    public function updated($propertyName)
    {
        // Live validate while typing
        $this->validateOnly($propertyName);

        // Recompute when any input affecting calculation changes
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
                // Include the generic 'deduction' field into loan as an extra fixed deduction
                'loan'       => (float) $this->loan + (float) $this->deduction,
                'welfare'    => (float) $this->welfare,
            ]
        );

        $this->gross_salary = $result['gross_salary'];
        $this->net_salary = $result['net_salary'];
    }

    public function save()
    {
        $data = $this->validate();

        // Ensure additional fields are present in payload
        $data['increment_type'] = $this->increment_type;
        $data['gross_salary'] = $this->gross_salary;
        $data['ssnit_rate'] = $this->ssnit_rate;
        $data['paye_rate'] = $this->paye_rate;
        $data['loan'] = $this->loan;
        $data['welfare'] = $this->welfare;

        // net_salary will still be computed in the model's saving boot method, but we persist gross too
        Payroll::create($data);

        Toaster::success('Payroll record created Succesfully');

        // Reset form fields
        $this->reset();
        $this->pay_date = now()->toDateString();
        $this->computeSalaries();

        return $this->redirectRoute('payroll.index');
    }

    public function render()
    {
        return view('livewire.employer.payroll.addpayroll');
    }
}
