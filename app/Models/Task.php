<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = [
        'task_id',
        'title',
        'description',
        'employee_id',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
