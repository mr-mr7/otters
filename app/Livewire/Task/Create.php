<?php

namespace App\Livewire\Task;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use App\Livewire\Forms\Task\TaskForm;
use App\Models\Task;
use App\Services\TaskService;
use App\Traits\CustomAlert;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    use CustomAlert;

    public TaskForm $form;
    private TaskService $taskService;

    public function boot(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function mount()
    {
        $this->form->status = TaskStatusEnum::NEW->value;
        $this->form->priority = TaskPriorityEnum::LOW->value;
    }

    public function render()
    {
        return view('livewire.task.create');
    }

    public function save()
    {
        $this->form->validate();
        $this->taskService->store($this->form->all());
        $this->successAlert();
        $this->closeModal();
        $this->dispatch('$refresh');
    }
}
