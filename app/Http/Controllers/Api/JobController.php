<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\AssignJobEmployee;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
       
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

    public function getJobs(Request $request){

        $user_id = $request->user_id;

        $jobs = AssignJobEmployee::where('user_id','=', $user_id)->get();
        if($jobs->isEmpty()){
            return response()->json([
                'status' => 0,
                'message' => 'No data found'
    
            ]);
        }
      
        foreach($jobs as $key => $value){
            
               $customer_name = $value->job->customer->company_name;
               if($value->job->customer->customer_type == 'INDIVIDUAL'){
                 $customer_name =   $value->job->customer->first_name.' '.$value->job->customer->last_name;
               }
        
                $result[] = [
                    'job_date' => $value->job->date,
                    'customer_name' => $customer_name,
                    'branch' => $value->job->customerLocation->branch,
                    'address' => $value->job->customerLocation->address,
                    'latitude' => $value->job->customerLocation->latitude,
                    'longitude' => $value->job->customerLocation->longitude,
                    'city' => $value->job->customerLocation->city->name
                ];
        }
        
        return response()->json([
            'status' => 1,
            'jobs' => $result

        ]);

    }
}
