<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id' , 'emp_code', 'designation', 'date_of_join', 'basic_pay',
        'hra','conveyance','gratuity_pay','special_allowance','variable_incentive'
    ];
}
