<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Recipe;

class Sales extends Component
{
    public $updateMode,$createMode, $editIngredientMode, $addnewIngredients, $addMore = false;
    public $recipes, $quantity, $item, $month, $recipe_id, $confirmingItemDeletion;
    public $show = true;
    public $inputs = [];
    public $i=0;
    public $months = ['1'=>'January','2'=>'February','2'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December'];
    public $searchTerm = null;
    public $search= null;
    public function render()
    {
        $query = '%'.$this->searchTerm.'%'; 
        return view('livewire.sales.list', [
            'sales' => Sale::when($this->searchTerm, function ($query){
                $query->where('month', $this->searchTerm);
            })->paginate(10)
        ]);

       
    }

    private function resetInput()
    {
        // $this->name = null;
        // $this->uom = null;      
        // $this->quantity = null;      
        // $this->ppl = null;      
        $this->inputs = [];      
        $this->render();
    }

    public function create(){
        $this->createMode = true;
        $this->recipes = Recipe::all();
       // $this->months = ['January','0'=>'February','0'=>'March','0'=>'April','0'=>'May','0'=>'June','0'=>'July','0'=>'August','0'=>'September','0'=>'October','0'=>'November','0'=>'December'];
        return view('livewire.sales.create');
    }

    public function add($i)
    {
        $i = $i + 1 ;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
      
    }

    public function view(){
        $this->createMode = false;
        $this->updateMode = false;
        $this->resetInput();
    }

    public function store(){
        $this->validate([
            'month' => 'required',
            'item.0' => 'required',
            'quantity.0' => 'required',
            
        ],
        [
                'item.*.required' => 'Item field is required',
                'quantity.*.required' => 'Quantity field is required',
                
        ]
    );

        foreach ($this->item as $key => $value) {
            
            Sale::create([
                   'month' => $this->month,
                   'recipe_id' => $this->item[$key],
                   'quantity' => $this->quantity[$key],
                ]);
        }
        $this->createMode = false;
        $this->resetInput();

    }

    public function edit($id){
        $this->updateMode = true;
        $this->recipes = Recipe::all();
        $this->sales_id = $id;
        $sale = Sale::find($this->sales_id);
        $this->month = $sale->month;
        $this->quantity = $sale->quantity;
        $this->item = $sale->recipe_id;
        //$this->months = ['January','0'=>'February','0'=>'March','0'=>'April','0'=>'May','0'=>'June','0'=>'July','0'=>'August','0'=>'September','0'=>'October','0'=>'November','0'=>'December'];
    }

    public function update()
    {
        $this->validate([
            'month' => 'required',
            'item' => 'required',
            'quantity' => 'required',
        ]);

        if ($this->sales_id) {
                $sales = Sale::find($this->sales_id);
              
                $sales->update([
                    'month' => $this->month,
                    'recipe_id' => $this->item,
                    'quantity' => $this->quantity,
                ]);
                $this->updateMode = false;
                $this->resetInput();
    
        }
    }

    public function deleteSale(Sale $sale) 
    {
        $sale->delete();
        $this->confirmingDeletion = false;
        $this->view();
        session()->flash('message', 'Item Deleted Successfully');
    }
    public function confirmItemDeletion($id) 
    {
        $this->confirmingItemDeletion = $id;
    }
}
