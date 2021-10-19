<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\City;
use App\Models\CustomerLocation;
use Livewire\Component;


class Customers extends Component
{
    public $customer, $confirmingItemDeletion, $customer_id, $error, $address_edit;
    public $updateMode,$createMode, $addMore = false;
    public $show = true;
   
    public $first_name,$last_name, $customer_type,
     $customer_email, $company_name, $phone, $website , $branch, $city, $address,  $latitude, $longitude ;
    
    public $locations = [];
    // public $address = [];
    protected $listeners = [
        'customerGetLatLngForInput'
   ];
  
    public $i=0;

    public function render()
    {
        $this->customers = Customer::all();
        $this->cities = City::all();
        return view('livewire.customer.list');
    }

    private function resetInput()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->company_name = null;
        $this->customer_email = null;
        $this->branch = null;
        $this->error = null;
        $this->locations = [];
        $this->render();
    }

    public function create(){
        $this->createMode = true;
        $this->addMore = true;
        $this->show = true;
        return view('livewire.customer.create');
    }

    public function store()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'customer_email' => 'required',
            'customer_type' => 'required',
            'company_name' => 'required_if:customer_type,==,BUSINESS',
            'branch.0' => 'required',
            'city.0' => 'required',
            // 'address.0' => 'required'

        ],
        // [
        //     'branch.*.required' => 'branch field is required',
        //     'city.*.required' => 'city field is required',
        //     'address.*.required' => 'address field is required.',
        // ]
    );

    

       $customer_id = Customer::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'company_name' => $this->company_name,
            'customer_type' => $this->customer_type,
            'customer_email' => $this->customer_email,
            'phone' => $this->phone,
            'website' => $this->website,
        ])->id;

        foreach ($this->branch as $key => $value) {
            CustomerLocation::create([
                   'customer_id' => $customer_id,
                   'branch' => $this->branch[$key], 
                   'city_id' => $this->city[$key],
                   'address' => $this->address[$key],
                   'latitude' => $this->latitude[$key],
                   'longitude' => $this->longitude[$key]
                ]);
        }

        $this->createMode = false;
        $this->resetInput();
        
    }

    public function edit($id)
    {
        $this->updateMode = true;
        // $this->addMore =false;
        $this->customer_id = $id;
        $customer = Customer::where('id',$this->customer_id)->first();
        $this->customer_type = $customer->customer_type;
        $this->first_name = $customer->first_name;
        $this->last_name = $customer->last_name;
        $this->customer_email = $customer->customer_email;
        $this->company_name = $customer->company_name;
        $this->phone = $customer->phone;
        $this->website = $customer->website;

        $locations = CustomerLocation::where('customer_id','=', $this->customer_id)->get();
        
        
        if($locations){
            foreach($locations as $key =>$value){
                //echo $value->address;
                $this->locations[] = $value->branch; 
                $this->branch[$key] = $value->branch;
                $this->city[$key] = $value->city_id;
                $this->address_edit[$key] = $value->address;
                // $this->latitude[$key] = $value->latitude;
            }
        }

        
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
            'customer_type' => 'required',
            'customer_email' => 'required|email',
            'company_name' => 'required_if:customer_type,==,BUSINESS'
        ]);

        if ($this->customer_id) {
            $customer = Customer::find($this->customer_id);
           
            $customer->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'company_name' => $this->company_name,
                'customer_type' => $this->customer_type,
                'customer_email' => $this->customer_email,
                'phone' => $this->phone,
                'website' => $this->website,
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



    public function add($i)
    {
        // $this->addMore = true;
        $i = $i + 1;
        $this->i = $i;
        
        array_push($this->locations ,$i);
    }

    public function remove($i)
    {
        $this->i = $this->i-1;
        unset($this->locations[$i]);
        // $this->address[$i] = null;
        // $this->latitude[$i] = null;
        // $this->longitude[$i] = null;
    }

    public function customerGetLatLngForInput($address, $lat, $lng, $row)
    {
        //   echo $address;exit;
            $this->address[$row] = $address;
            $this->latitude[$row] = $lat;
            $this->longitude[$row] = $lng;

            
    }
}
