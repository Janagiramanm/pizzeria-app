<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name' , 'last_name', 'customer_type', 'company_name','phone', 'customer_email', 'email', 'website'
    ];
}
