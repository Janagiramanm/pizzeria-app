<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AssignJobEmployee extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id' , 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}