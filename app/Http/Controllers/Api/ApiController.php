<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrackLocations;

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
           }
           return [
               'status' => 1,
               'message' => 'Successfully Inserted.'
           ];
    }

    public function userLocation(Request $request){

           $userLocations = TrackLocations::get();
         
           return [
            'status' => 1,
            'data' => $userLocations
        ];
    }
}
