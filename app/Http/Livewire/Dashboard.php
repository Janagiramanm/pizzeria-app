<?php

namespace App\Http\Livewire;

use App\Models\TrackLocations;
use Livewire\Component;


class Dashboard extends Component
{
    public $locations;
    public $latLong = [];
      
   
    public function render()
    {
        $this->locations = TrackLocations::get();
        //echo '<pre>';
       // print_r($this->locations);
      $res = [];
        if($this->locations){
            foreach($this->locations as $key => $value){
                $res[] = [$value->user->name, $value->latitude, $value->longitude, $key];
            }
            $this->latLong = $res;

            //print_r($this->latLong);exit;
        }

        return view('livewire.dashboard.dashboard');
    }
}
