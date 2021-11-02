<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UserRole;
use App\Models\TrackLocations;
use Carbon\Carbon;
use DB;
use DateTime;

class Reports extends Component
{
    public $user_id, $from_date,$to_date;
    public $result = [];
    public $show, $processing = false;
    public function render()
    {

        $this->users = UserRole::where('role_id','=',3)->get();
        return view('livewire.reports.reports');
    }

    public function generateWorkReport(){
        $this->validate([
            'user_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);

        $this->show =true;

        //$result = TrackLocations::where('user_id','=',$this->user_id)->whereBetween('date',[$this->from_date, $this->to_date]);

        // $result = TrackLocations::groupBy('date')
        // ->selectRaw('*')
        // ->where('user_id','=',$this->user_id)->whereBetween('date',[$this->from_date, $this->to_date])
        // ->get();
        // echo "<pre>";
        // // print_r($result);
        // if($result){
        //     foreach($result as $key => $value){
        //         $res[] = [
        //              'date' => $value->date,
        //              'id' => $value->id
        //         ] ;
        //     }
        // }
        // print_r($res);
        // exit;



        // $result  = DB::select('SELECT * 
        // FROM track_locations 
        // INNER JOIN 
        // (SELECT MAX(id) as id,FLOOR(UNIX_TIMESTAMP(time)/(30 * 60)) AS timekey FROM track_locations where date BETWEEN "'.$this->from_date.'" and "'.$this->to_date.'" and user_id='.$this->user_id.'  GROUP BY timekey) last_updates 
        // ON last_updates.id = track_locations.id order by track_locations.id asc');
        $result  = DB::select('SELECT * 
        FROM track_locations 
        INNER JOIN 
        (SELECT MAX(id) as id,date FROM track_locations where date BETWEEN "'.$this->from_date.'" and "'.$this->to_date.'" and user_id='.$this->user_id.'  GROUP BY date) last_updates 
        ON last_updates.id = track_locations.id order by track_locations.id asc');

        $this->result = null;

      
        //exit;
       
        if($result){
            foreach($result as $key => $value){
                $url="https://maps.google.com/maps/api/geocode/json?latlng=".$value->latitude.",".$value->longitude."&key=".env('GOOGLEMAPAPI');
                $curl_return=$this->curl_get($url);
                $obj=json_decode($curl_return);

                if($value->status == 1){
                    $status = "Start";
                }
                if($value->status == 2){
                    $status = "Pause";
                }
                if($value->status == 3){
                    $status = "Logout";
                }
// echo $obj->results[0]->formatted_address;

                $this->result[$key] = [
                       'date' => $value->date,
                       'latitude' => $value->latitude,
                       'longitude' => $value->longitude,
                       'time' => $value->time,
                       'address' =>  $obj->results[0]->formatted_address,
                       'status'=> $value->status
                ];
            }
        }
      // $this->result = $result;

       // print_r($this->result);exit;
      

    }

    public function curl_get($url,  array $options = array())
    {
            $defaults = array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 4
            );

            $ch = curl_init();
            curl_setopt_array($ch, ($options + $defaults));
            if( ! $result = curl_exec($ch))
            {
                trigger_error(curl_error($ch));
            }
            curl_close($ch);
            return $result;
    }


}
