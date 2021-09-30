<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Api\Leave;
use App\Models\Api\LeaveDetail;
use Livewire\WithPagination;

class Leaves extends Component
{
    use WithPagination;

    public $leaves, $user_name, $reject_reason, $status;
    public $updateMode = false;
    public $cancelMode = false;

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
        $this->leave_id = $id;
        $leave = LeaveDetail::where('id', $id)->first();
        $this->user_name = $leave->user->name;
        $this->from_date = $leave->from_date;
        $this->to_date = $leave->to_date;
        $this->reason = $leave->reason;
        $this->leave_type = $leave->leave_type;
    }


    public function view(){
        $this->createMode = false;
        $this->updateMode = false;
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

    public function approve(){
        $this->cancelMode = false;
        $leave = LeaveDetail::find($this->leave_id);
        $leave->update([
            'status' => 'approved',
            'reject_reason' => '',
        ]);
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

}
