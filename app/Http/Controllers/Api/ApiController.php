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
 
         if(!$result){
             return [
                 'status' => 0,
                 'message' => 'No data found'
             ];
         }
 

        
         return [
             'status' => 1,
             'travelhistory' => $result
         ];
 
     }


}
