<?php

namespace App\Livewire\Task;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('مدیریت تسک ها')]
class TaskManager extends Component
{
    public function render()
    {
        return view('livewire.task.task-manager');
    }
}
