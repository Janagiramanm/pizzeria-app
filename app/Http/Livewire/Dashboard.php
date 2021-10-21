<?php

namespace App\Http\Livewire;

use App\Models\TrackLocations;
use Livewire\Component;
use Carbon\Carbon;
use DB;


class Dashboard extends Component
{
    public $locations,$lat,$lng;
    public $latLong = [];
      
   
    public function render()
    {
        

        $this->locations  = TrackLocations::whereIn('time', function($query) {
                                    $query->selectRaw('max(`time`)')
                                    ->from('track_locations')
                                    ->where('date', '=', date('Y-m-d'))
                                    ->groupBy('user_id');
                                })->select('user_id', 'date', 'time', 'latitude', 'longitude')
                                ->where('date', '=', date('Y-m-d'))
                                ->orderBy('created_at', 'desc')
                                ->get();
       
       
        $res = [];
        if($this->locations){
            foreach($this->locations as $key => $value){
                
                $details = '<b>'.$value->user->name.'</b><br> Date : '.date('d-m-Y',strtotime($value->date)) 
                          .'<br> Time : '. $value->time;
                    
                $res[] = [$details, $value->latitude, $value->longitude, $key];
                $this->lat =  $value->latitude;
                $this->lng = $value->longitude;
                
            }
            $this->latLong = json_encode($res, JSON_NUMERIC_CHECK);
              
        }

        // print_r($this->latLong);

        return view('livewire.dashboard.dashboard');
    }
}
