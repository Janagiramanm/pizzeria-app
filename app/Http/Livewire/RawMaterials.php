<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RawMaterial;

class RawMaterials extends Component
{

    public $updateMode,$createMode = false;
    public $name,$uom, $quantity, $ppl, $price, $raw_material_id, $confirmingItemDeletion;
    public $show = true;

    public function render()
    {
        $this->materials = RawMaterial::all();
        return view('livewire.rawmaterials.list');
    }

    public function create(){
        $this->createMode = true;
        return view('livewire.rawmaterials.create');
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            
        ]);
        RawMaterial::create([
            'name' => $this->name,
            'uom' => $this->uom,          
            'quantity' => $this->quantity,          
            'ppl' => $this->ppl,
            'price' => $this->price          
        ]);
        $this->createMode = false;
        $this->resetInput();

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

    public function view(){
        $this->createMode = false;
        $this->updateMode = false;
        $this->resetInput();
    }

    public function edit($id){
        $this->updateMode = true;
        $this->raw_material_id = $id;
        $material = RawMaterial::where('id', $id)->first();
        $this->name = $material->name;
        $this->uom = $material->uom;
        $this->quantity = $material->quantity;
        $this->ppl = $material->ppl;
        $this->price = $material->price;
    }

    public function update(){

        $this->error = true;

        $this->validate([
            'name' => 'required'
        ]);

        if ($this->raw_material_id) {
            $material = RawMaterial::find($this->raw_material_id);
           
            $material->update([
                'name' => $this->name,
                'uom' => $this->uom,
                'quantity' => $this->quantity,
                'ppl' => $this->ppl,
                'price' => $this->price,
                
            ]);

            $this->updateMode = false;
            //session()->flash('message', 'Users Updated Successfully.');
            $this->resetInput();

        }
        $this->createMode = false;
        $this->resetInput();
    }
}