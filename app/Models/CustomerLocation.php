<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\City;

class CustomerLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch' , 'city_id', 'address', 'customer_id'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
