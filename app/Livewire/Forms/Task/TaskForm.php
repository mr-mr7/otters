<?php

namespace App\Livewire\Forms\Task;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TaskForm extends Form
{
    public $title;
    public $des;
    public $end_at;
    public $priority;
    private $task;

    public function setTask(Task $task)
    {
        $this->task = $task;
        $this->fill($task);
    }

    public function getRules()
    {
        return $this->task ? (new UpdateTaskRequest())->rules() : (new CreateTaskRequest())->rules();
    }
}
