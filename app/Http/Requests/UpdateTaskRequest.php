<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $task = $this->route('task');
        return Auth::id() == $task->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|min:1|string',
            'des' => 'nullable|string|min:1|max:255',
            'end_at' => 'nullable|date',
            'priority' => 'nullable|in:' . implode(',', \App\Enums\TaskPriorityEnum::values()),
            'status' => 'nullable|in:' . implode(',', \App\Enums\TaskStatusEnum::values()),
        ];
    }
}
