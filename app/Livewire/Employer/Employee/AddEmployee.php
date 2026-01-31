<?php

namespace App\Livewire\Employer\Employee;

use App\Models\Department;
use Livewire\Component;
use Livewire\Attributes\Title; 
use App\Models\Employee;
use Masmerise\Toaster\Toaster;

#[Title(' Add Employee ')]

class AddEmployee extends Component
{

    public $first_name = '';
    public $last_name = '';
    public $age = '';
    public $email = '';  
    public $phone = '';
    public $position = '';
    public $hire_date = '';
    public $department = '';
    public $departments = [];


    public function mount()
    {
        $this->departments = Department::all();
    }

    public function save()
    {
        $this->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'age' => 'required|integer|min:18',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:10',
            'position' => 'required|string|max:100',
            'hire_date' => 'required|date',
            'department' => 'required|exists:departments,id',
        ]);


          Employee::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->position,
            'hire_date' => $this->hire_date,
            'department_id' => $this->department,
        ]);


        $this->reset();

        Toaster::success('Employee Added To The Payroll Succesfully');

        return $this->redirectRoute('employee.index');
    }

  
    public function render()
    {
        return view('livewire.employer.employee.add-employee');
    }
}
