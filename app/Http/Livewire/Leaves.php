<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Api\Leave;
use App\Models\Api\LeaveDetail;
use Livewire\WithPagination;
use Carbon\Carbon;

class Leaves extends Component
{
    use WithPagination;

    public $leaves, $user_name, $reject_reason, $status, $no_of_days;
    public $updateMode = false;
    public $cancelMode = false;
    public $modifyMode = false;

    public $searchTerm;
    

    public function render()
    {

        $query = '%'.$this->searchTerm.'%';

        $this->leaves =  LeaveDetail::where(function($query){
                            $query->where('status', 'like', '%'.$this->searchTerm.'%');
                                   // ->orWhere('email', 'like', '%'.$this->searchTerm.'%');
                        })->get();
                        //->paginate(10);
        return view('livewire.leaves.list');
    }

    public function edit($id){
        $this->updateMode = true;
        $this->modifyMode = false;
        $this->leave_id = $id;
        $leave = LeaveDetail::where('id', $id)->first();
        $this->user_name = $leave->user->name;
        $this->from_date = $leave->from_date;
        $this->to_date = $leave->to_date;
        $this->reason = $leave->reason;
        $this->leave_type = $leave->leave_type;

        $start = Carbon::parse($leave->from_date);
        $end =  Carbon::parse($leave->to_date);
        $this->no_of_days = $end->diffInDays($start) + 1;
        
    }

    public function modify($id){
        $this->modifyMode = true;
        $this->updateMode = false;
        $this->cancelMode = false;
        
        $this->leave_id = $id;
        $leave = LeaveDetail::where('id', $id)->first();
        $this->user_name = $leave->user->name;
        $this->from_date = $leave->from_date;
        $this->to_date = $leave->to_date;
        $this->reason = $leave->reason;
        $this->leave_type = $leave->leave_type;
        return view('livewire.leaves.modify');
    }


    public function view(){
        $this->createMode = false;
        $this->updateMode = false;
        $this->modifyMode = false;
        
        $this->resetInput();
    }

    public function cancel(){
        $this->cancelMode = true;
        $this->validate([
            'reject_reason' => 'required'
        ]);
        $leave = LeaveDetail::find($this->leave_id);
           
        $leave->update([
            'status' => 'rejected',
            'reject_reason' => $this->reject_reason,
        ]);
        $this->updateMode = false;
        $this->resetInput();

    }

    public function back(){
        $this->updateMode = true;
        $this->modifyMode = false;
       // $this->resetInput();
        // $this->edit($this->leave_id);
    }

    public function approve(){
        $this->cancelMode = false;
        $this->modifyMode = false;
        $this->updateMode = true;
        $leave = LeaveDetail::find($this->leave_id);
        $leave->status = 'approved';
        $leave->from_date = $this->from_date;
        $leave->to_date = $this->to_date;
        $leave->save();

        // $leave->update([
        //     'status' => 'approved',
        //     'from_date' => $this->from_date,
        //     'to_date' => $this->to_date,
        //     'reject_reason' => '',
        // ]);
        $this->updateMode = false;
        $this->resetInput();
    }


    private function resetInput()
    {
        $this->user_name = null;
        $this->from_date = null;      
        $this->to_date = null;      
        $this->reason = null;      
        $this->leave_type = null; 
        if(!$this->cancelMode) {
            $this->reject_reason = null;  
        }
        $this->render();
    }

    public function changeDate(){
        $start = Carbon::parse($this->from_date);
        $end =  Carbon::parse($this->to_date);
        $this->no_of_days = $end->diffInDays($start) + 1;
    }

}
