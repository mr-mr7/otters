<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:1',
            'des' => 'required|string|min:1|max:255',
            'end_at' => 'required|date',
            'priority' => 'required|in:' . implode(',', \App\Enums\TaskPriorityEnum::values()),
            'status' => 'required|in:' . implode(',', \App\Enums\TaskStatusEnum::values()),
        ];
    }
}
