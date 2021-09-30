<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Leave;
use App\Models\Api\LeaveDetail;
use Carbon\Carbon;

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

    public function apply(Request $request){

        $user_id = $request->user_id;
        $user = Leave::where('user_id','=', $user_id)->first();
        if(!$user){ 
                $leave = new Leave();
                $leave->user_id = $request->user_id;
                $leave->save();
        }
         
         $leave_detail = new LeaveDetail();
         $leave_detail->from_date = $request->from_date;
         $leave_detail->to_date = $request->to_date;
         $leave_detail->user_id = $user_id;
         $leave_detail->reason = $request->reason;
         $leave_detail->leave_type = $request->leave_type;
         $leave_detail->save();

         return response()->json( [
            'status' => 1,
            'message' => 'successfully applied',
           
        ],200);
    }

    public function leaves(Request $request){
        
        $user_id = $request->user_id;
        $leaves = Leave::where('user_id','=',$user_id)->first();
        return response()->json( [
            'status' => 1,
            'leaves' => $leaves,
           
        ],200);
    }

    public function leaveHistory(Request $request){
        $user_id = $request->user_id;
        $result = [];
        $leavesList = LeaveDetail::where('user_id','=',$user_id)->orderBy('id', 'DESC')->get();
        if($leavesList){
            foreach($leavesList as $key => $value){
                // $date1 = new DateTime($value->from_date);
                // $date2 = new DateTime($value->to_date);
                // $interval = $date1->diff($date2);
                $start = Carbon::parse($value->from_date);
                $end =  Carbon::parse($value->to_date);
                $days = $end->diffInDays($start);

                $result[] = [
                        'from_date' => $value->from_date,
                        'to_date' => $value->to_date,
                        'leave_type' => $value->leave_type,
                        'reason' => $value->reason,
                        'status' => $value->status,
                        'no_of_days' => $days + 1
                ];
              
               
            }
        }
        return response()->json( [
            'status' => 1,
            'history' => $result,
           
        ],200);
    }
}
