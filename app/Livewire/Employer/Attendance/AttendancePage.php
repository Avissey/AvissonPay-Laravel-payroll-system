<?php

namespace App\Livewire\Employer\Attendance;

use App\Models\Attendance;
use Livewire\Component;
use App\Models\Department;
use App\Models\Employee;
use Carbon\Carbon;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\Title;


#[Title('Attendance Page')]
class AttendancePage extends Component
{
    public $year, $month, $department ;
    public $employees = [];
    public $attendance = [];
    public $departments = []; 


    // Load all departments on mount
    public function mount()
    {
        $this->departments = Department::all();
    }

    public function fetchEmployees()
    {
        if ($this->year && $this->month && $this->department) {
            $this->employees = Employee::where('department_id', $this->department)->get();

            // //Generate days in the month
            foreach($this->employees as $employee){
                foreach (range(1, Carbon::create($this->year,$this->month)->daysInMonth) as $day){
                     $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
                     $this->attendance[$employee->id][$day] = Attendance::where('employee_id',$employee->id)->whereDate('date',$date)->value('status') ?? 'present';
                }
            }
        }
    }

    public function updateAttendance( $employeeId, $day, $status){
        $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');

        Attendance::updateOrCreate(
            [
                'employee_id' => $employeeId,
                'date' => $date,
            ],
            [
                'status' => $status,
                'department_id' => $this->department
            ]
        );

        // Update the local attendance array to reflect the change
        $this->attendance[$employeeId][$day] = $status;

        Toaster::success('Attendance updated successfully');
    }

    public function markALL( $day, $status){
        foreach($this->employees as $employee){
            $this->updateAttendance( $employee->id, $day, $status);
        }
    }

    public function render()
    {
        $this->fetchEmployees();
        return view('livewire.employer.attendance.attendance-page', [
            'departments' => $this->departments,
            'daysInMonth' => Carbon::create($this->year, $this->month)->daysInMonth,
        ]);
    }
}