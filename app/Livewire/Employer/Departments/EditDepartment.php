<?php

namespace App\Livewire\Employer\Departments;

use Livewire\Component;
use App\Models\Department;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Title;

#[Title(' Edit Department')]

class EditDepartment extends Component
{
    public $department_id;
    public $name;

    // Load department data when component mounts
    public function mount($id)
    {
        $department = Department::findOrFail($id);
        $this->department_id = $department->id;
        $this->name = $department->name;
    }

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255|unique:departments,name',
    ];

    public function update()
    {
        $this->validate();

        $department = Department::findOrFail($this->department_id);
        $department->update([
            'name' => $this->name,
        ]);

        Toaster::success('Department updated successfully!');

        return redirect()->route('department.index');
    }

    public function render()
    {
        return view('livewire.employer.departments.edit-department');
    }
}
