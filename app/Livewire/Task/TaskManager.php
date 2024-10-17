<?php

namespace App\Livewire\Task;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('تسک منیجر')]
class TaskManager extends Component
{
    public function render()
    {
        return view('livewire.task.task-manager');
    }
}
