<?php

namespace App\Livewire\Employer\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Title;

#[Title('Employee List')]
class EmployeeList extends Component
{

    public $search = '';

    //Enabling Search Feature
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    // Reset pagination when searching
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Delete function
    public function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        Toaster::success('Employee deleted from Payroll successfully');
    }

    public function render()
    {
        $employees = Employee::with('department')
            ->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('first_name')
            ->paginate(20);

        return view('livewire.employer.employee.employee-list', [
            'employees' => $employees,
            'totalEmployees' => $employees->total(), // pagination friendly count
        ]);
    }
}
