<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UserRole;
use App\Models\Sale;
use App\Models\TrackLocations;
use Carbon\Carbon;
use DB;
use DateTime;

class Reports extends Component
{
    public $user_id, $from_date,$to_date, $month;
    public $result = [];
    public $show, $processing, $detailReport = false;
    public $status = ['logout','login','pause'];
    public $months = ['1'=>'January','2'=>'February','2'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December'];
    public $lastMonth=null;
    public function render()
    {
        $this->lastMonth = $this->month ? $this->month : Carbon::now()->subMonth()->month;

        $this->result =Sale::where('month', $this->lastMonth)->get();
        $this->month = $this->lastMonth;
        return view('livewire.reports.reports');
       
    }

    public function generateWorkReport(){
        $this->validate([
                'month' => 'required'
        ]);
       
    }

    // public function getAddress($lat,$lng){
    //     $url="https://maps.google.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&key=".env('GOOGLEMAPAPI');
    //     $curl_return=$this->curl_get($url);
    //     $obj=json_decode($curl_return);
    //     return $obj->results[0]->formatted_address;
    // }

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

    // public function viewReport($date){

    //       $this->show = false;
    //       $this->detailReport = true;
    //      //  echo $date;exit;  
    //     //   $result  = DB::select('SELECT * 
    //     //                         FROM track_locations 
    //     //                         INNER JOIN 
    //     //                         (SELECT MAX(id) as id,FLOOR(UNIX_TIMESTAMP(time)/(30 * 60)) AS timekey FROM track_locations where date BETWEEN "'.$this->from_date.'" and "'.$this->to_date.'" and user_id='.$this->user_id.'  GROUP BY timekey) last_updates 
    //     //                         ON last_updates.id = track_locations.id order by track_locations.id asc');

    //         $details =  TrackLocations::where('user_id','=',$this->user_id)->whereBetween('date',[$date, $date])
    //         ->get()->sortBy('id');
        
    //     $status = '';
    //         if($details){
    //             foreach($details as $key => $value){
                   
    //                 if($status != $value->status){
    //                         $url="https://maps.google.com/maps/api/geocode/json?latlng=".$value->latitude.",".$value->longitude."&key=".env('GOOGLEMAPAPI');
    //                         $curl_return=$this->curl_get($url);
    //                         $obj=json_decode($curl_return);
    //                         $result[$key]['date'] = $value->date;
    //                         $result[$key]['time'] = $value->time;
    //                         $result[$key]['address'] = $obj->results[0]->formatted_address;
    //                         $result[$key]['status'] = ucfirst($this->status[$value->status]);
    //                 }
    //                 $status = $value->status;
    //             }
    //         }
    //         $this->result = $result;
    // }

    public function backToReports(){

       
        return $this->redirect('/reports');
    }

    public function goback(){
        $this->show = true;
        $this->detailReport = false;
        $this->generateWorkReport();
    }

}
