<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RawMaterial;
use App\Models\Recipe;

class Recipes extends Component
{

    public $updateMode,$createMode = false;
    public $name,$uom, $quantity, $ppl, $price, $item, $raw_material_id,  $confirmingItemDeletion;
    public $show = true;
    public $inputs = [];
    public $i=0;
    public function render()
    {
        $this->recipes = Recipe::all();
        return view('livewire.recipes.list');
    }

    private function resetInput()
    {
        $this->name = null;
        $this->uom = null;      
        $this->quantity = null;      
        $this->ppl = null;      
        $this->price = null;      
        $this->render();
    }

    public function create(){
        $this->createMode = true;
        $this->materials = RawMaterial::all();
        return view('livewire.recipes.create');
    }

    public function view(){
        $this->createMode = false;
        $this->updateMode = false;
        $this->resetInput();
    }

    public function add($i)
    {
        // $this->addMore = true;
        $i = $i + 1 ;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
      
    }
}
