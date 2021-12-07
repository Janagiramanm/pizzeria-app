<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\RawMaterial;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id','raw_material_id','quantity' 
    ];

    public function recipe(){
        //return $this->belongsTo(Customer::class);
        return $this->belongsTo(Recipe::class);
    }

    public function rawMaterial(){
        return $this->belongsTo(RawMaterial::class);
    }
}
