<?php

namespace Tests\Feature\Controller\Api\V1;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use App\Events\TaskCreated;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class TaskControllerTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::query()->findOrFail(1);
    }

    // ========================================================
    // ===================INDEX TEST===========================
    // ========================================================
    #[Test]
    public function unauthorized_error_without_login__index()
    {
        $response = $this->getJson('tasks');
        $response->assertUnauthorized();
    }

    #[Test]
    public function get_tasks_when_exchanges_table_is_empty()
    {
        Task::query()->truncate();
        $response = $this->actingAs($this->user)->getJson('tasks');
        $response->assertOk()
            ->assertJsonCount(0, "data.*");
    }

    #[Test]
    public function get_paginated_tasks()
    {
        $response = $this->actingAs($this->user)->getJson('tasks');
        $response->assertOk()
            ->assertJsonCount(Task::query()->count(), "data.*")
            ->assertJsonStructure([
                'data',
                'links',
                'meta',
            ]);
    }

    // ========================================================
    // ===================INDEX TEST===========================
    // ========================================================
    #[Test]
    public function unauthorized_error_without_login__create()
    {
        $response = $this->postJson('tasks');
        $response->assertUnauthorized();
    }

    #[Test]
    public function validation_error_on_empty_data__create()
    {
        $response = $this->actingAs($this->user)->postJson('tasks', []);
        $response->assertUnprocessable()
            ->assertJsonCount(5, 'errors.*')
            ->assertJsonValidationErrors(['title', 'end_at', 'des', 'status', 'priority']);
    }

    #[Test]
    public function validation_error_on_wrong_status_and_end_at_and_priority_data__create()
    {
        $response = $this->actingAs($this->user)->postJson('tasks', [
            'title' => 'asd',
            'des' => 'des',
            'end_at' => 'asd',
            'status' => 100000,
            'priority' => -185,
        ]);
        $response->assertUnprocessable()
            ->assertJsonCount(3, 'errors.*')
            ->assertJsonValidationErrors(['end_at', 'status', 'priority']);
    }

    #[Test]
    public function create_successfully_task__create()
    {
        Event::fake([
            TaskCreated::class,
        ]);
        $response = $this->actingAs($this->user)->postJson('tasks', [
            'title' => 'asd',
            'des' => 'des',
            'end_at' => '2024-05-05 10:22:18',
            'status' => TaskStatusEnum::NEW->value,
            'priority' => TaskPriorityEnum::MEDIUM->value,
        ]);
        $response->assertCreated();

        Event::assertDispatched(TaskCreated::class);
        $this->assertDatabaseHas('tasks', [
            'title' => 'asd',
            'des' => 'des',
            'end_at' => '2024-05-05 10:22:18',
            'status' => TaskStatusEnum::NEW->value,
            'priority' => TaskPriorityEnum::MEDIUM->value,
        ]);
    }

}
