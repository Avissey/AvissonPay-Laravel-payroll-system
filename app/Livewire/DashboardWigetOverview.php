<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Payroll;
use App\Models\Attendance;

class DashboardWigetOverview extends Component
{

    public $totalEmployees;
    public $totalDepartments;
    public $totalPayrolls;
    public $attendanceRate;

      public function mount()
    {
        // Fetch totals dynamically
        $this->totalEmployees  = Employee::count();
        $this->totalDepartments = Department::count();
        $this->totalPayrolls    = Payroll::count();

        // Example attendance calculation (adjust if you have a different structure)
        $totalAttendance = Attendance::count();
        $presentDays = Attendance::where('status', 'present')->count();
        $this->attendanceRate = $totalAttendance > 0
            ? round(($presentDays / $totalAttendance) * 100, 1)
            : 0;
    }

    public function render()
    {
        return view('livewire.dashboard-wiget-overview');
    }
}
