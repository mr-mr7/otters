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
        $taskUserId = Task::query()->where('id', $this->route('task'))->value('user_id');
        return Auth::id() == $taskUserId;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'des' => 'required|string|max:255',
            'end_at' => 'required',
            'priority' => 'required|in:' . implode(',', \App\Enums\TaskPriorityEnum::values()),
        ];
    }
}
