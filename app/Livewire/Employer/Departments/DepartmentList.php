<?php

namespace App\Livewire\Employer\Departments;

use Livewire\Component;
use App\Models\Department;
use Masmerise\Toaster\Toaster;
use Livewire\WithPagination;
use Livewire\Attributes\Title;


#[Title('Department List')]
class DepartmentList extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage(); // reset pagination when typing new search
    }

    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        Toaster::success('Department deleted successfully.');
    }

    public function render()
    {
        $departments = Department::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.employer.departments.department-list', [
            'departments' => $departments,
            'totalDepartments' => $departments->total(),
        ]);
    }
}

//  $departments = Department::with('department')
//             ->where(function ($query) {
//                 $query->where('name', 'like', '%' . $this->search . '%');
//             })
//             ->orderBy('name')
//             ->paginate(20);