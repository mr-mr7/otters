<?php

namespace App\Livewire\Task;

use App\Livewire\Forms\Task\TaskForm;
use App\Models\Task;
use App\Services\TaskService;
use App\Traits\CustomAlert;
use LivewireUI\Modal\ModalComponent;

class Update extends ModalComponent
{
    use CustomAlert;

    public TaskForm $form;
    private TaskService $taskService;
    public $taskId;

    public function boot(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function mount(Task $task)
    {
        $this->taskId = $task->id;
        $this->form->setTask($task);
    }

    public function render()
    {
        return view('livewire.task.create');
    }

    public function save()
    {
        $this->validate();
        $this->taskService->update($this->taskId, array_filter($this->form->all()));
        $this->successAlert();
        $this->closeModal();
        $this->dispatch('$refresh');
    }
}
