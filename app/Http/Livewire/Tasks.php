<?php

namespace App\Http\Livewire;


use App\Models\Task;
use Livewire\Component;

class Tasks extends Component
{
    public function render()
    {
        $this->tasks = Task::all();
        return view('livewire.tasks.list');
    }
}
