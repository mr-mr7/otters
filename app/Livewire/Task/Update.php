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
        $task = Task::query()->findOrFail($this->taskId);
        if (auth()->id() != $task->user_id) {
            $this->alert('error', 'شما اجازه ویرایش این تسک را ندارید');
        } else {
            $this->validate();
            $this->taskService->update($task, array_filter($this->form->all()));
            $this->successAlert();
            $this->dispatch('$refresh');
        }
        $this->closeModal();
    }
}
