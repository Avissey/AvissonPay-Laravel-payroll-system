<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    
    protected $fillable = [
        'employee_id',
        'department_id',
        'date',
        'status',
        'reason',
    ];


    protected $casts = [
        'date' => 'date',
    ];

    
     // Relationship: Each attendance record belongs to an employee.
     
    public function employee() : BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    
      // Relationship: Each attendance record belongs to a department.
    
    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

   
     // Accessor: Format the date nicely.
     
    public function getFormattedDateAttribute()
    {
        return $this->date ? $this->date->format('d M Y') : null;
    }

    
     // Accessor: Return a human-readable version of the status.
    
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status); // e.g. 'Present' instead of 'present'
    }
}
