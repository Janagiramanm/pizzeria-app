<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;


class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'month','recipe_id','quantity' 
    ];

    public function recipes(){
        return $this->belongsTo(Recipe::class,'recipe_id','id');
    }
}
