<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use HasRoles;
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'employee_name',
        'employee_status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
