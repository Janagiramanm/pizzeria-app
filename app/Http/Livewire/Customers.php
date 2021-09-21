<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class Customers extends Component
{
    public $customer, $confirmingItemDeletion;
    public $updateMode,$createMode = false;
    public $show = true;
    public $first_name,$last_name, $customer_type,
     $customer_email, $company_name, $phone, $website , $branch;

    public function render()
    {
        $this->customers = Customer::all();
        return view('livewire.customer.list');
    }

    private function resetInput()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->company_name = null;
        $this->customer_email = null;
        $this->branch = null;

        $this->render();
    }

    public function create(){
        $this->createMode = true;
        $this->show = true;
        return view('livewire.customer.create');
    }

    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'customer_email' => 'required',

        ]);
        Customer::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company_name' => $this->company_name,
            'customer_type' => $this->customer_type,
            'customer_email' => $this->customer_email,
            'phone' => $this->phone,
            'website' => $this->website,
        ]);
        $this->createMode = false;
        $this->resetInput();
        
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = Customer::where('id',$id)->first();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->customer_email = $user->customer_email;
        
    }


    public function destroy($id)
    {
        if ($id) {
            $record = Customer::where('id', $id);
            $record->delete();
        }
    }

    public function view(){
        $this->createMode = false;
        $this->updateMode = false;
        $this->resetInput();
    }

    public function update()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'customer_email' => 'required|email',
        ]);

        if ($this->id) {
            $customer = Customer::find($this->id);
           
            $customer->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'customer_type' => $this->customer_type,
                'customer_email' => $this->customer_email,
            ]);
            $this->updateMode = false;
            //session()->flash('message', 'Users Updated Successfully.');
            $this->resetInput();

        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInput();


    }
    
    public function confirmItemDeletion( $id) 
    {
        $this->confirmingItemDeletion = $id;
    }
 
    public function deleteItem( Customer $customer) 
    {
        $customer->delete();
        $this->confirmingItemDeletion = false;
        session()->flash('message', 'Item Deleted Successfully');
    }
}
