<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackLocations;
use DB;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function trackLocation(Request $request){
         
           $data = $request->data;
           if($data){
               foreach($data as $key => $value){

                    $track = new TrackLocations();
                    $track->user_id = $value['user_id'];
                    $track->date = $value['date'];
                    $track->time = $value['time'];
                    $track->latitude = $value['lat'];
                    $track->longitude = $value['lng'];
                    $track->status = $value['status'];
                    $track->save();
               }
               return [
                    'status' => 1,
                    'message' => 'Successfully Inserted.'
               ];
           }

           return [
             'status' => 0,
             'message' => 'Empty data is coming .'
            ];
           
    }

    public function userLocation(Request $request){

           $userLocations = TrackLocations::where('date','=','2021-10-25')->where('user_id','=',3)->get();
         
           return [
            'status' => 1,
            'data' => $userLocations
        ];
    }

    public function getUserPath(Request $request){

        $date = $request->date;
        $user_id = $request->user_id;
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        $result = TrackLocations::where('date', '=', $date)
        ->where('user_id', '=', $user_id)
        ->whereBetween('time',[$start_time,$end_time])
        ->orderBy('created_at', 'asc')
        ->get();
        if(!$result){
            return [
                'status' => 0,
                'message' => 'No data found'
            ];
       
        }

        return [
            'status' => 1,
            'data' => $result
        ];
   
    
    }

    public function workReport(Request $request){
       $from_date = $request->from_date !='' ? $request->from_date : date('Y-m-d', strtotime('-10 days'));
       $to_date = $request->to_date !='' ? $request->to_date :  date('Y-m-d');
       $user_id = $request->user_id;
      //     $user_id = 2;


       
        $result  = DB::select('SELECT * 
        FROM track_locations 
        INNER JOIN 
        (SELECT MAX(id) as id,date FROM track_locations where status = 2 or date BETWEEN "'.$from_date.'" and "'.$to_date.'" and user_id='.$user_id.'  GROUP BY date) last_updates 
        ON last_updates.id = track_locations.id order by track_locations.id asc');

        if(!$result){
            return [
                'status' => 0,
                'message' => 'No data found'
            ];
        }

       
        return [
            'status' => 1,
            'data' => $result
        ];

    }

    public function workReportDetails(Request $request){
        $date = $request->date;
        $user_id = $request->user_id;
       
        $result  = DB::select('SELECT * 
                               FROM track_locations 
                               INNER JOIN 
                               (SELECT MAX(id) as id,FLOOR(UNIX_TIMESTAMP(time)/(14 * 60)) AS timekey FROM track_locations where  user_id='.$user_id.' and date = "'.$date.'"  GROUP BY timekey) last_updates 
                               ON last_updates.id = track_locations.id');

        $pause = TrackLocations::where('status', '=', 2)
        ->where('user_id','=', $user_id)
        ->where('date','=', $date)->get();

        $count = count($result) - 1;

        $distance = round($this->point2point_distance($result[0]->latitude,$result[0]->longitude, $result[$count]->latitude, $result[$count]->longitude,'K'), 2);

        if(!$result){
             return [
                 'status' => 0,
                 'message' => 'No data found'
             ];
        }
 
        return [
             'status' => 1,
             'travelhistory' => $result,
             'pauselocations' => $pause,
             'distance' => $distance
         ];
 
     }

     public function point2point_distance($lat1, $lon1, $lat2, $lon2, $unit) 
     { 
         $theta = $lon1 - $lon2; 
         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
         $dist = acos($dist); 
         $dist = rad2deg($dist); 
         $miles = $dist * 60 * 1.1515;
         $unit = strtoupper($unit);

        /// echo $miles;
 
         if ($unit == "K") 
         {
          
             return ($miles * 1.609344); 
         } 
         else if ($unit == "N") 
         {
             return ($miles * 0.8684);
         } 
         else if ($unit == "M"){
             return ($miles * 1609.34);
         }
         else 
         {
            return $miles;
       }
     }  


}
