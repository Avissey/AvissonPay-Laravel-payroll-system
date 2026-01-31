<?php

namespace App\Livewire\Employer\Departments;

use Livewire\Component;
use App\Models\Department;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Title;

#[Title(' Add Department')]

class AddDepartment extends Component
{
    public $name;

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255|unique:departments,name',
    ];

    public function save()
    {
        $this->validate();

        Department::create([
            'name' => $this->name,
        ]);

        // Show success message
        Toaster::success('Department added successfully!');

        // Clear input
        $this->reset('name');

        // Redirect back to list
        return redirect()->route('department.index');
    }

    public function render()
    {
        return view('livewire.employer.departments.add-department');
    }
}

