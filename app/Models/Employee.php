<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'email',
        'phone',
        'position',
        'hire_date',
        'department_id',  
    ];

      protected $casts = [
        'hire_date' => 'date',
    ];

    
    // Each employee belongs to a department.
    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // An employee can have many attendance records.
    public function attendances() : HasMany
    {
        return $this->hasMany(Attendance::class);
    }   

    // Get the full name of the employee.
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

}

