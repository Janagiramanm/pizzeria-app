<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Api\Leave;
use App\Models\Api\LeaveDetail;

class Leaves extends Component
{
    public $leaves;

    public function render()
    {
        $this->leaves = LeaveDetail::all();
        return view('livewire.leaves.list');
    }
}
