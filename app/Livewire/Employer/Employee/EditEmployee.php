<?php

namespace App\Livewire\Employer\Employee;

use Livewire\Component;
use App\Models\Department;
use App\Models\Employee;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Title;

#[Title(' Edit Employee ')]

class EditEmployee extends Component
{
    public $employeeId;
    public $first_name; 
    public $last_name;
    public $age;
    public $email;
    public $phone;
    public $position;
    public $hire_date;
    public $department; 
    public $departments = [];

    
    public function mount($id)
    {
        $this->departments = Department::all();

        $employee = Employee::findOrFail($id);

        $this->employeeId = $employee->id;
        $this->first_name = $employee->first_name;
        $this->last_name = $employee->last_name;
        $this->age = $employee->age;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->position = $employee->position;
        $this->hire_date = $employee->hire_date;
        $this->department = $employee->department_id;
    }

    public function update()
    {
        $this->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'age' => 'required|integer|min:18',
            'email' => 'required|email|unique:employees,email,' . $this->employeeId,
            'phone' => 'required|string|max:10',
            'position' => 'required|string|max:20',
            'hire_date' => 'required|date',
            'department' => 'required|exists:departments,id',
        ]);

        $employee = Employee::findOrFail($this->employeeId);

        $employee->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->position,
            'hire_date' => $this->hire_date,
            'department_id' => $this->department,
        ]);

        Toaster::success('Employee Updated On The Payroll Succesfully');

        return redirect()->route('employee.index');
    }

    public function render()
    {
        return view('livewire.employer.employee.edit-employee');
    }
}
