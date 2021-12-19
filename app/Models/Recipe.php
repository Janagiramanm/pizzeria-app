<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;
use App\Models\Sale;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name' 
    ];

    public function recipeIngredients(){
        return $this->hasMany(Ingredient::class);
    }


    public function sales(){
        return $this->hasMany(Sale::class);
    }


}
