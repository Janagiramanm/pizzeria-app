<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RawMaterial;
use App\Models\Recipe;
use App\Models\Ingredient;

class Recipes extends Component
{

    public $updateMode,$createMode, $editIngredientMode, $addnewIngredients = false;
    public $name,$uom, $quantity, $ppl, $price, $item, $raw_material_id,  $confirmingItemDeletion, $confirmingRecipeDeletion;
    public $show = true;
    public $inputs = [];
    public $i=0;
    public function render()
    {
      // 
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
        $this->item = null;      
        $this->inputs = [];      
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
        $this->addnewIngredients = false;
        $this->editIngredientMode = false;
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

    public function store(){
        $this->validate([
            'name' => 'required',
            'item.0' => 'required',
            'quantity.0' => 'required',
            'item.*' => 'required',
            'quantity.*' => 'required',
            
        ]);

        $recipe_id = Recipe::create([
            'product_name' => $this->name
        ])->id;

        foreach ($this->item as $key => $value) {
            
            Ingredient::create([
                   'recipe_id' => $recipe_id,
                   'raw_material_id' => $this->item[$key],
                   'quantity' => $this->quantity[$key],
                ]);
        }
        $this->createMode = false;
        $this->resetInput();

    }

    public function confirmItemDeletion( $id) 
    {
        $this->confirmingItemDeletion = $id;
    }

    public function confirmingRecipeDeletion($id) 
    {
        $this->confirmingRecipeDeletion = $id;
       
    }
    public function deleteItem(Recipe $recipe) 
    {

        $recipe->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item Deleted Successfully');
       
    }

    public function deleteIngredient(Ingredient $ingredient){

        $ingredient->delete();
        $this->confirmingIngredientDeletion = false;
        session()->flash('message', 'Item Deleted Successfully');
        $this->edit($this->recipe_id);
    }

    public function deleteRecipe(Recipe $recipe) 
    {

        $ingredients = Ingredient::where('recipe_id', $recipe->id);
        $ingredients->delete();
        $recipe->delete();
        $this->confirmingRecipeDeletion = false;
        $this->view();
        session()->flash('message', 'Item Deleted Successfully');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        // $this->addMore =false;
        $this->materials = RawMaterial::all();
        $this->recipe_id = $id;
        $recipe = Recipe::where('id',$this->recipe_id)->first();
        $this->name = $recipe->product_name;
        $this->inputs = Ingredient::where('recipe_id','=', $this->recipe_id)->get();
        //$this->resetValidation();    
    }

    public function editIngredient($id){

        $this->ingredient_id = $id;
        $this->materials = RawMaterial::all();
        $ingredient = Ingredient::find($id);
        $this->item = $ingredient->raw_material_id;
        $this->quantity = $ingredient->quantity;
        $this->editIngredientMode = true;
        $this->updateMode = false;

    }

    public function updateIngredient(){

        $ingredient = Ingredient::find($this->ingredient_id);
        $ingredient->raw_material_id = $this->item;
        $ingredient->quantity = $this->quantity;
        $ingredient->save();
        $this->editIngredientMode = false;
        $this->updateMode = true;
        $this->edit($this->recipe_id);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required'            
        ]);

        if ($this->recipe_id) {
            $recipe = Recipe::find($this->recipe_id);
          
            $recipe->update([
                'product_name' => $this->name,
            ]);
            $this->updateMode = false;
            $this->resetInput();

        }
    }

    public function addNewIngredients($id){

        $this->addnewIngredients = true;
        $this->updateMode = false;
        $this->inputs = [];
    }
   
    public function goBack(){
        $this->updateMode = true;
        $this->addnewIngredients = false;
        $this->inputs = Ingredient::where('recipe_id','=', $this->recipe_id)->get();
    }
    public function saveNewIngredient(){

        $this->validate([
            'item.0' => 'required',
            'quantity.0' => 'required',
            'item.*' => 'required',
            'quantity.*' => 'required',
        ]);


        foreach ($this->item as $key => $value) {
            Ingredient::create([
                   'recipe_id' => $this->recipe_id,
                   'raw_material_id' => $this->item[$key],
                   'quantity' => $this->quantity[$key],
                ]);
        }
        $this->updateMode = true;
        $this->addnewIngredients = false;
        $this->inputs = Ingredient::where('recipe_id','=', $this->recipe_id)->get();
    }
    
   
}
