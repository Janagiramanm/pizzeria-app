<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Leave;
use App\Models\Api\LeaveDetail;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       
        echo "comes";exit;

    }


    public function create(Request $request){
        echo "create";exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $user = Leave::where('user_id','=', $user_id)->first();
        if(!$user){ 
                $leave = new Leave();
                $leave->user_id = $request->user_id;
                $leave->leave_type = $request->leave_type;
                $leave->save();
        }
         
         $leave_detail = new LeaveDetail();
         $leave_detail->from_date = $request->from_date;
         $leave_detail->to_date = $request->to_date;
         $leave_detail->user_id = $user_id;
         $leave_detail->reason = $request->reason;
         $leave_detail->save();

         return response()->json( [
            'status' => 1,
            'message' => 'successfully applied',
           
        ],200);
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

    public function apply(Request $request){
        echo "appply";exit;
    }

    public function leaves(Request $request){
        
        $user_id = $request->user_id;
        $leaves = Leave::where('user_id','=',$user_id)->first();
        return response()->json( [
            'status' => 1,
            'leaves' => $leaves,
           
        ],200);
    }
}
