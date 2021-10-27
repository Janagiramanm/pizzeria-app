<?php

namespace App\Http\Livewire;

use App\Models\TrackLocations;
use Livewire\Component;
use Carbon\Carbon;
use DB;


class Dashboard extends Component
{
    public $locations,$lat,$lng, $user_id, $job_date, $details, $date, $reslatLong, $wayPoints;
    public $latLong = [];
    public $detailMap = false;
      
    protected $listeners = [
        'getDetailPath'
   ];
   
    public function render()
    {
       $curdate = date('Y-m-d');
        //$curdate = '2021-10-26';
        $this->locations  = TrackLocations::whereIn('time', function($query) use ($curdate) {
                                    $query->selectRaw('max(`time`)')
                                    ->from('track_locations')
                                    ->where('date', '=', $curdate)
                                    ->groupBy('user_id');
                                })->select('user_id', 'date', 'time', 'latitude', 'longitude')
                                ->where('date', '=', $curdate)
                                ->orderBy('created_at', 'asc')
                                ->get();

        $res = [];
        if($this->locations){
            foreach($this->locations as $key => $value){
                

                 $details = '<b>'.$value->user->name.'</b><br> Date : '.date('d-m-Y',strtotime($value->date)) 
                          .'<br> Time : '. $value->time;
               
                    
                $res[] = [$details, $value->latitude, $value->longitude, $key, $value->user_id, $value->date];
                // $res[] = [$details, $value->latitude, $value->longitude, $key];
                $this->lat =  $value->latitude;
                $this->lng = $value->longitude;
                $this->user_id = $value->user_id;
                $this->job_date = $value->date;
                
            }
            
           
            $this->latLong = json_encode($res, JSON_NUMERIC_CHECK);
            //  echo '<pre>';
            // print_r($this->latLong);
            // exit;
              
        }

        return view('livewire.dashboard.dashboard');
    }

    public function getDetailPath($user_id, $date){
           $this->detailMap = true;
        //    $user_id = 2;
        //    $date = "2021-10-26";
        //    $start_time = "18:50";
        //    $end_time ="19:10";

        $this->locations = TrackLocations::where('date', '=', $date)
        ->where('user_id', '=', $user_id)
        //  ->whereBetween('time',[$start_time,$end_time])
        ->orderBy('created_at', 'asc')
        ->get();
            // $this->locations = TrackLocations::select('user_id', 'date', 'time' , 'latitude', 'longitude')
            // ->where('date', '=', $date)
            // ->where('user_id', '=', $user_id)
            // ->whereBetween('time',[$start_time,$end_time])
            // // ->groupBy('latitude','longitude','user_id', 'date')
            // ->orderBy('created_at', 'asc')
           
            // ->get();

            // echo '<pre>';
            // print_r($this->locations->count());
            // print_r($this->locations);
            // exit;
        $res = [];
        if($this->locations){
            foreach($this->locations as $key => $value){
                
                $details = '<b>'.$value->user->name.'</b><br> Date : '.date('d-m-Y',strtotime($value->date)) 
                          .'<br> Time : '. $value->time;
                    
                $reslatLong[] = ['lat'=>$value->latitude, 'lng'=>$value->longitude];
            // $reslatLong[] = ['lat'=>$value->latitude, 'lng'=>$value->longitude, 'detail'=>$details];
               //  $res[] = [$details, $value->latitude, $value->longitude, $key];
               // $wayPoints[] = $value->latitude.','.$value->longitude;
                $this->lat =  $value->latitude;
                $this->lng = $value->longitude;
                $this->user_id = $value->user_id;
                $this->job_date = $value->date;
                
            }
          //  $this->wayPoints = json_encode($wayPoints, JSON_NUMERIC_CHECK);
            $this->reslatLong = json_encode($reslatLong, JSON_NUMERIC_CHECK);
            //  echo '<pre>';
            //  print_r($reslatLong);
            //  exit; 
        }
        
    }

    public function back(){
        $this->detailMap = false;
        $this->render();
    }

   
}
